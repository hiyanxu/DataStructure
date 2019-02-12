#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
跳表实现：
通过对单链表上浮实现索引列，减少查找需要遍历带来的时间复杂度的增长

跳表索引节点：
除了next指针域外，还需要包含一个down指针域，指向该索引所指向的数据

底层链表节点：
普通单链表节点
*/

