#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
定义栈的每个节点结构（其实就是链表节点）
*/
typedef struct stackNode
{
	int data;
	struct stackNode *pNext;
}NODE, *PNODE;  //定义两个别名NODE、指针类型的PNODE

/*
定义栈结构
具有两个指针，分别指向栈顶和栈低
*/
typedef struct stack
{
	PNODE pHead;
	PNODE pBottom;	
}*STACK;

/*
栈的初始化操作
*/
STACK init(){
	STACK s;
	//先初始化一个链表，其实初始化链表操作就是初始化链表的头结点
	PNODE p = (PNODE)malloc(sizeof(NODE));
	if (p == NULL)
	{
		printf("初始化--------------分配内存失败\n");
		exit(0);
	}
	p->pNext = NULL;
	p->data = 0;

	/*
	在链表中该头结点是没有实际意义的节点，同样，将该节点作为栈的一个没有实际意义的节点，该节点并不存储数据，仅仅方便操作
	方便操作主要体现在将栈的头、尾节点均指向该节点，表示初始化了一个空的（该节点不算做栈内的节点）栈
	因为栈具有：先进后出、后进先出的特性，则栈元素的所有操作都在栈顶进行，所以，其实在栈的整个操作过程中，栈底指针是不变的。
	*/
	(*s).pBottom = p;
	(*s).pHead = p;

	return s;
}

/*
栈的遍历操作
*/
void trvalStack(STACK s){
	if (s->pHead == s->pBottom)
	{
		printf("遍历栈---------栈已经空了哦！\n");
		exit(0);
	}

	PNODE pTmp = s->pHead;
	int i = 1;
	while (pTmp != s->pBottom)
	{
		printf("第%d个节点的值为：%d\n", i, pTmp->data);
		pTmp = pTmp->pNext;
		i++;
	}
}

/*
栈的push操作
栈：后进先出、先进后出
所以，入栈、出栈操作总是在pHead处进行
*/
void push(STACK s, int data){
	//创建一个新节点，将该节点挂载到栈的最后一个元素PBottom上
	PNODE pNew = (PNODE)malloc(sizeof(NODE));
	if (pNew == NULL)
	{
		printf("push操作--------------分配内存失败\n");
		exit(0);
	}
	pNew->pNext = NULL;
	pNew->data = data;

	//将新节点挂载到pHead指向的节点上
	pNew->pNext = s->pHead;  //将新节点指向原有的第一个节点
	s->pHead = pNew;  //将head指向新节点
}

/*
栈的pop操作
*/
int pop(STACK s){
	//判断栈中是否还有节点
	if (s->pHead == s->pBottom)
	{
		printf("栈中已经没有元素了哦。。。。。。\n");
		exit(0);
	}

	//pop出一个元素  即将head指向的节点pop出去
	int res = s->pHead->data;
	PNODE pTmp = s->pHead->pNext;
	free(s->pHead);  //将pop出去的节点释放掉
	s->pHead = pTmp;  //将head指向下一个节点

	return res;
}

int main(int argc, char const *argv[])
{
	STACK s;
	s = init();
	push(s, 1);
	push(s, 2);
	push(s, 3);
	push(s, 4);
	push(s, 5);

	printf("----------开始遍历------------\n");
	trvalStack(s);
	printf("----------遍历结束------------\n\n");

	printf("-----------开始pop一个元素-----------\n");
	int p1 = pop(s);
	printf("-----------pop结束-----------，pop出的第一个元素是：%d\n\n", p1);

	printf("----------再次遍历------------\n");
	trvalStack(s);
	printf("----------再次遍历结束------------\n\n");

	return 0;
}




















