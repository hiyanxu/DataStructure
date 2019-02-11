#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
双向链表实现LRU缓存淘汰算法
*/

/*
双向链表节点结构体
需要有两个指针，分别指向对应的前一个节点和后一个节点
*/
typedef struct node
{
	int data;
	struct node *prev;  //指向前一个节点的地址
	struct node *next;  //指向后一个节点的地址
}NODE, *PNODE;

/*
初始化链表
*/
PNODE init(){
	PNODE p;

	//申请一个节点作为首节点前的头结点（该节点没有什么实际意义）
	p = (PNODE)malloc(sizeof(NODE));
	if (p == NULL)
	{
		printf("初始化--------申请内存失败\n");
		exit(0);
	}
	p->data = 0;
	p->prev = NULL;  //该头节点没有前面的节点，所以prev指针为NULL；同样，因为该节点是头结点，还没有首节点，则next指针为NULL
	p->next = NULL;

	return p;
}

/*
插入节点-》按位置插入
双向链表插入节点有两种方式：
1、按位置插入：此种方式需要去遍历节点，然后找到对应位置节点的地址，然后挂载新节点。
2、按地址插入：此种方式我们已经知道了插入节点的位置，我们只需要通过prev指针直接找到其前一个节点的地址，然后挂载新节点
@param PNODE p 双向链表
@param int data 待插入的数据
@param int pos 需要插入的位置
*/
void insert(PNODE p, int data, int pos){
	//申请一个节点
	PNODE pNew = (PNODE)malloc(sizeof(NODE));
	if (pNew == NULL)
	{
		printf("插入节点---------申请内存失败\n");
		exit(0);
	}
	pNew->prev = NULL;
	pNew->next = NULL;
	pNew->data = data;

	//因为我们在传入pos时，是从1开始传入，所以，需要我们从头节点开始遍历
	PNODE ptmp = p;
	for (int i = 0; i < pos; ++i)
	{
		ptmp = ptmp->next;
	}

	//找到节点后，直接进行挂载新节点
	PNODE pprev = ptmp->prev;
	PNODE pnext = ptmp;

	//处理与前面节点的关系
	pNew->prev = pprev;
	pprev->next = pNew;

	//处理与后面节点的关系
	pNew->next = pnext;
	pnext->prev = pNew;	
}

/*
向后挂载节点
其中头结点仅仅next指针域指向第一个节点（首节点）
*/
void append(PNODE p, int data){
	//申请一个节点
	PNODE pNew = (PNODE)malloc(sizeof(NODE));
	if (pNew == NULL)
	{
		printf("插入节点---------申请内存失败\n");
		exit(0);
	}
	pNew->prev = NULL;
	pNew->next = NULL;
	pNew->data = data;

	//找到最后一个节点的地址
	PNODE ptmp = p;
	while(ptmp->next != NULL){
		ptmp = ptmp->next;
	}

	//将新节点挂载到最后一个节点上
	ptmp->next = pNew;  //将原最后一个节点的next指向新节点
	pNew->prev = ptmp;  //将新节点的prev指向原最后节点
}

/*
删除某个位置的节点
@param PNODE p lianb
@param int pos 删除位置
*/
void delete(PNODE p, int pos){
	PNODE ptmp = p;
	if (ptmp->next == NULL)
	{
		printf("删除节点--------链表已空，无法删除\n");
		exit(0);
	}

	//找到要删除的位置
	for (int i = 0; i < pos; ++i)
	{
		ptmp = ptmp->next;
		if (ptmp == NULL)
		{
			printf("删除节点--------请选择正确的位置\n");
			exit(0);
		}
	}

	//设置两个临时地址，保存被删除节点的prev和next指针指向的地址
	PNODE ptmp_prev = ptmp->prev;
	PNODE ptmp_next = ptmp->next;

	//将被删除节点的前一个节点指向被删除节点的后一个节点
	ptmp_prev->next = ptmp_next;
	ptmp_next->prev = ptmp_prev;
}

/*
查找某个数据是否在链表中
返回值：
0：0（或1）  0：表示不在链表中  1：表示在链表中
1：pos   若在链表中，表示该节点的位置
*/
int[] search(PNODE p, int value){
	int res[] = {0, 0};
	PNODE ptmp = p;
	int pos = 0;
	while(ptmp->next != NULL){
		pos++;
		if (ptmp->data == value)
		{
			res[0] = 1;
			res[1] = pos;
			break;
		} else {
			ptmp = ptmp->next;
		}
	}

	return res;
}

/*
LRU淘汰算法：最近最少使用淘汰策略
当有一个新数据被访问时：
1、若数据已在链表中，遍历得到该数据对应的节点，将其从原有位置删除，然后放到链表的头部。
2、若数据不再链表中：
	2.1、缓存未满，直接插入到链表头部。
	2.2、缓存已满，先删除最后一个元素，然后在插入到链表头部

@param PNODE p 缓存链表
@param int data 表示访问的缓存数据
*/
void lruEliminate(PNODE p, int data){
	/*
	模仿缓存的使用方法：
	默认缓存最大为5个整数（即大于等于5个整数时，表示缓存已满）
	*/

	//1、判断访问的数据是否在链表中
	int is_exist[] = search(p, data);
	if (is_exist[0] == 1)  //在链表中
	{
		if (is_exist[1] != 1)  //表示在链表中，但不是第一个
		{
			//将其删除，然后移动到第一个
			delete(p, is_exist[1]);
			insert(p, data, 1);
		}
	} else {  //不在链表中
		//判断链表是否已满
		PNODE ptmp = p;
		int count = 0;
		while(ptmp->next != NULL)
		{
			count++;
			ptmp = ptmp->next;
		}

		if (count == 5)
		{
			//不在链表中，且已满  先删除最后一个，然后在链表头插入
			delete(p, 5);
			insert(p, data, 1);
		} else {
			//在链表中，但未满  直接在链表头插入
			insert(p, data, 1);
		}
	}
}



int main(int argc, char const *argv[])
{
	




	return 0;
}















