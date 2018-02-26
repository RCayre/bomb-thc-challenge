#include <stdio.h>
#include <stdlib.h>
#include <string.h>
/*
NOTE IMPORTANTE : les valeurs indiquées 10*sizeof... permettent d'obtenir la bonne chaîne sur le processeur de la raspberry pi (ARM)
Elles ne fonctionnent pas pour une architecture x86 (cela a motivé les changements effectués lors des derniers commits)
*/
static char hexconvtab[] = "0123456789abcdef";

char getkey(int n) {
	if (n == 24 || n==38) {
		return hexconvtab[0];
	}
	else if (n == 2 || n==29) {
		return hexconvtab[1];
	}
	else if (n == 8) {
		return hexconvtab[2];
	}
	else if (n == 11 || n==23) {
		return hexconvtab[3];
	}
	else if (n == 15) {
		return hexconvtab[4];
	}
	else if (n == 5) {
		return hexconvtab[5];
	}
	else if (n == 4 || n==39) {
		return hexconvtab[6];
	}
	else if (n == 16 || n==28) {
		return hexconvtab[7];
	}
	else if (n == 0 || n == 10 || n == 26) {
		return hexconvtab[8];
	}
	else if (n == 1 || n==18 || n==27 || n==35) {
		return hexconvtab[9];
	}
	else if (n == 3 || n==6 || n==17 || n==20) {
		return hexconvtab[10];
	}
	else if (n == 21 || n==22 || n==34 || n==36) {
		return hexconvtab[11];
	}
	else if (n == 9 || n==25 || n==31 || n==33 || n==37) {
		return hexconvtab[12];
	}
	else if (n == 12 || n==19 || n==30) {
		return hexconvtab[13];
	}
	else if (n == 32) {
		return hexconvtab[14];
	}
	else if (n==7 || n==13 || n==14) {
		return hexconvtab[15];
	}
	else return 0;

		
}
char *xor(char *clair,char *cle) {
	char *tmp = malloc(10*sizeof(cle));
	for (int i=0;i<10*sizeof(cle);i++) {
		tmp[i] = clair[i] ^ cle[i];
	}
	return tmp;
}

int main(int argc, char** argv) {
	char *key = malloc(40*sizeof(char));
	for (int i=0;i<40;i++) {
		key[i] = getkey(i);
	}
	
	if (argc == 2) {
		if (strcmp(argv[1],"a22dd78f1b8dbb2a1b716ed0858880e0e3da8d07c")==0) {
			printf("Forbidden input, sorry  !\n");
			exit(1);
		}
		char *r = xor(argv[1],key);
		for (int i=0;i<10*sizeof(r);i++) {
			printf("%02x",r[i]);
		}
		printf("\n");
	}
	return 0;
}
