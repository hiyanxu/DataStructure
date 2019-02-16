#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
堆：
（1）是一个完全二叉树。
（2）堆中每一个节点的值必须大于等于（或小于等于）其子树中每个节点的值（即堆顶元素是堆中最大或最小的元素）。

该处均以大顶堆为例
大顶堆：每个节点的值都大于子树中每个节点的值。
小顶堆：每个节点的值都小于子树中每个节点的值。

现在用数组构建一个堆：
因为堆其实就是一颗完全二叉树，所以，在用数组构建堆时，其下标和树的节点之间满足如下关系：
（1）根节点从下标1开始存储（下标0的元素空闲）。
（2）若父节点的下标为i，则其左子节点的下标为：2i；其右子节点的下标为：2i+1。
*/
typedef struct heap
{
	int arr[10];
}HEAP, *PHEAP;

/*
初始化一个大顶堆，堆顶元素为data
*/
void init(PHEAP h, int data){
	h->arr[1] = data;
	for (int i = 2; i < 10; ++i)  //其它数据初始化为0
	{
		h->arr[i] = 0;
	}

	return;
}


/*
插入数据
在大顶堆中插入数据，其实是一个堆化的过程
该处选择从下往上的堆化：
默认将待插入数据加入到数组的后面，然后用该数据和其父节点的数据作对比，若大于父节点，则和父节点交换，直到找到一个不大于其父节点或是堆顶了，则停止，该位置就是合适的位置
*/
void insert(PHEAP h, int data){
	//判断数组中还是否有位置
	if (h->arr[9] != 0)
	{
		printf("堆已满，不可再插入数据了哦~\n");
		exit();
	}

	//默认该数据在数组中是最后一个
	int last_pos = 0;
	for (int i = 2; i < 10; ++i)
	{
		if (h->arr[i] == 0)
		{
			last_pos = i;
			break;
		}
	}

	int parent_pos = last_pos/2;
	while(true){  //当前节点大于父节点，则交换，且不断向上比较堆化
		if (h->arr[last_pos] > h->arr[parent_pos])
		{
			h->arr[last_pos] = h->arr[parent_pos];
			h->arr[parent_pos] = data;
			last_pos = parent_pos;  //再将其父节点作为待比较位置
			parent_pos = last_pos/2;  //和新节点的父节点作比较
		} else if((h->arr[last_pos] <= h->arr[parent_pos]) || (last_pos == 1)){  //找到了合适位置，退出循环
			break;
		}
	}

	return;
}

/*
删除堆顶元素
删除堆顶元素操作：将堆顶元素和最后一个元素互换，然后剩下的就是被换过来的原最后一个元素的“从上往下”的堆化问题。
*/
void deleteTop(PHEAP h){
	//找到最后一个元素
	int last_pos = 0;
	for (int i = 2; i < 10; ++i)
	{
		if (h->arr[i] == 0)
		{
			last_pos = i-1;  //最后一个空元素的前一个元素，就是堆的最后一个元素
			break;
		}
	}

	//将最后一个元素和堆顶互换
	h->arr[1] = h->arr[last_pos];

	//然后做新换过来的栈顶元素的向下的“堆化”过程
	int left_pos;
	int right_pos;
	int top_pos = 1;
	while(true){
		//在向下堆化的过程中，需要选择将 当前节点、其左子节点、其右子节点 中的最大节点换到父节点的位置上
		left_pos = 2*top_pos;
		right_pos = 2*top_pos + 1;
		if (h->arr[top_pos] >= h->arr[left_pos] && h->arr[top_pos] <= h->arr[right_pos])  //当前就是最大的了
		{
			break;
		} else {
			if (h->arr[left_pos] > h->arr[right_pos])  //左边位置时最大的那个
			{
				int tmp = h->arr[top_pos];
				h->arr[top_pos] = h->arr[left_pos];
				h->arr[left_pos] = tmp;
				top_pos = left_pos;
			} else if(h->arr[right_pos] > h->arr[left_pos]){  //右边位置时最大的那个
				int tmp = h->arr[top_pos];
				h->arr[top_pos] = h->arr[right_pos];
				h->arr[right_pos] = tmp;
				top_pos = right_pos;
			}
		}
		
	}

	//上面向下“堆化”过程完成，则其已交换到合适的位置上，整个过程完成
	return;
}



























