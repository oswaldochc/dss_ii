<?php
require_once "Log.php";
function openDbConnection() {
    $conn = new PDO("mysql:host=localhost;dbname=myDB", 'root', 'testpwd');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
try {
    openDbConnection();
} catch (Exception $e) {
    echo 'Error: Application could not establish the connection';
    $log = new Log();
    $log->general($e->getMessage());
}