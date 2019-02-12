<?php
/*
 * 二分查找算法：
 * 在有序数列中查找某个值
 * 
 * 将数列取中间值，判断中间值是否等于当前待查找的值：
 * 若等于，则表示找到了该值，直接返回下标；若不等于，则继续二分查找（所以采用递归实现）。
 * 若该中间值小于待查找的值，则表示待查找的值在右面一半，则对右面一半继续执行二分查找。
 * 若该中间值大于待查找的值，则表示待查找的值在左面一半，则对左边一半继续执行二分查找。
 * 
 * 直到满足了该中间值等于待查找的值，则递归返回，该下标就是要查找的值的下标。
 * */
function binarySearch($arr, $search_val, $low, $height){  //递归写法
    $middle = floor(($low + $height)/2);
    if ($low >= $height && $arr[$middle] == $search_val){  //直到查找区间只剩了一个数字，且查找的数据匹配，则找到了该数据的位置
        return $middle;
    }
    
    if ($arr[$middle] < $search_val){  //表示待查找的值在middle到height中间
        $key = binarySearch($arr, $search_val, $middle + 1, $height);
    } else {
        $key = binarySearch($arr, $search_val, $low, $middle - 1);
    }
    
    return $key;
}

$arr = [4, 10, 14, 18, 20, 25];
var_dump(binarySearch($arr, 10, 0, 5));


/**
* 二分查找——循环写法
* @date:2019年2月11日 下午9:03:57
* @author:hiyanxu
*/
function binarySearchLoop($arr, $search_val){
    $low = 0;
    $height = count($arr) - 1;
    
    while($low <= $height){
        $mid = floor(($low + $height)/2);
        if ($arr[$mid] > $search_val){  //表示$search_val在low至mid中间
            $height = $mid - 1;  //重新对height进行赋值，去low至mid之间做二分查找                    
        } else if($arr[$mid] < $search_val){  //表示$search_val在mid至height中间
            $low = $mid + 1;
        } else if($arr[$mid] == $search_val){  //表示找到了
            return $mid;
        }
    }
    
    return -1;
}

$arr = [4, 10, 14, 18, 20, 25];
var_dump(binarySearchLoop($arr, 20));

/**
* 二分查找——》数组序列中有重复数字的情况——》查找第一个匹配的数字
* @date:2019年2月11日 下午9:22:14
* @author:hiyanxu
*/
function binarySearchLoopRepeat1($arr, $search_val){
    /*
     * 假如存在如下数列：2 5 7 9 9 9 10
     * 此时，需要查找数字9，且需要查找的是重复9中的第一个，即下标为3的9
     * */
    $low = 0;
    $height = count($arr) - 1;
    
    while($low <= $height){
        $mid = floor(($low + $height)/2);
        if ($arr[$mid] > $search_val){  //表示$search_val在low至mid中间
            $height = $mid - 1;  //重新对height进行赋值，去low至mid之间做二分查找
        } else if($arr[$mid] < $search_val){  //表示$search_val在mid至height中间
            $low = $mid + 1;
        } else {  //表示找到了
            //此时在已经匹配到要查找的数字时，还要对查找到的下标mid做判断，即判断是否是第一个匹配的
            if (($mid == 0) || ($arr[$mid-1] != $search_val)){  
                //mid为下标0时，肯定是第一个；或该mid下标前一个数字不是匹配数字，则满足其实第一个匹配的
                return $mid;
            } else {  //若不满足上述情况，则表示其第一个匹配值肯定在low至mid之间
                $height = $mid - 1;
            }
        }
    }
    
    return -1;
}

$arr3 = [2, 5, 6, 7, 8, 9, 9, 9, 10];
var_dump(binarySearchLoopRepeat1($arr3, 9));

/**
 * 二分查找——》数组序列中有重复数字的情况——》查找最后一个匹配的数字
 * @date:2019年2月11日 下午9:22:14
 * @author:hiyanxu
 */
function binarySearchLoopRepeat2($arr, $search_val){
    /*
     * 假如存在如下数列：2 5 7 9 9 9 10
     * 此时，需要查找数字9，且需要查找的是重复9中的最后一个，即下标为5的9
     * */
    $low = 0;
    $height = count($arr) - 1;
    
    while($low <= $height){
        $mid = floor(($low + $height)/2);
        if ($arr[$mid] > $search_val){  //表示$search_val在low至mid中间
            $height = $mid - 1;  //重新对height进行赋值，去low至mid之间做二分查找
        } else if($arr[$mid] < $search_val){  //表示$search_val在mid至height中间
            $low = $mid + 1;
        } else {  //表示找到了
            //此时在已经匹配到要查找的数字时，还要对查找到的下标mid做判断，即判断是否是第一个匹配的
            if (($mid == (count($arr) - 1)) || ($arr[$mid+1] != $search_val)){
                //mid为下标最后一个时，肯定满足；或该mid下标后一个数字不是匹配数字，则满足其实其是最后一个匹配的
                return $mid;
            } else {  //若不满足上述情况，则表示其第一个匹配值肯定在mid至height之间
                $low = $mid + 1;
            }
        }
    }
    
    return -1;
}
$arr4 = [2, 5, 6, 7, 8, 9, 9, 9, 10];
var_dump(binarySearchLoopRepeat2($arr4, 9));

/**
* 二分查找——》查找第一个大于等于给定值的元素
* @date:2019年2月12日 上午10:36:04
* @author:hiyanxu
*/
function binarySearchLoop3($arr, $val){
    /*
     * 查找第一个大于等于给定值的元素
     * 例如：2, 5, 9, 11, 19, 21  查找第一个大于等于10的元素，也就是查找11，最终得出的下标应该是3
     * */
    $low = 0;
    $height = count($arr) - 1;
    while($low <= $height){
        $mid = floor(($low + $height)/2);
        //根据查询到的数据来判断
        if ($arr[$mid] >= $val){  //数据在low至mid中间  因为要求查找大于等于，则若是数列中存在10，则应该查找出10，所以需要增加一个等号
            //因为mid下标对应的值大于等于val，则表示mid满足该条件，则需要判断mid是否满足“第一个”的条件
            if (($mid == 0) || ($arr[$mid-1] < $val)){  //其下标是0，或其前一个数据小于该值，则其是第一个
                return $mid;
            } else {  //则表示mid不是第一个，则其左边的数据也满足条件，则数据在low至mid-1中
                $height = $mid - 1;
            }
        } else {  //表示满足条件的数据在mid至height中
            $low = $mid + 1;
        }
    }
    
    return -1;
}
$arr4 = [2, 5, 9, 11, 19, 21];
var_dump(binarySearchLoop3($arr4, 4));























