#include <stdio.h>
#include <stdlib.h>
#include <sys/malloc.h>

/*
链表中每个节点的结构体：
(1)数据域
(2)指向下一个节点的指针域
*/
typedef struct LinklistNode{
    int data;
    struct LinklistNode *pNext;
}NODE, *PNODE;

PNODE init(PNODE p);
void append(PNODE p, int data);
void travel_list(PNODE p);

/*
链表的初始化操作：
创建一个头结点，将其next指针域置为空，将data数据域置为0
*/
PNODE init(PNODE p){
    p = (PNODE)malloc(sizeof(NODE));
    printf("init--------------指针（地址）的值为：OX%p\n",p);
    if(p == NULL){
        printf("初始化--------内存分配失败\n");
        exit(0);
    }
    p->pNext = NULL;
    p->data = 0;

    return p;
}

/*
向链表中增加节点
预留出来的头节点不作为第一个节点，头结点的下一个节点作为第一个存储真实数据的节点
*/
void append(PNODE p, int data){
    //初始化一个节点，然后将该节点挂到最后一个节点下面
    PNODE pTmp = (PNODE)malloc(sizeof(NODE));
    if(pTmp == NULL){
        printf("增加节点-----内存分配失败！\n");
        exit(0);
    }
    pTmp->pNext = NULL;

    //从头结点后面的第一个节点开始，遍历节点，找到最后一个节点的位置
    PNODE pTmp2 = p->pNext;
    PNODE PLast = p;
    while(pTmp2 != NULL){
        PLast = pTmp2;
        pTmp2 = pTmp2->pNext;
    }

    //将新节点挂载到最后一个节点上
    PLast->pNext = pTmp;
    pTmp->data = data;
}

/*
遍历节点
*/
void travel_list(PNODE p){
    PNODE pTmp = p->pNext;
    int i = 1;
    while(pTmp != NULL){
        printf("第%d个节点的数据为：%d\n", i, pTmp->data);
        i++;
        pTmp = pTmp->pNext;
    }
}

/*
获取节点长度
*/
int link_length(PNODE p){
    PNODE pTmp = p->pNext;
    int len = 0;
    while(pTmp != NULL){
        len++;
        pTmp = pTmp->pNext;
    }

    return len;
}

/*
节点插入操作
ins_p表示在第几个节点插入
*/
void insert(PNODE p, int data, int ins_p){
    int len = link_length(p);
    if (len == 0 || len < ins_p) {
        printf("插入节点--------------链表长度为0或请选择正确的节点插入位置\n");
    }

    //申请一个新节点
    PNODE pTmp = (PNODE)malloc(sizeof(NODE));
    pTmp->pNext = NULL;
    pTmp->data = data;

    //找到对应的位置，插入节点
    PNODE pTmp2 = p->pNext;
    for (int i = 1; i < ins_p; ++i)
    {
        pTmp2 = pTmp2->pNext;
    }

    //找到对应位置后，将新节点挂载到该节点上，该新节点的next指针指向后面的节点
    PNODE pTmp3 = pTmp2->pNext;
    pTmp2->pNext = pTmp;
    pTmp->pNext = pTmp3;
}

/*
删除节点操作
在链表p上，删除在del_p位置的节点
*/
void delete(PNODE p, int del_p){
    int len = link_length(p);
    if (len == 0 || len < del_p)
    {
        printf("删除节点------------链表长度为0或请选择正确的节点插入位置\n");
    }

    //找到对应位置，然后该节点
    PNODE pTmp2 = p->pNext;
    PNODE pLast = NULL;
    for (int i = 1; i < del_p; ++i)
    {
        pLast = pTmp2;
        pTmp2 = pTmp2->pNext;
    }

    //将被删除节点删除，将其上个节点直接指向该节点的下个节点
    pLast->pNext = pTmp2->pNext;

    //将被删除节点释放
    free(pTmp2);
}

int main(){
    PNODE p = NULL;
    printf("指针（地址）的值为：OX%p\n",p);
    p = init(p);
    printf("指针（地址tt）的值为：OX%p\n",p);
    
    append(p, 1);
    append(p, 2);
    append(p, 4);
    travel_list(p);

    printf("----------开始执行插入节点，在第2个节点上插入一个新节点3-------------\n");
    insert(p, 3, 2);
    printf("----------执行插入节点完毕-------------\n");

    travel_list(p);

    printf("----------开始执行插入节点，在第3个节点上插入一个新节点9-------------\n");
    insert(p, 9, 3);
    printf("----------执行插入节点完毕-------------\n");

    travel_list(p);

    printf("\n\n");
    printf("----------开始删除第2个节点-------------\n");
    delete(p, 2);
    printf("----------删除第2个节点完毕-------------\n\n");

    travel_list(p);


    return 0;
}
