<?php
/*
插入排序算法：
（1）首先给出一队无序数列，默认将第一个数字作为有序数列。
（2）从第二个开始依次从后面取出每个数字插入到前面的有序数列中。
（3）当将最后一个数字插入到里面后，整个序列有序。
*/
/*
插入排序
选择数组的第一个元素作为有序序列
遍历后面的元素，为他们依次在有序序列中找到合适位置
找到合适位置后，执行移动插入元素操作
*/
function insertSort($arr){
	$sorted = [$arr[0]];
	$len = count($arr);
	for ($i=1; $i < $len; $i++) {  //从第一个元素开始，依次为他们在有序序列中寻找合适位置
		$sorted_len = count($sorted);
		if ($sorted_len == 1) {  //当有序序列中只有一个数字时，无需循环操作
			if ($arr[$i] > $sorted[0]) {
				$sorted[1] = $arr[$i];
			} else {
				$sorted[1] = $sorted[0];
				$sorted[0] = $arr[$i];
			}
			continue;
		}

		//当序列中不止一个数字时，需要遍历查询到合适的位置
		for ($j=0; $j < $sorted_len; $j++) { 
			if ($arr[$i] < $sorted[$j]) {  //当该值比j位置的数字小的时候，表明就为i对应的元素找到了合适位置
				for ($m=$sorted_len-1; $m >= $j; $m--) {  //将该位置后面元素全部向后移动一位 需要从后向前的移动，否则会造成后面的元素被覆盖的情况
					$sorted[$m + 1] = $sorted[$m];
				}
				$sorted[$j] = $arr[$i];
				break;
			} else if ($arr[$i] > $sorted[$sorted_len-1]) {  //大于最后一个的值
				$sorted[$sorted_len] = $arr[$i];
				break;
			}
		}
	}

	return $sorted;
}

$arr = array(1, 5, 3, 9, 2, 7, 11);
$srot_arr = insertSort($arr);
$srot_arr2 = insertSort2($arr);
var_dump($srot_arr);
var_dump($srot_arr2);


/*
插入排序
选择数组的第一个元素作为有序序列
遍历后面的元素，为他们依次在有序序列中找到合适位置
找到合适位置后，执行移动插入元素操作

和上面一种方法不同的是，该次插入排序直接在原数组上操作，这样可以省去对本就在合适位置的数据的复制操作
*/
function insertSort2($arr){
	$len = count($arr);
	for ($i=1; $i < $len; $i++) {  //从下标为1的数据开始，为他们依次找到合适的位置进行插入
		for ($j=0; $j < $i; $j++) {  //遍历有序序列0-$i，在该序列中寻找合适位置   另外一个优化建议，$j=$i-1即同样是遍历有序序列，只不过是从后往前遍历，这样我们在从后往前的遍历过程中可以每个数据都进行比较，然后大的向后移动，这样最后的j的位置就是合适位置
			//可以直接插入
			if ($arr[$i] < $arr[$j]) {  //当找到小于该值时，说明找到了合适位置
				$tmp = $arr[$i];
				for ($m=$i-1; $m >= $j; $m--) {  //向后移动有序序列中“最后一位到合适位置$j之间的数据”
					$arr[$m + 1] = $arr[$m];
				}
				$arr[$j] = $tmp;
				break;
			}
		}
	}

	return $arr;
}



























