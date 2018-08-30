<script>
/*
山脉数组的峰顶索引
https://leetcode-cn.com/problems/peak-index-in-a-mountain-array/description/
*/
function peakIndexInMountainArray(A){
	if (A.length < 3) {
		return -1
	}

	var start = 1
	var end = A.length - 2
	while((end - start) > 1){
		var mid = start + Math.floor((end - start) / 2)
		if (A[mid] > A[mid - 1] && A[mid] > A[mid + 1]) {
			return mid
		}
		if (A[mid] > A[mid - 1] && A[mid] < A[mid + 1]) {
			start = mid
		}
		if (A[mid] < A[mid - 1] && A[mid] > A[mid + 1]) {
			end = mid
		}
	}
	if (A[start] > A[start - 1] && A[start] > A[start + 1]) {
		return start
	}
	if (A[end] > A[end - 1] && A[end] > A[end + 1]) {
		return end
	}

	return -1
}
</script>