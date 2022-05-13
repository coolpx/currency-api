<?php
include "dotenv.php";

$success = false;
$tried = false;
$id = 0;

$env = load_dotenv();

$conn = mysqli_connect($env["HOST"], $env["USER"], $env["PASSWORD"], $env["DATABASE"]);

if (isset($_GET["key"])) {
    $tried = true;

    $sql = 'SELECT id FROM users WHERE apiKey = "' . $_GET["key"] . '"';
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $id = mysqli_fetch_assoc($result)["id"];
        if ($id) {
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Get the ID from a CoolPixels Currency API key">
        
        <title>Check ID</title>
        <link rel="stylesheet" href="/.css">
    </head>
    <body>
        <h1>ID check</h1>
        <?php
        if ($tried) {
            if ($success) {
                echo "Got ID: <code>" . $id . "</code>";
            } else {
                echo "Failed to get ID";
            }
        } else {
            echo "<form>";
            echo "<input type='test' id='key' name='key' style='width: 70%; margin-bottom: 4px;' placeholder='API key' autocomplete='off'></input>";
            echo "<br>";
            echo "<input type='submit' value='Submit'>";
            echo "</form>";
        }
        ?>
    </body>
</html>