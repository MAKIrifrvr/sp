/*	Juan Paulo D. Banares
	2012-43877
	UV-2L
	"CMSC 21 PROJECT"	*/
#include<stdio.h>
#include<stdlib.h>
#include<string.h>

typedef struct record_tag{
	char studNum[10];
	char name[20];
	char degree[10];
	struct record_tag *next;
	struct record_tag *prev;
	struct record_tag *friends;
}record;

void view(record *head,record *tail){
	record *ptr;

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
void add(record **h, record **t, record *newnode,int *numStud){
	record *temp;
	
	if((*h)->next->next==NULL){//Add if there is empty list
		newnode->prev=(*h);
		newnode->next=(*t);
		(*h)->next=newnode;
		(*t)->prev=newnode;
	}
	else{//Add record if there is a linked-list
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

void edit(record **h,record **t,char studNum[]){
	record *temp;
	char name[20],degree[10];
	if((*h)->next==(*t)) printf("Record is Empty!\n");//Record is Empty
	else{
		temp=(*h)->next;
		while(1==1){
			if(temp==(*t)){
				printf("|Contact Not Found!\n");
				printf("----------------------------------------------\n");
				break;
			}
			else if(strcmp(temp->studNum,studNum)==0){
				printf("|Enter New Name:");
				scanf("%s",temp->name);
				printf("|Enter New Degree Name:");
				scanf("%s",temp->degree);
				printf("|Student Edited!\n");
				printf("----------------------------------------------\n");
				break;
			}
			temp=temp->next;
		}
	}
}

void deleteStudent(record **h, record **t, char studNum[], int *numStud){
	record *temp;
	
	if((*h)->next==(*t)) printf("Record is Empty!\n");//Record is Empty
	else{//Record has content
		temp=(*h)->next;
		while(1==1){
			if(temp==(*t)){
				printf("|Contact Not Found!\n");
				printf("----------------------------------------------\n");
				break;
			}
			else if(strcmp(temp->studNum,studNum)==0){
				temp->next->prev=temp->prev;
				temp->prev->next=temp->next;
				free(temp);
				printf("|Student Deleted!\n");
				printf("----------------------------------------------\n");
				*numStud=*numStud-1;
				break;
			}
			temp=temp->next;
		}
	}
}

void deleteAll(record **h, record **t, int *numStud){
	record *temp;
	
	if((*h)->next==(*t)) printf("Record is Empty!\n");//Record is Empty
	else{//Record has content
		temp=(*h)->next;
		while(temp!=(*t)){
			(*h)->next=temp->next;
			(*h)->next->prev=NULL;
			free(temp);
			temp=(*h)->next;
		}
		printf("<-----------------DELETED ALL!--------------->\n");
		*numStud=0;
	}	
}

void load(record **h, record **t, int *numStud){
	FILE *fp;
	record *newnode;
	int num,i;
	
	printf("%d\n",*numStud);
	fp=fopen("contacts.txt","r");
		if(fp==NULL) printf("File is Empty!\n");
		else fscanf(fp,"%d\n",&num);//Get the number of contacts from text file
			while(!feof(fp)){
				if(num==0) break;
				newnode=(record*)malloc(sizeof(record));
				newnode->next = newnode->prev = newnode->friends=NULL;
				for(i=0;i<num;i++){
					fscanf(fp,"%s\n",newnode->name);
					fscanf(fp,"%s\n",newnode->studNum);
					fscanf(fp,"%s\n",newnode->degree);
					add(h,t,newnode,numStud);
				}
			}
	fclose(fp);
}

void save(record *head, record *tail, int num){
	FILE *fp;
	int i;
	record *temp;
	temp=head->next;
	fp=fopen("contacts.txt","w");
		fprintf(fp,"%d",num);
		for(i=0;i<num;i++){
			fprintf(fp,"\n%s\n",temp->name);
			fprintf(fp,"%s\n",temp->studNum);
			fprintf(fp,"%s",temp->degree);
			temp=temp->next;
		}
	fclose(fp);
	printf("<--------------------SAVED1------------------>\n");
}

//Print Menu
void menu(record **head, record **tail, int *numStud){
	int choice,i=0;
	char c,studNum[20], name[20], degree[10];
	record *newnode;
	
	do{
		printf("\n********MENU**********\n");
		printf("[1] Add Student\n");
		printf("[2] Add Friend Student\n");
		printf("[3] Edit Student\n");
		printf("[4] Delete Student\n");
		printf("[5] Delete a Friend of a Student\n");
		printf("[6] Delete all Students Including Friends\n");
		printf("[7] Delete all Friends of a Student\n");
		printf("[8] View Students\n");
		printf("[9] View Friend/s of a Student\n");
		printf("[10] Load Data\n");
		printf("[11] Save Data\n");
		printf("[12] Exit\n");
		printf("***********************\n");
		printf("Choice: ");
		scanf("%d",&choice);
		
		switch(choice){
			case 1://To Add Student
				//Initialization and allocation
				newnode=(record*)malloc(sizeof(record));
				newnode->next = newnode->prev = newnode->friends=NULL;
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
			case 2://To Add Friend on Student
				break;
			case 3://To Edit Student
				printf("-----------------------EDIT--------------------\n");
				printf("|Enter Student Number to Edit:");
				scanf("%s",studNum);
				edit(head,tail,studNum);
				break;
			case 4://To Delete Student
				printf("----------------------DELETE-------------------\n");
				printf("|Enter Student Number to be Deleted:");
				scanf("%s",studNum);
				deleteStudent(head,tail,studNum,numStud);
				break;
			case 5://To Delete a Friend of a Student
				break;
			case 6://To Delete all students including friends
				deleteAll(head,tail,numStud);
				break;
			case 7://To Delete all Friends of a student
				break;
			case 8://To View Students
				view(*head,*tail);
				break;
			case 9://To View Friends of a student
				break;
			case 10://To Load Data
				printf("%d\n",*numStud);
				load(head,tail,numStud);
				break;
			case 11://To Save Data
				save(*head,*tail,*numStud);
				break;
			case 12://Exit
				printf("Exit!\n");
				break;
			default: //Will print if not in choice
				printf("Not in Choices\n");
				break;
		}
	}while(choice!=12);
}

//To deallcoate the memory
void dealloc(record **head, record **tail){
	record *ptr;
	//Deallocation of Linked-list of Students
	while((*head)!=NULL){
		ptr=(*head);
		//Deallocation of Linked-list of Friends
		while((*head)->friends!=NULL){
			ptr=(*head)->friends;
			if((*head)->friends->next==(*head)){//Deallocation of one and only friend
				free(ptr);
				(*head)->friends=NULL;
				ptr=(*head);
			}
			else{//Deallocation of Friends
				(*head)->friends=ptr->next;
				free(ptr);
			}
		}
		
		if((*head)->next==NULL && (*head)->prev==NULL){//Deallocation of head and tail
			free(ptr);
			(*head)=(*tail)=NULL;
		}
		else{//Deallocation of Students
			ptr->next->prev=NULL;
			(*head)=ptr->next;
			free(ptr);
		}
	}
}


main(){
	record *head,*tail;
	int numStud=0;//Number of students
	
	//Dummy Nodes
	head=(record*)malloc(sizeof(record));
	tail=(record*)malloc(sizeof(record));
	head->prev=tail->next = NULL;
	head->friends=tail->friends=NULL;
	head->next=tail;
	tail->prev=head;
	
	menu(&head,&tail,&numStud);
	dealloc(&head,&tail);
}
