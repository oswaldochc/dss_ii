#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int getValueFromArray(int *array, int len, int index) {

    int value;

    //if (index < len) {
    if (index >= 0 && index < len) {
        value = array[index];
    } else {
        printf("Error: Value is %d\n", array[index]);
        value = -1;
    }

    return value;

}

int main(int argc, char* argv[])
{
    int numeros[3]={10,20,30};
    getValueFromArray(numeros, 3, -1);
}