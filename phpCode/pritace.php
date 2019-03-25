<?php
/*
插入排序：
选择第一个元素作为有序序列
遍历待排序序列将每个元素插入到有序序列中
当待排序序列中最后一个插入到有序序列后，整个序列有序
*/
function insertSort($arr){
    $len = count($arr);
    for($i=1; $i<$len; $i++){
        for($j=$i-1; $j>=0; $j--){  //这是在一个数组上进行操作，则$j为$i的前一个数字
            if($arr[$i] > $arr[$j]){
                $tmp = $arr[$i];
                for($m=$i-1; $m>$j; $m--){  //在当前位置的后一个元素，全体向后移动一位
                    $arr[$m+1] = $arr[$m];
                }
                
                $arr[$j+1] = $arr[$i];  //移动完成后，将对应位置放入元素
                break;
            }
        }
    }
    
    return $arr;
}

// $arr = [2, 1, 9, 7, 4];
// $arr2 = insertSort($arr);
// var_dump($arr2);


/*
冒泡排序：
两两比较，将大的向右交换，知道两两交换到最后一个元素，则最后一个元素是整个序列中的最大值（此时完成了一次排序）
不断重复上述过程，主键将剩余数据中的最大值向右冒泡
直到整个待排序序列只剩最后一个值时，则整个序列有序

时间复杂度：O(n^2)
*/
function bubbleSort($arr){
    $len = count($arr);
    for($i=0; $i<$len; $i++){  //控制总共n次冒泡
        for($j=0; $j<($len-$i-1); $j++){  //$len-$i表示当每一次冒泡过后，就可以少一个比较（因为一个值已经确定了） 后面减一表示当$j到了最后，可以不用比较了（因为就是最大的）
            
            if($arr[$j] > $arr[$j+1]){
                $tmp = $arr[$j+1];
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }
    
    return $arr;
}


// $arr = [2, 1, 9, 7, 4];
// $arr2 = bubbleSort($arr);
// var_dump($arr2);

/*
快速排序：
先对整个序列做一次快排，找到第一个元素的位置，然后以该位置做拆分，左右两个子序列分别都做快排
知道子序列为1，则此时，整个序列有序
时间复杂度：O(nlogn)
*/
function quickSort($arr, $start, $end){
    if($start <= $end){
        return $arr;
    }
    
    $pos = quickSortReal($arr, $start, $end);
    quickSort($arr, $start, $pos-1);
    quickSort($arr, $pos+1, $end);
    
    return $arr;
}

function quickSortReal(&$arr, $low, $height){  //默认将low置为第一个，将height置为最后一个
    $data = $arr[$low];
    while($low < $height){  //两者不相遇，则进行比较
        while($low < $height){
            //从序列的右边找，直到找到比当前data小的值为止，将low、height的值互换
            if($arr[$height] < $data){
                $tmp = $arr[$height];
                $arr[$height] = $arr[$low];
                $arr[$low] = $tmp;
                break;
            } else {
                $height--;
            }    
        }
        
        while($low < $height){
            if($arr[$low] > $data){
                $tmp = $arr[$low];
                $arr[$low] = $arr[$height];
                $arr[$height] = $tmp;
                break;
            } else {
                $low++;
            }
        }
    }
    
    return $low;
}


$arr = [2, 1, 9, 7, 4];
$arr = quickSort($arr, 0, count($arr)-1);
var_dump($arr);


/*
二分查找：
不断将数据从一半处分开，看中间值是否是要查找的值
*/
function binarySearch($arr, $start, $end, $search_val){
    $mid = floor(($start + $end)/2);
    if($arr[$mid] == $search_val){
        return $mid;
    }
    if($start <= $end){
        return '没有找到';
    }
    
    //判断大小，从左右子序列中继续查找
    if($arr[$mid] < $search_val){  //在右面
        binarySearch($arr, $mid+1, $end, $search_val);
    } else {
        binarySearch($arr, $start, $mid-1, $search_val);
    }
}



/*
归并排序：
不断将数据从一半处分开，然后对一半进行排序，然后将有序后的两个子序列合并成一个有序序列
*/
function mergeSort(&$arr, $start, $end){
    if($start < $end){
        return;
    }
    
    $mid = floor(($start + $end)/2);
    mergeSort($arr, $mid+1, $end);
    mergeSort($arr, $start, $mid);  //排序完了后，合并 其实当$end-$start=2时，再mid后，每个子序列就剩了一个数字，然后合并其实就是将两个数字进行比较合并
    $arr = mergeSortData($arr, $start, $end, $mid);
}

function mergeSortData($arr, $start, $end, $mid){
    //构造另外的一个临时数组，大小为$end-$start
    $arr2 = [];
    
    //遍历子数组 [$start, $mid]、[$mid+1, $end]
    $i = $start;
    $j = $mid+1;
    while(true){
        if($i>$mid || $j>$end){
            break;
        }
        $val_i = $arr[$i];
        $val_j = $arr[$j];
        if($val_i <= $val_j){
            $arr2[] = $val_i;
            $i++;
        } else {
            $arr2[] = $val_j;
            $j++;
        }
    }
    
    //将其中一个子序列剩下的数据全部添加到后面
    if($i < $mid){
        for(; $i<=$mid; $i++){
            $arr2[] = $arr[$i];
        }
    } else if($j < $end){
        for(; $j<=$end; $j++){
            $arr2[] = $arr[$j];
        }
    }
    
    return $arr2;
}


























