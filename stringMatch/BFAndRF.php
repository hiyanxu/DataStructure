<?php
/*
 * 字符串匹配算法：
 * BF算法：暴力破解法
 *   假设主串是A，长度为n，模式串为B，长度为m，则在A中查找B，n>=m。
 *   暴力破解法就是在A中的起始位置0开始，查找长度为m的串，判断该m个字符的串是否和B匹配，若是，则匹配成功；直到找到n-m个位置，看看有没有匹配的串。
 * */
/**
* 暴力破解法
* @date:2019年2月18日 下午2:26:56
* @author:hiyanxu
* @param string $str_a 主串
* @param string $str_b 模式串
* @return int 匹配的字符串的开始下标位置
*/
function bFMatch($str_a, $str_b){
    $stra_len = strlen($str_a);
    $strb_len = strlen($str_b);
    for ($i = 0; $i<=($stra_len - $strb_len); $i++){
        $tmp = substr($str_a, $i, $strb_len);
        if ($tmp == $str_b){
            return $i;
        }
    }
    
    echo '没有匹配上';
    return false;
}

$stra = 'abcidfssd';
$strb = 'idfs';
$pos = bFMatch($stra, $strb);
if ($pos !== false){
    echo '匹配成功，下标为：'.$pos;
}