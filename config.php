<?php
//Функция для подключения к бд
function getdb(){
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $db = "db_php";
    try {
        $conn = mysqli_connect($servername, $username, $password, $db);
    }
    catch(exception $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
