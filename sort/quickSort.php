<?php
/*
 * 快速排序：
 * 随机选中一个值，作为povit
 * 将比povit小的都放在povit左边，将比povit大的都放在povit右边
 * 这样，povit的位置就确定了
 * 
 * 然后对povit左边的列执行上述步骤，对povit右边的列也执行上述步骤
 * */
function quickSort(&$arr, $start, $end){
    if ($start >= $end){
        return;
    }
    
    //选择一个默认的值作为povit
    $povit = $arr[$start];
    
    //找出povit合适的位置
    $position = getPosition($arr, $start, $end, $povit);
    quickSort($arr, $start, $position-1);  //对该值左边执行快排
    quickSort($arr, $position+1, $end);  //对该值右边执行快排
}


/**
* 获取povit在数组中的位置
* @date:2019年2月11日 上午10:58:26
* @author:hiyanxu
*/
function getPosition(&$arr, $start, $end, $povit){
    $low = $start;
   //设置默认povit不动，让start、end移动，且相互交换swap
   while ($start < $end){
       while($start < $end){
           if ($arr[$end] >= $povit){
               $end = $end - 1;
           } else {
               $start_val = $arr[$start];
               $arr[$start] = $arr[$end];
               $arr[$end] = $start_val;
               break;
           }
       }
       
       while ($start < $end){
           if ($arr[$start] <= $povit){  //若start下标对应的值小于povit，则该值不动（因为该值比povit小，所以就应该在左边不动），start++
               $start = $start + 1;
           } else {  //当该值比povit大时，则该start下标的值和end下标的值交换，然后移动end
               $start_val = $arr[$start];
               $arr[$start] = $arr[$end];
               $arr[$end] = $start_val;
               break;  //跳出start的循环，开始移动end
           }
       }
       
   }
   
   return $start;
}

$arr = [4, 6, 1, 3, 9, 8];
quickSort($arr, 0, 5);
var_dump($arr);













