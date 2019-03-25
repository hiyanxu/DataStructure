<?php
/*
 * 节点
 * 包括数据、下一节点
 * */
class Node{
    public $data;
    public $next_node;
    
    public function __construct($data, $node=null){
        $this->data = $data;
        $this->next_node = $node;
    }
    
    public function setNextNode($Node){
        $this->next_node = $Node;
    }
}

/*
 * 队列
 * */
class Queue{
    public $size;  //队列中节点的个数
    public $front;  //队头
    public $rear;  //队尾
    
    /*
     * 入队  在队尾入队
     * */
    public function enQueue($data){
        $node = new Node($data);  //新节点  该节点next节点为空
        if ($this->size == 0){  //空队列 直接将front、rear指向该节点
            $this->rear = $node;
            $this->front = $node;
        } else {
            $this->rear->setNextNode($node);  //将该新节点 挂载到 上一个节点
            $this->rear = $node;  //将队尾指向该新节点
        }
        
        $this->size++;
    }
    
    /*
     * 出队  队头出队
     * */
    public function outQueue(){
        $res = $this->front->data;
        
        //将该队头指向下一个节点
        $this->front = $this->front->next_node;
        $this->size--;
        
        return $res;
    }
    
    public function size(){
        return $this->size;
    }
}

$queue = new Queue();
$queue->enQueue(1);
$queue->enQueue(9);
$queue->enQueue(5);
$queue->enQueue(3);
$queue->enQueue(7);

var_dump($queue->outQueue());
var_dump($queue->size());
var_dump($queue->outQueue());
var_dump($queue->size());





