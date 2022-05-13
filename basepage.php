<?php
include "dotenv.php";

$env = load_dotenv();

$conn = mysqli_connect($env["HOST"], $env["USER"], $env["PASSWORD"], $env["DATABASE"]);


?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        
        <title></title>
        <link rel="stylesheet" href="/.css">
    </head>
    <body>
    </body>
</html>