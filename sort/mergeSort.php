<?php
/*
 * 归并排序：采用分治法的排序方式
 * 分：将序列拆分开，直接每个子序列都是2个数字为止。
 * 治：将每个子序列大小排序，然后合并，直接将所有序列都合并成一个序列为止。
 * 分、治都完成后，整个序列都将有序。
 * */
function mergeSort($arr, $start, $end){
    /*
     * 将n个规模的数据分解为n/2规模的数据
     * */
    if ($start <= $end){
        return;
    }
    
    $middle = ($start + $end)/2;
    mergeSort($arr, $start, $middle);
    mergeSort($arr, $middle+1, $end);
    
    /*
     * 经过上述两个左右两边的merge分解后，左右两边的数据已经有序
     * */
    $arr = merge($arr, $start, $end);
    
    return $arr;
}

/*
 * 将已经有序的数据merge合并起来
 * */
function merge($arr, $s, $e){
    //将数据$arr中下标在$s、$e之间的数据合并起来
    $middle = ($s + $e)/2;
    
    $i = $s;
    $j = $middle+1;
    
    //构建临时数据
    $tmp = [];  //实际存储数据的个数为：(($e-$s) + 1)
    while($i<$middle+1 && $j<=$e){
        if ($arr[$i] <= $arr[$j]){
            $tmp[] = $arr[$i];
            $i++;
        } else {
            $tmp[] = $arr[$j];
            $j++;
        }
    }
    
    //分别判断两个子数组是否还有剩余，将其全部拷贝到$tmp数组中
    while($j <= $e){
        $tmp[] = $arr[$j];
        $j++;
    }
    
    while($i < $middle+1){
        $tmp[] = $arr[$i];
        $i++;
    }
    
    //再将$tmp放入原数组$arr中
    $i = 0;
    for($p=$s; $p<=$e; $p++){
        $arr[$p] = $tmp[$i];
        $i++;
    }
    
    return $arr;
}















