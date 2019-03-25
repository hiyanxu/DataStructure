<?php
/*
 * 定义node节点类
 * 该类有data、next_node项
 * */
class Node{
    public $data;
    public $next_node;
    
    public function __construct($data, $node=null){
        $this->data = $data;
        $this->next_node = $node;
    }
}

class Stack{
    public $size=0;  //链表中节点的个数
    public $top_node;  //栈顶的节点
    
    /*
     * 入栈
     * */
    public function push($data){
        $node = new Node($data, $this->top_node);  //让其指向原top节点
        
        //将size+1，现有栈top节点指向该新的$node节点
        $this->size++;
        $this->top_node = $node;
        
        return true;
    }
    
    /*
     * 出栈
     * */
    public function pop(){
        //将栈顶元素出栈
        $res = $this->top_node->data;
        $this->size--;
        
        return $res;
    }
    
    /*
     * 栈大小
     * */
    public function size(){
        return $this->size;
    }
}

//创建一个栈，并入栈几个节点
$stack = new Stack();
$stack->push(2);
$stack->push(6);
$stack->push(4);
$stack->push(9);

var_dump($stack->pop());
var_dump($stack->size());









