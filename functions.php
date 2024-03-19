<?php
session_start();
require_once "config.php";

if(isset($_POST["Import"])){
    //Вызов функции подключения к бд
    $conn = getdb();

    $tableName = preg_replace('/[0-9]+/', '', preg_replace('~import|[_\"\'\-\+\!\@\#\$\%\^\&\*\(\)\[\]\{\}\;\:\<\>\?\,\.\~\`\=\|\\\\/]~', '', pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)));

    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");

        $headers = fgetcsv($file, 10000, ";");
        $columnCount = count($headers);

        $columns = implode(',', $headers);

        $placeholders = implode(',', array_fill(0, $columnCount, '?'));

        $stmt = $conn->prepare("INSERT INTO $tableName ($columns) VALUES ($placeholders)");

        //Задание: 2.a. Загрузку данных из csv-файлов такого формата в СУБД
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
        {
            if (count($getData) != $columnCount) {
                $count = count($getData);
                echo "<script type=\"text/javascript\">
                        alert(\"Invalid File: Incorrect number of data elements. $getData[0] $count != $columnCount\");
                        window.location = \"index.php\"
                      </script>";
                exit;
            }

            $getData = array_map(function($value) {
                return $value === "" ? NULL : $value;
            }, $getData);

            $stmt->execute($getData);
        }

        fclose($file);

        //Задание: 2.b. Просмотр списка загруженных файлов
        $imported_files = isset($_SESSION['imported_files']) ? $_SESSION['imported_files'] : array();
        $imported_files[] = $_FILES["file"]["name"];
        $_SESSION['imported_files'] = $imported_files;

        echo "<script type=\"text/javascript\">
                alert(\"CSV File has been successfully Imported.\");
                window.location = \"index.php\"
              </script>";
    }
}