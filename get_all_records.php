<?php
require_once "config.php";

//Задание: 2.c. Отображение данных из СУБД по визуальной аналогии с csv-файлом (в виде таблицы).
function get_all_records()
{
    $conn = getdb();

    // Запрос для получения списка таблиц
    $result = $conn->query("SHOW TABLES");
    if ($result) {
        // Перебор таблиц
        while ($row = $result->fetch_row()) {
            $tableName = $row[0];
            echo "<h2>$tableName</h2>";

            $columnsResult = $conn->query("SHOW COLUMNS FROM $tableName");
            if ($columnsResult) {
                echo "<table>";
                echo "<tr>";
                while ($column = $columnsResult->fetch_assoc()) {
                    echo "<th>{$column['Field']}</th>";
                }
                echo "</tr>";

                // Получение данных из таблицы
                $dataResult = $conn->query("SELECT * FROM $tableName");
                if ($dataResult) {
                    while ($data = $dataResult->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($data as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                }
                echo "</table>";
            }
        }
    } else {
        echo "Ошибка выполнения запроса: " . $conn->error;
    }
    $conn->close();
}