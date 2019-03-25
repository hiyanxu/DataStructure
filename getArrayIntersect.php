<?php
/*
 * 获取两个数组的最长公共子序列
 * 不可用array_intersect
 * */
function getArrayIntersect($arr1, $arr2){
    $res = [];
    foreach ($arr1 as $value){
        if (in_array($value, $arr2)){
            $res[] = $value;
            $key = array_search($value, $arr2);
            unset($arr2[$key]);
        }
    }
    
    return $res;
}

$arr1 = [1,2,5,11,32,15,77];
$arr2 = [99,32,15,5,1,77];
var_dump(getArrayIntersect($arr1, $arr2));
