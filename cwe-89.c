#include <stdio.h>
#include <stdlib.h>
#include <sqlite3.h>
#include <string.h>
void remove_newline(char []);
int main(int argc, char* argv[])
{
   sqlite3 *db;
   sqlite3_stmt *result;
   char usuario[100];
   char password[100];
   char *sql;
   char *error;
   int res;
   int iuser;
   int ipass;

   /* Open database */
   res = sqlite3_open("test.db", &db);
   if (res) {
      fprintf(stderr, "No puedo abrir la base de datos: %s\n", sqlite3_errmsg(db));
      exit(0);
   } else {
      fprintf(stderr, "Base de datos OK\n");
   }

   sql = "DROP TABLE IF EXISTS users";
   res = sqlite3_exec(db, sql, NULL, 0, &error);
   if (res != SQLITE_OK) {
      fprintf(stderr, "Error al borrar la tabla: %s\n", error);
      sqlite3_free(error);
      sqlite3_close(db);
   }

   /* Create SQL statement */
   sql = "CREATE TABLE users ("
      "`id` INTEGER PRiMARY KEY, "
      "`username` CHAR[25], "
      "`password` CHAR[25])";

   /* Execute SQL statement */
   res = sqlite3_exec(db, sql, NULL, 0, &error);
   if (res != SQLITE_OK) {
      fprintf(stderr, "Error al crear la tabla: %s\n", error);
      sqlite3_free(error);
      sqlite3_close(db);
   } else {
      fprintf(stdout, "Tabla creada!\n");
   }

   sql = "INSERT INTO users VALUES (1, 'admin', '123');"
      "INSERT INTO users VALUES (2, 'user_1', 'Abcuser1');"
      "INSERT INTO users VALUES (3, 'user_2', 'Abcuser2');"
      "INSERT INTO users VALUES (4, 'user_3', 'Abcuser3');";
   res = sqlite3_exec(db, sql, NULL, 0, &error);
   if (res != SQLITE_OK) {
      fprintf(stderr, "Error al llenar la tabla: %s\n", error);
      sqlite3_free(error);
      sqlite3_close(db);
   } else {
      fprintf(stdout, "Tabla Llena!\n");
   }

   printf("******************PRÁCTICA 2******************\n\n");
   printf("Ingrese Usuario: ");
   fflush(stdout);
   if(fgets(usuario, sizeof usuario, stdin) != NULL ) {
      remove_newline(usuario);
   };

   printf("Ingrese Contraseña: ");
   fflush (stdout);
   if(fgets(password, sizeof password, stdin) != NULL ) {
      remove_newline(password);
   };

   sql = "SELECT 1 from users where username = :username and password = :password";

   res = sqlite3_prepare_v2(db, sql, -1, &result, NULL);
   if (res != SQLITE_OK) {
      fprintf(stderr, "Error en la consulta: %s\n", sqlite3_errmsg(db));
      sqlite3_close(db);
      return(3);
   }
   iuser = sqlite3_bind_parameter_index( result, ":username" );
   ipass = sqlite3_bind_parameter_index( result, ":password" );
   sqlite3_bind_text( result, iuser, usuario, -1, SQLITE_STATIC );
   sqlite3_bind_text( result, ipass, password, -1, SQLITE_STATIC );

   if (sqlite3_step(result) == SQLITE_ROW) {
      printf("\nCredenciales CORRECTAS");
   } else {
      printf("\nCredenciales INCORRECTAS");
   }
   sqlite3_close(db);
   return 0;
}

void remove_newline(char line[])
{
   size_t len = strlen(line);
   if (len > 0 && line[len-1] == '\n') {
      line[--len] = '\0';
   }
}