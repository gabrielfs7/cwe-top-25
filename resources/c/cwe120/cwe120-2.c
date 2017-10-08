#include <stdio.h>

char manipulateName(char name[]) {
    char buf[20];

    strcpy(buf, name);

    return buf;
}

int main (void) {
    char last_name[100];

    printf ("Enter your last name: ");
    scanf ("%s", last_name);
    printf ("\n\nYour updated name %s\n\n", manipulateName(last_name));

    return 0;
}
