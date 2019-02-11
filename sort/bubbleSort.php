<?php
/*
冒泡排序：
两两比较，直到最后一个就是序列中的最大值
*/
function bubbleSort($arr){
	$len = count($arr);
	for ($i=0; $i < ($len - 1); $i++) {  //总共需要$len-1次冒泡排序
		for ($j=0; $j < ($len - $i - 1); $j++) {  //$len-$i-1表示当我们每完成一次冒泡排序后，整个序列从后往前就有一个不需要再排序了，且若序列有4个需要排序数字，则只需要3次比较，所以减一
			if ($arr[$j] > $arr[$j + 1]) {  //交换
				$tmp = $arr[$j];
				$arr[$j] = $arr[$j + 1];
				$arr[$j + 1] = $tmp;
			}
		}
	}
	return $arr;
}

$arr = [12, 5, 3, 9, 2, 7, 11];
$sort_arr = bubbleSort($arr);
var_dump($sort_arr);