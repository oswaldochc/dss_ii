#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char* argv[])
{
    char last_name[20];
    printf ("Ingresa tu apellido: ");
    if(fgets(last_name, sizeof last_name, stdin)) {
        printf("%s", last_name);
    }
}