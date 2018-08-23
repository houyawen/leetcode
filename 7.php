<?php
//https://leetcode-cn.com/problems/reverse-integer/description/

function fanZhuan($num)
{
	if ($num < 0) {
		$res = fanZhuan(-$num);
		return -$res;
	}

	if ($num < 10) {
		return $num;
	}

	$remain = $num;
	$res = 0;
	while ($remain >= 10) {
		$rema = $remain % 10;
		$remain = ($remain - $rema) / 10;
		$res = $res * 10 + $rema;
	}

	return $res * 10 + $remain;
}

$a = -300241568997;
echo fanZhuan($a);

?>