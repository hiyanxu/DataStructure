#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
静态循环队列，采用数组实现，防止因为被删除元素浪费的空间（因为当删除元素时，需要在front删除，则front需要执行加一操作，则只会原来越浪费）
*/

/*
定义静态循环队列结构体
*/
typedef struct loop_queue
{
	int *arr;  //用于实现存储数据的数组，暂时默认定义5个长度
	int front;  //front的下标
	int rear;  //rear的下标
}*LOOP_QUEUE;

/*
初始化操作
*/
LOOP_QUEUE init(){
	LOOP_QUEUE lp;
	lp->arr = (int *)malloc(sizeof(int)*5);
	if (lp->arr == NULL)
	{
		printf("初始化-------分配内存失败\n");
		exit(0);
	}

	for (int i = 0; i < 5; ++i)
	{
		lp->arr[i] = 0;  //初始化为0
	}

	//初始为空，将front、rear都指向下标为0的位置
	lp->front = 0;
	lp->rear = 0;

	return lp;
}

/*
检查队列是否已满
1：已满
0：未满
*/
int is_full(LOOP_QUEUE lp){
	/*
	判断循环队列已满：
	因为我们默认非空元素都是非0的，则当front、rear重合且对应元素非0时，则表示队列已满
	*/
	if (lp->front == lp->rear && lp->arr[lp->front] != 0)
	{
		return 1;
	} else {
		return 0;
	}
}

/*
检查队列是否为空
true：为空
false：不为空
*/
int is_empty(LOOP_QUEUE lp){
	/*
	判断循环队列是否为空：
	当front、rear重合且对应元素为0时，表示队列为空
	*/
	if (lp->front == lp->rear && lp->arr[lp->front] == 0)
	{
		return 1;
	} else {
		return 0;
	}
}

/*
入队操作，均是在队尾入队
*/
void ins_queue(LOOP_QUEUE lp, int data){
	//因为是循环队列，则入队前需要检查队列是否已满
	if (is_full(lp))
	{
		printf("入队------------队列已满\n");
		exit(0);
	}

	//在rear处入队
	lp->arr[lp->rear] = data;
	lp->rear = (lp->rear + 1)%5;  //此操作保证了当下标超过了数组的最大个数时，需要进行“拐弯”回到下标从0开始的地方
}

/*
出队操作
*/
int out_queue(LOOP_QUEUE lp){
	if (is_empty(lp))
	{
		printf("出队-----------------队列为空\n");
		exit(0);
	}

	//在front处出队
	int res = lp->arr[lp->front];
	lp->arr[lp->front] = 0;
	lp->front = (lp->front + 1)%5;
	
	return res;
}

/*
遍历队列
*/
void trans_queue(LOOP_QUEUE lp){
	if (is_empty(lp))
	{
		printf("遍历队列-------------队列为空\n");
		exit(0);
	}

	//遍历队列数组
	for (int i = 0; i < 5; ++i)
	{
		printf("第%d个元素的值为：%d\n", i+1, lp->arr[i]);
	}
}

int main(int argc, char const *argv[])
{
	LOOP_QUEUE lp;
	lp = init();

	printf("\n");
	printf("---------开始入队元素----------\n");
	ins_queue(lp, 1);
	ins_queue(lp, 2);
	ins_queue(lp, 3);
	ins_queue(lp, 4);
	ins_queue(lp, 5);
	printf("---------入队元素结束----------\n\n");

	printf("---------开始遍历----------\n");
	trans_queue(lp);
	printf("---------遍历结束----------\n\n");

	printf("---------出队两个元素----------\n");
	int o1 = out_queue(lp);
	printf("出队第一个元素为：%d\n", o1);
	int o2 = out_queue(lp);
	printf("出队第二个元素为：%d\n", o2);
	printf("---------出队两个元素结束----------\n\n");

	printf("---------开始遍历----------\n");
	trans_queue(lp);
	printf("---------遍历结束----------\n\n");




	return 0;
}
























