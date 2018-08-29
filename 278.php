<?php
/*
https://leetcode-cn.com/problems/first-bad-version/description/
*/
function isBadVersion($version) {
	if ($version >= 4) {
		return true;
	}

	return false;
}

function solution($n){
	if ($n == 1) {
		return $n;
	}

	$start = 1;
	$end = $n;

	$lowestBadVersion = 0;
	while (($end - $start) > 1) {
		$mid = $start + floor(($end - $start) / 2);
		if (isBadVersion($mid)) {
			echo "===<=$start==$end=$mid==\n";

			$lowestBadVersion = $mid;
			$end = $mid;
		} else {
			echo "===>=$start==$end=$mid==\n";
			$start = $mid;
		}
	}

	if (!empty($lowestBadVersion)) {
		if (isBadVersion($end) && $end < $lowestBadVersion) {
			$lowestBadVersion = $end;
		}

		if (isBadVersion($start) && $start < $lowestBadVersion) {
			$lowestBadVersion = $start;
		}
	} else {
		if (isBadVersion($end)) {
			$lowestBadVersion = $end;
		}

		if (isBadVersion($start)) {
			$lowestBadVersion = $start;
		}
	}

	return $lowestBadVersion;
}

echo solution(5);

?>