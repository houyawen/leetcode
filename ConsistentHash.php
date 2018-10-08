<?php
/*
一致性hash接口
*/
interface ConsistentHash{
	//将字符串转化成hash值
	public function cHash($str);
	//增加一个服务器节点
	public function addServer($server);
	//移除一个服务器节点
	public function removeServer($server);
	//在当前服务器列表中找到合适的服务器存储资源
	public function lookup($key);
}

/*
一致性hash类实现
*/
class MyConsistentHash implements ConsistentHash{
	public $serverList = []; //服务器列表
	public $virtualPos = [];  //虚拟节点的位置
	public $virtualPosNum = 5;   //每个节点对应几个虚拟节点

	//将字符串转化成32位无符号整数
	public function cHash($str){
		$str = md5($str);
		return sprintf('%u', crc32($str));
	}

	/**
	 * 在当前服务器列表中找到合适的服务器存储资源
	 * @param $str   键名
	 * @return int   服务器ip地址
	*/
	public function lookup($str){
		$point = $this->cHash($str); //计算落点hash值
		$finalServer = current($this->virtualPos);
		foreach ($this->virtualPos as $pos => $server) {
			if ($point <= $pos) {
				$finalServer = $server;
				break;
			}
		}

		reset($this->virtualPos);
		return $finalServer;
	}

	/**
	 * 添加一台服务器到服务器列表
	 * @param  服务器ip地址
	 * @return bool
	*/
	public function addServer($server){
		if (!isset($this->serverList[$server])) {
			for ($i = 0; $i < $this->virtualPosNum; $i++) { 
				$pos = $this->cHash($server . '-' . $i);
				$this->virtualPos[$pos] = $server;
				$this->serverList[$server][] = $pos;
			}
			ksort($this->virtualPos, SORT_NUMERIC);
		}

		return true;
	}

	/**
	 * 移除一个服务器节点(删除该服务器的所有虚拟节点)
	 * @param 服务器ip地址
	 * @return bool
	*/
	public function removeServer($server){
		if (isset($this->serverList[$server])) {
			foreach ($this->serverList[$server] as $pos) {
				unset($this->virtualPos[$pos]);
			}
			unset($this->serverList[$server]);
		}

		return true;
	}

}

//test
echo "模拟测试一致性hash开始====================\n";
sleep(1);
echo "先添加一批服务器===========sucess\n";
sleep(1);
$consistent = new MyConsistentHash();
$consistent->addServer('192.168.1.1');
$consistent->addServer('192.168.1.2');
$consistent->addServer('192.168.1.3');
$consistent->addServer('192.168.1.4');
$consistent->addServer('192.168.1.5');
$consistent->addServer('192.168.1.6');
$consistent->addServer('192.168.1.7');
$consistent->addServer('192.168.1.8');
$consistent->addServer('192.168.1.9');
$consistent->addServer('192.168.1.10');
echo "添加服务器完成，共十台\n";
sleep(1);
echo "下面存储key1到key10到机器\n";
sleep(1);
echo "添加key1到服务器,--------结果保存到了" . $consistent->lookup('key1') . "\n";
sleep(1);
echo "添加key2到服务器,--------结果保存到了" . $consistent->lookup('key2') . "\n";
sleep(1);
echo "添加key3到服务器,--------结果保存到了" . $consistent->lookup('key3') . "\n";
sleep(1);
echo "添加key4到服务器,--------结果保存到了" . $consistent->lookup('key4') . "\n";
sleep(1);
echo "添加key5到服务器,--------结果保存到了" . $consistent->lookup('key5') . "\n";
sleep(1);
echo "添加key6到服务器,--------结果保存到了" . $consistent->lookup('key6') . "\n";
sleep(1);
echo "添加key7到服务器,--------结果保存到了" . $consistent->lookup('key7') . "\n";
sleep(1);
echo "添加key8到服务器,--------结果保存到了" . $consistent->lookup('key8') . "\n";
sleep(1);
echo "添加key9到服务器,--------结果保存到了" . $consistent->lookup('key9') . "\n";
sleep(1);
echo "添加key10到服务器,--------结果保存到了" . $consistent->lookup('key10') . "\n";

sleep(2);
echo "\n\n\n测试删除一台服务器==============\n";
sleep(1);
$consistent->removeServer('192.168.1.4');
echo "删除192.168.1.3成功,再次尝试保存key1到key10=============\n";
sleep(1);
echo "添加key1到服务器,--------结果保存到了" . $consistent->lookup('key1') . "\n";
sleep(1);
echo "添加key2到服务器,--------结果保存到了" . $consistent->lookup('key2') . "\n";
sleep(1);
echo "添加key3到服务器,--------结果保存到了" . $consistent->lookup('key3') . "\n";
sleep(1);
echo "添加key4到服务器,--------结果保存到了" . $consistent->lookup('key4') . "\n";
sleep(1);
echo "添加key5到服务器,--------结果保存到了" . $consistent->lookup('key5') . "\n";
sleep(1);
echo "添加key6到服务器,--------结果保存到了" . $consistent->lookup('key6') . "\n";
sleep(1);
echo "添加key7到服务器,--------结果保存到了" . $consistent->lookup('key7') . "\n";
sleep(1);
echo "添加key8到服务器,--------结果保存到了" . $consistent->lookup('key8') . "\n";
sleep(1);
echo "添加key9到服务器,--------结果保存到了" . $consistent->lookup('key9') . "\n";
sleep(1);
echo "添加key10到服务器,--------结果保存到了" . $consistent->lookup('key10') . "\n";


sleep(2);
echo "\n\n\n测试增加一台服务器==============\n";
sleep(1);
$consistent->addServer('192.168.1.11');
echo "删除192.168.1.11成功,再次尝试保存key1到key10=============\n";
sleep(1);
echo "添加key1到服务器,--------结果保存到了" . $consistent->lookup('key1') . "\n";
sleep(1);
echo "添加key2到服务器,--------结果保存到了" . $consistent->lookup('key2') . "\n";
sleep(1);
echo "添加key3到服务器,--------结果保存到了" . $consistent->lookup('key3') . "\n";
sleep(1);
echo "添加key4到服务器,--------结果保存到了" . $consistent->lookup('key4') . "\n";
sleep(1);
echo "添加key5到服务器,--------结果保存到了" . $consistent->lookup('key5') . "\n";
sleep(1);
echo "添加key6到服务器,--------结果保存到了" . $consistent->lookup('key6') . "\n";
sleep(1);
echo "添加key7到服务器,--------结果保存到了" . $consistent->lookup('key7') . "\n";
sleep(1);
echo "添加key8到服务器,--------结果保存到了" . $consistent->lookup('key8') . "\n";
sleep(1);
echo "添加key9到服务器,--------结果保存到了" . $consistent->lookup('key9') . "\n";
sleep(1);
echo "添加key10到服务器,--------结果保存到了" . $consistent->lookup('key10') . "\n";


?>