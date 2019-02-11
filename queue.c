#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
定义节点
包括数据data、指向下一节点的pNext指针
*/
typedef struct node
{
	int data;
	struct node *pNext;
}NODE, *PNODE;

/*
定义队列
*/
typedef struct queue
{
	PNODE pFront;  //队头  用于出队
	PNODE pRear;  //队尾  用于入队
}*QUEUE;

/*
队列初始化操作
*/
QUEUE init(){
	QUEUE q;

	//申请一个无实际意义的节点，用于队列的初始化
	PNODE pNew = (PNODE)malloc(sizeof(NODE));
	if (pNew == NULL)
	{
		printf("初始化-----------分配内存失败！\n");
		exit(0);
	}
	pNew->pNext = NULL;
	pNew->data = 0;

	q->pFront = pNew;
	q->pRear = pNew;

	return q;
}

/*
入队操作
*/
void ins_queue(QUEUE q, int data){
	//申请一个节点
	PNODE pNew = (PNODE)malloc(sizeof(NODE));
	if (pNew == NULL)
	{
		printf("入队----------申请新节点失败\n");
	}
	pNew->data = data;
	pNew->pNext = NULL;

	//在队尾入队
	q->pRear->pNext = pNew;
	q->pRear = pNew;
}

/*
出队操作
*/
int out_queue(QUEUE q){
	//从队头出队  front->pNext永远都指向队头的元素
	PNODE pTmp = q->pFront->pNext;
	int data = pTmp->data;
	q->pFront->pNext = pTmp->pNext;  //让pFront的next指针域指向原链表的下一个节点


	free(pTmp);
	return data;
}

/*
遍历操作
*/
void travel(QUEUE q){
	PNODE pTmp = q->pFront->pNext;  //找到指向的第一个节点
	int i = 0;
	while (pTmp != NULL)
	{
		printf("遍历-----------输出第%d个节点，节点数据为：%d\n", i, pTmp->data);
		pTmp = pTmp->pNext;
		i++;
	}
}


int main(int argc, char const *argv[])
{
	QUEUE q = init();
	ins_queue(q, 1);
	ins_queue(q, 2);
	ins_queue(q, 3);
	ins_queue(q, 4);

	printf("-------------开始遍历---------------\n");
	travel(q);
	printf("--------------结束遍历---------------\n\n");

	printf("出队一个元素：\n");
	int o1 = out_queue(q);
	printf("出队元素为：%d\n", o1);
	printf("出队完成。\n\n");

	printf("-------------开始遍历---------------\n");
	travel(q);
	printf("--------------结束遍历---------------\n\n");



	return 0;
}

























