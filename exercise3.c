#include<stdio.h>
#include<stdlib.h>
#include<string.h>


typedef struct employee_tag{
	char studNum[20];
	char name[20];
	char degree[10];
	struct employee_tag *next;
	struct employee_tag *prev;
}employee;


void view(employee *head,employee *tail){
	employee *ptr;

	ptr=head->next;
	if(ptr->next==NULL){
		printf("Record is Empty\n");
	}
	else{
		printf("\n\t===========================\n");
		printf("\t|    Student Directory    |\n");
		printf("\t===========================");
		while(ptr!=tail){
			printf("\n\tName: %s\n",ptr->name);
			printf("\tStudent Number: %s\n",ptr->studNum);
			printf("\tDegree: %s\n",ptr->degree);
			ptr=ptr->next;
		}
	}
	printf("\n");

}

//Add Student
void add(employee **h, employee **t, employee *newnode,int *numStud){
	employee *temp;
	
	if((*h)->next->next==NULL){	//Add if there is empty list
		newnode->prev=(*h);
		newnode->next=(*t);
		(*h)->next=newnode;
		(*t)->prev=newnode;
	}
	else{	//Add employee if there is a linked-list
		temp=(*h)->next;
		
		while(temp!=(*t) && strcmp(temp->studNum,newnode->studNum)<0){
			temp=temp->next;
		}
		
		if(temp->prev==(*h)){
			newnode->next=temp;
			newnode->prev=temp->prev;
			temp->prev->next=newnode;
			temp->prev=newnode;
		}
		else{
			newnode->next=temp;
			newnode->prev=temp->prev;
			temp->prev->next=newnode;
			temp->prev=newnode;
		}
	}
	*numStud=*numStud+1;
}

void menu(employee **head, employee **tail, int *numStud){
	int choice,i=0;
	char c,studNum[20], name[20], degree[10];
	employee *newnode;
	
	do{
		printf("\nMain Menu: \n\n");
		printf("[1] View\n");
		printf("[2] Add\n");
		printf("[3] Delete\n");
		printf("[4] Sort\n");
		printf("[5] Exit\n\n");
		printf("Choice: ");
		scanf("%d",&choice);
		
		switch(choice){
			case 1://To View List
				view(*head,*tail);
				break;
			case 2://add employee
				//Initialization and allocation
				newnode=(employee*)malloc(sizeof(employee));
				newnode->next = newnode->prev = NULL;
				printf("-------------ADD-----------\n");
				printf("|Name:");
				scanf("%s",newnode->name);
				printf("|Student Number:");
				scanf("%s",newnode->studNum);
				printf("|Degree:");
				scanf("%s",newnode->degree);
				add(head,tail,newnode,numStud);
				printf("|Student Added!\n");
				printf("---------------------------\n");
				break;
			case 3://To Delete Student
				printf("----------------------DELETE-------------------\n");
				printf("|Enter Student Number to be Deleted:");
				scanf("%s",studNum);
				//deleteStudent(head,tail,studNum,numStud);
				break;
			case 4://To Sort List
				//save(*head,*tail,*numStud);
				break;
			case 5://Exit
				printf("Exit!\n");
				break;
			default: //Will print if not in choice
				printf("Not a valid input\n");
				break;
		}
	}while(choice!=5);
}


void main(){
	employee *head,*tail;
	int employeeCount=0;	//Number of employee
	
	//Dummy Nodes
	head=(employee*)malloc(sizeof(employee));
	tail=(employee*)malloc(sizeof(employee));
	head->prev=tail->next = NULL;
	head->next=tail;
	tail->prev=head;
	
	menu(&head,&tail,&employeeCount);
	//dealloc(&head,&tail);
}