<?php
require_once "config.php";


//Задание: 3. Реализовать сохранение данных с web-сервера в файл в удобном виде

$conn = getdb();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SHOW TABLES");
$tables = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
}

// Формирование JSON для каждой таблицы
$jsonData = array();
foreach ($tables as $table) {
    $sql = "SELECT * FROM " . $table;
    $result = $conn->query($sql);
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    $jsonData[$table] = $rows;
}

$conn->close();

header('Content-disposition: attachment; filename=data.json');
header('Content-type: application/json');

echo json_encode($jsonData, JSON_UNESCAPED_UNICODE);