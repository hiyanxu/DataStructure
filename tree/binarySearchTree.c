#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
二叉查找树：
	定义：二叉查找树要求，在树种的任意一个节点，其左子树中的每个节点的值，都要小于这个节点的值；右子树节点的值都要大于这个节点的值。
*/

//二叉树节点：一个数据域、左指针域、右指针域
typedef struct node{
	int data;
	struct node *left;
	struct node *right;
}NODE, *PNODE;  //对节点定义一个别名和一个指针别名

/*
初始化一个二叉查找树
*/
PNODE init(int data){
	PNODE pnew = (PNODE)malloc(sizeof(NODE));
	pnew->data = data;  //根节点设置为data，左右子树设置为NULL
	pnew->left = NULL;
	pnew->right = NULL;

	return pnew;
}

/*
二叉查找树——》插入操作
根据大小进行查找：
若比当前节点小，则判断其左子树有没有，若没有，则直接作为当前节点的左子树挂载上；若有，则递归遍历其左子树，直到找到合适为空的位置，挂载。
若比当前节点大，则判断其右子树有没有，若没有，则直接作为当前节点的右子树挂载上；若有，则递归遍历其右子树，直到找到合适为空的位置，挂载。
*/
void insert(PNODE t, int data){
	if (data > t->data)  //大于当前数据且其右子树为空，则直接挂在到其右子树中即可
	{
		if (t->right == NULL)
		{
			PNODE pnew = (PNODE)malloc(sizeof(NODE));
			pnew->data = data;
			pnew->left = NULL;
			pnew->right = NULL;

			t->right = pnew;  //挂在上该节点

			return;
		} else {  //没有找到，则接着递归遍历其右子树，找合适位置，插入数据
			insert(t->right, data);
		}
	} else if (data < t->data){  //小于当前数据，在该数据的左子树里面
		if (t->left == NULL)
		{
			PNODE pnew = (PNODE)malloc(sizeof(NODE));
			pnew->data = data;
			pnew->left = NULL;
			pnew->right = NULL;

			t->left = pnew;  //挂在上该节点

			return;
		} else {  //没有找到，继续在当前节点的左子树里面找合适位置插入
			insert(t->left, data);
		}
	}
}

/*
中序遍历树
因为二叉查找树其左子树中的每个节点的值，都要小于这个节点的值，右子树节点的值都要大于这个节点的值，则中序遍历会正好遍历出一个有序的序列出来
*/
void travel(PNODE t){
	if (t == NULL)
	{
		return;
	}

	//中序遍历：左根右（遍历左子树、根节点、右子树）
	travel(t->left);
	printf("%d\n", t->data);
	travel(t->right);
}


/*
删除节点：
（1）若被删除节点没有子树，则将其父节点指向该节点的指针置为NULL，节点free。
（2）若被删除节点只有一个子树，将该节点free，将其子树节点挂载到其父节点下。
（3）若被删除节点左右子树都有，则将
*/
void delete(PNODE t, int data){
	//定义一个临时指针，存储找到该节点后其父节点的地址
	PNODE ptmp;
	int leftOrRight;  //父节点的左子树还是右子树是该节点
	//遍历找到该节点
	while(t->data != data){
		ptmp = t;
		if (data > t->data)  //大于当前节点，则查询右子树
		{
			leftOrRight = 2;
			t = t->right;
		} else {  //小于当前节点，查询左子树
			leftOrRight = 1;
			t = t->right;
		}
	}

	//找到该节点后，判断该节点的子树情况
	if (t->left == NULL && t->right == NULL)  //左右子树均为null，直接删除节点
	{
		if (leftOrRight == 1)
		{
			ptmp->left = NULL;
			free(t);  //释放当前节点
		} else if (leftOrRight == 2)
		{
			ptmp->right = NULL;
			free(t);
		}
	} else if ((t->left == NULL && t->right != NULL) || (t->left != NULL && t->right == NULL)) {  //只有一个子树
		if ((t->left == NULL && t->right != NULL) && $leftOrRight == 1)
		{
			ptmp->left = t->right;
			free(t);
		} else if((t->left == NULL && t->right != NULL) && $leftOrRight == 2){
			ptmp->right = t->right;
			free(t);
		} else if((t->left != NULL && t->right == NULL) && $leftOrRight == 1){
			ptmp->left = t->left;
			free(t);
		} else if((t->left != NULL && t->right == NULL) && $leftOrRight == 2){
			ptmp->right = t->left;
			free(t);
		}
	} else if (t->left != NULL && t->right != NULL) {  //左右子树均不为NULL
		//遍历其右子树，找到最小的一个值
		PNODE pmin;
		PNODE ptmp2 = t->right;
		while(ptmp2->left != NULL){  //在这个右子树构成的树中，向左查找最小值
			ptmp2 = ptmp2->left;
		}

		//找到了该待删除节点右子树中的最小值
		if (leftOrRight == 1)
		{
			ptmp->left = ptmp2;
			free(t);
		} else if (leftOrRight == 2)
		{
			ptmp->right = ptmp2;
			free(t);
		}
	}
}


int main(){
	//初始化一个树
	PNODE t = init(33);

	printf("---------开始插入数据---------\n");

	insert(t, 17);
	insert(t, 13);
	insert(t, 18);
	insert(t, 16);
	insert(t, 25);
	insert(t, 19);
	insert(t, 27);
	insert(t, 50);
	insert(t, 34);
	insert(t, 58);
	insert(t, 51);

	printf("---------插入数据结束---------\n\n");


	printf("---------开始遍历---------\n");
	travel(t);

	printf("---------遍历结束---------\n\n");

	return 0;
}

