<?php
/*
 * 堆及堆排序：
 * 堆：根节点大于等于（或小于等于）左右子树。
 * 大顶堆：根节点是堆中最大的数据。
 * 小顶堆：根节点是堆中最小的数据。
 * */
/**
 * 堆结构
 * @author hiyanxu
 * @date 2019-02-16
 */
class Heap{
    public $arr=[];  //堆中的数组  该处采用数组存储堆的数据
    public $n;  //堆中数据的最大个数
    public $count;  //堆中有效数据的个数
    
    public function __construct($arr){
        $this->arr = $arr;
        $this->n = count($arr);
        $this->count = 0;
    }
    
    /**
    * 堆数据插入的过程
    * 采用“从下而上”的堆化插入数据
    * @date:2019年2月16日 下午4:25:25
    * @author:hiyanxu
    * @param int $data 待插入数据
    */
    public function insert1($data){
        if ($this->count == $this->n){  //数据已满，不可插入
            echo '数据已满，不可插入新数据'.PHP_EOL;
            return false;
        }
        
        //将待插入数据放到数据的最后一个，然后逐渐向上堆化比较，直到找到合适位置
        $last_pos = 0;
        for ($i = 1; $i < count($this->arr); $i++){
            if (isNull($this->arr[$i])){
                $last_pos = $i;        
            }
        }
        
        //找到该位置后，将数据放在该位置，然后开始向上堆化
        $this->arr[$last_pos] = $data;
        $parent_pos = floor($last_pos/2);
        while(true){
            if ($this->arr[$parent_pos] < $this->arr[$last_pos]){  //父节点小于当前节点，则交换
                $this->arr[$last_pos] = $this->arr[$parent_pos];
                $this->arr[$parent_pos] = $data;
                $last_pos = $parent_pos;
            } else {  //该位置就是合适的位置了
                break;
            }
        }
        
        $this->count += 1;  //有效数据+1
        
        return true;
    }
    
    /**
    * 堆排序：
    * 建堆：按照数据开始的方式将其当做一个堆，然后对堆中非叶子节点做“从上而下”的堆化，
    * 直到其成为叶子节点或比子节点都大，就是合适位置了
    * 
    * 排序：
    * （1）将堆顶元素和最后一个元素互换，然后将堆顶元素作为数组的最后一个元素
    * （2）对新的堆顶元素做n-1个数据中从上而下的堆化，堆化完成后，新的堆顶元素就是最大的，然后将其和最后一个元素互换，将该堆顶放在数组下标n-1上
    * （3）不断如此，直到堆只剩下了一个元素，则堆化完成。
    * 
    * 整体堆排序的时间复杂度为O(nlogn)
    * @date:2019年2月16日 下午4:37:49
    * @author:hiyanxu
    * @param int $data
    */
    public function sort(){
        if ($this->count == $this->n){  //数据已满，不可插入
            echo '数据已满，不可插入新数据'.PHP_EOL;
            return false;
        }
        
        for ($i = floor(count($this->arr)/2); $i>= 1; $i--){  //从后逐步向前做非叶子节点的堆化
            while(true){
                $left_pos = 2*$i;
                $right_pos = 2*$i + 1;
                if ($this->arr[$i] >= $this->arr[$left_pos] && $this->arr[$i] >= $this->arr[$right_pos]){
                    break;
                } else {
                    if ($this->arr[$left_pos] > $this->arr[$right_pos]){
                        $tmp = $this->arr[$left_pos];
                        $this->arr[$left_pos] = $this->arr[$i];
                        $this->arr[$i] = $tmp;
                        
                    }
                }
            }
        }
    }
    
    
    
    
    
    
    
    
}



