<?php
/*
https://leetcode-cn.com/problems/arranging-coins/description/
排列硬币
*/
function arrangeCoins($n){
	if ($n <= 0) {
		return 0;
	}

	return floor(sqrt(2 * $n + 0.25) - 0.5);
}

echo arrangeCoins(1000) . "\n";

?>