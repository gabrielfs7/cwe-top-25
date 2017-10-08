#include <stdio.h>

int main (void) {
    char last_name[20];

    printf ("Enter your last name: ");
    scanf ("%s", last_name);
    printf ("\n\nYou entered %s\n\n", last_name);

    return 0;
}
