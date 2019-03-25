<?php
// /*
//  * 节点类
//  * 数据data、左子树节点、右子树节点
//  * */
// class Node{
//     public $data;
//     public $left;
//     public $right;
    
//     public function __construct($data){
//         $this->data = $data;
//     }
// }

// /*
//  * 树：其实就是有了一个根节点
//  * */
// class Tree{
//     public $root_node;
//     public $depth = 0;
    
//     public function __construct($data){
//         $this->init($data);
//     }
    
//     private function init($data){
//         $node = new Node($data);
//         $this->root_node = $node;
//     }
    
//     /*
//      * 增加节点
//      * $data：数据
//      * $lr：1、左子树增加节点  2、右子树增加节点
//      * */
//     public function addNode($data, $lr=1, Node $node){
//         $new_node = new Node($data);
//         if ($lr == 1){
//             $node->left = $new_node;  //将该新节点 挂载到$node节点的左子树下
//         } else {
//             $node->right = $new_node;
//         }
//         $this->depth++;
//     }
    
//     /*
//      * 前序遍历  根左右
//      * */
//     public function preorderTrans(Node $node){
//         if (!empty($node)){
//             echo '前序遍历————————根节点的值为：'.$node->data."\n";
//             $this->preorderTrans($node->left);
//             $this->preorderTrans($node->right);  //该处有问题，因为每次$node都会重新被赋值
//         } else {
//             echo 'meiyoule'."\n";
//         }
//     }
    
//     /*
//      * 中序遍历  左根右
//      * */
//     public function inorderTrans(Node $node){
//         if (!empty($node)){
//             //中序遍历 左节点
//             $this->inorderTrans($node->left);
//             echo '中序遍历——————————根节点的值为：'.$node->data."\n";
//             $this->inorderTrans($node->right);
//         } else {
//         }
//     }
// }


/**
 * 树类  其实就是一个由根节点构成的
 * @author hiyanxu
 */
class Tree{
    //节点值  左子树、右子树
    public $data;
    public $left;
    public $right;
    
    public function __construct($data){
        $this->data = $data;
    }
    
    /*
     * 增加一个节点
     * */
    public function addNode($data, $lr=1, Tree $tree){
        $node = new static($data);
        if ($lr == 1){
            $tree->left = $node;
        } else {
            $tree->right = $node;
        }
    }
    
    /*
     * 前序遍历  根左右
     * */
    public function preorderTrans(){
        if (!empty($this->data)){
            echo "前序遍历——————根节点值为：".$this->data."\n";
            if (!empty($this->left)){
                $this->left->preorderTrans();
            }
            if (!empty($this->right)){
                $this->right->preorderTrans();
            }            
            
        }
    }
    
    public function inorderTrans(){
        if (!empty($this->left)){
            $this->left->inorderTrans();
        }
        if (!empty($this->data)){
            echo "中序遍历——————根节点值为：".$this->data."\n";
        }
        if (!empty($this->right)){
            $this->right->inorderTrans();
        }
    }
    
    /*
     * 层次遍历  广度优先遍历
     * */
    public function arrrangeTrans(){
        $arr[] = $this;
        while (count($arr) > 0){
            $node = array_shift($arr);
            if (!empty($node->data)){
                echo "层次遍历——————根节点值为：".$node->data."\n";
                if (!empty($node->left)){
                    $arr[] = $node->left;
                }
                if (!empty($node->right)){
                    $arr[] = $node->right;
                }
            }
        }
    }
    
}


$tree = new Tree(5);

$tree->addNode(1, 1, $tree);
$tree->addNode(3, 2, $tree);
$tree->addNode(2, 1, $tree->left);
$tree->addNode(7, 1, $tree->left->left);

$tree->preorderTrans();
$tree->inorderTrans($tree->root_node);
echo "\n\n";
$tree->arrrangeTrans();



















