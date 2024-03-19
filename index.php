<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 20px;
            }
            th {
                background-color: #f2f2f2;
                border: 1px solid #dddddd;
                padding: 8px;
                text-align: left;
            }
            td {
                border: 1px solid #dddddd;
                padding: 8px;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:nth-child(odd) {
                background-color: #ffffff;
            }
            h2 {
                margin-top: 20px;
                margin-bottom: 10px;
                font-size: 18px;
            }
            .row{
                margin: 10px;
            }
            button{
                margin-bottom: 420px;
            }
        </style>
        <script>
            function downloadJson() {
                window.location.href = 'export.php';
            }
        </script>
    </head>
    <body>
        <div class="container">

            <div class="row">
                <form class="form-horizontal" action="functions.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <button type="submit" name="Import" class="btn btn-primary button-loading">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="form-horizontal">
                <h4>Imported files:</h4>
                <ul>
                    <?php
                    if(isset($_SESSION['imported_files'])) {
                        foreach($_SESSION['imported_files'] as $file) {
                            echo "<li>$file</li>";
                        }
                    } else {
                        echo "<li>No files imported yet</li>";
                    }
                    ?>
                </ul>
            </div>

            <?php
                require_once  "get_all_records.php";
                get_all_records();
            ?>

            <button class="btn btn-primary button-loading" onclick="downloadJson()">Скачать данные в JSON</button>
        </div>
    </body>
</html>