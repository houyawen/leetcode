<?php

class SmsEntrance {

	const SCENES_ADMIN_LOGIN = 'scene_admin_login';

	const IP_PER_MAX = 5000;      //每个IP每半个小时能发送短信的次数
	const MOBILE_PER_MAX = 2000;    //每个手机号每天允许发送的同一个场景的短信数量


    private static function getSceneContent($scene)
    {
        $scenes = array(
            self::SCENES_ADMIN_LOGIN => array(
                'title'=>'XXX',
                'msg' => "XXXX%code%,5分钟内有效",
            ),
        );
        return isset($scenes[$scene])?$scenes[$scene]:'';
    }

	public static function sendCodeByScene($mobile, $scene, $courier_name = '', $courier_no = '')
	{
		$content = self::getSceneContent($scene);

		if (empty($content)) {
			throw new ServiceException('发送失败', FrontConst::ERROR_SMS_SCENE);
		}

		//check是否能发送
		self::canSendSms($mobile, $scene);

		$msg = array_get($content, 'msg');

		$sms_service = new ChuanglanSmsApi;

        $verify_code=rand(100000, 999999);
        $express_company_list = config('express'); 
        $courier_name = array_key_exists($courier_name, $express_company_list) ? $express_company_list[$courier_name] : $courier_name;
        $msg = str_replace("%code%", $verify_code, $msg);
        $msg = str_replace("%comapany%", $courier_name, $msg);
        $msg = str_replace("%number%", $courier_no, $msg);
        $is_send_sms = config('sms.is_send');
        if ($is_send_sms) {
            $sms_result = $sms_service->sendSMS($mobile, $msg);
            $sms_result_exec = $sms_service->execResult($sms_result);
            $send_sms_code = array_get($sms_result_exec, 1, 'fail');
        } else {
            //本地调试短信业务代码用，不真正发短信
            $sms_result = '本地调试';
            $send_sms_code = 0;
        }

        \Log::info('sms_result', ['sms_result' => $sms_result]);
		if ($send_sms_code != 0) {
			throw new ServiceException('发送失败', FrontConst::ERROR_SMS_SERVICE);
		}

		//发送成功，记录日志
		$sms_log_data = [
			'mobile' => $mobile,
			'scene' => $scene,
			'code' => $verify_code,
			'content' => $msg,
			'sms_result' => $sms_result,
			'send_time' => date('Y-m-d H:i:s')
		];

		UserSmsLog::insert($sms_log_data);
		self::incrementSentTimeIp();
		self::incrementSentTimeFrequency($mobile, $scene);

		return true;
	}

	private static function canSendSms($mobile, $scene)
	{
		//检查ip
		self::checkIp();
		//不允许同一种场景的短信同一个手机号一分钟之内发送第二条
		self::checkMobileFrequency($mobile, $scene);
		//检查同一个手机号同一种场景每天的发送次数
		self::checkMobileDaily($mobile, $scene);
	}

	private static function checkMobileFrequency($mobile, $scene)
	{
        //自动触发短信不限制次数,以下是用户主动触发短信的场景
        $user_scene = [
            self::SCENES_BUY_PACKAGE,
            self::SCENES_USER_BIND_MOBILE,
            self::SCENES_USER_BORROW_CANCEL,
        ];
        //不在用户主动触发短信的场景则为自动触发短信不需要限制次数
        if (!in_array($scene, $user_scene)) {
            return true;
        }
		$mobile_send_times = self::getMobileSendTimes($mobile, $scene);
        \Log::info('短信次数', ['mobile' => $mobile, 'scene' => $scene, 'mobile_send_time' => $mobile_send_times]);
		if ($mobile_send_times > 0) {
			throw new ServiceException('您发送短信的频率过高，请稍候重试', FrontConst::ERROR_SMS_MOBILE_FREQUENCY);
		}

		return true;
	}

	private static function getMobileSendTimes($mobile, $scene)
	{
        try {
            $key = self::frequencyCacheKey($mobile, $scene);
            return (int)Cache::get($key);
        } catch (Exception $e) {
            return 0;
        }
	}

    private static function frequencyCacheKey($mobile, $scene)
    {
        return 'SMS:' . date('YmdHi') . ':' . $mobile . ':' . $scene;
    }

    private static function getClientIp()
    {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $tmp = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
            $onlineip = $tmp[0];
        } elseif (getenv('HTTP_REMOTEIP')) {
            $onlineip = getenv('HTTP_REMOTEIP');
        } elseif(getenv('HTTP_CLIENT_IP')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('REMOTE_ADDR')) {
            $onlineip = getenv('REMOTE_ADDR');
        } else {
            $onlineip = '127.0.0.1';
        }

        return $onlineip;
    }


	private static function checkMobileDaily($mobile, $scene)
	{
		$total = self::getTotalValidCodeSMS($mobile, $scene);

		if ($total > self::MOBILE_PER_MAX) {
			throw new ServiceException('今天发送的短信数量超过限制', FrontConst::ERROR_SMS_MOBILE_DAILY);
		}

		return true;
	}


    private static function getTotalValidCodeSMS($mobile, $scene)
    {
        $total = UserSmsLog::where('mobile','=',$mobile)
        ->where('created_at','>',date("Y-m-d 00:00:00"))
        ->where('scene','=',$scene)->count();

        return $total;
    }

	private static function checkIp()
	{
		$ip_sendtimes = self::getSentTimes();
        if ($ip_sendtimes > self::IP_PER_MAX) {
			throw new ServiceException('IP发送短信频率过高', FrontConst::ERROR_SMS_IP);
        }

        return true;
	}

    private static function getSentTimes()
    {
        try {
            $key = self::generateCacheKey();
            return (int)Cache::get($key);
        } catch (Exception $e) {
            return 0;
        }
    }

    private static function generateCacheKey()
    {
        $ip = self::getClientIp();
        return 'SMS:' . date('Ymd') . ':' . ip2long($ip);
    }

    private static function incrementSentTimeIp()
    {
        try {
            $key = self::generateCacheKey();
            if (Cache::has($key)) {
                Cache::increment($key);
            } else {
                Cache::put($key, 1, 60*30);
            }
        } catch (Exception $e) {
        	return true;
        }
    }

    private static function incrementSentTimeFrequency($mobile, $scene)
    {
        try {
            $key = self::frequencyCacheKey($mobile, $scene);
            if (Cache::has($key)) {
                Cache::increment($key);
            } else {
                Cache::put($key, 1, 60);
            }
        } catch (Exception $e) {
        	return true;
        }
    }


    public static function checkSmsCode($mobile, $code, $scene)
    {
        // return true;
        //校验手机验证码
        $db_code = UserSmsLog::where('mobile', $mobile)
                            ->where('scene', $scene)
                            ->where('send_time', '>', date('Y-m-d H:i:s', strtotime('-5minute')))
                            ->orderBy('id', 'desc')
                            ->pluck('code');

        if (empty($db_code) || intval($code) != intval($db_code)) {
            return false;
        }

        return true;
    }

}


?>