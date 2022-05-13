<?php
include "dotenv.php";

$tried = false;
$success = false;
$currency = -1;

$env = load_dotenv();

$conn = mysqli_connect($env["HOST"], $env["USER"], $env["PASSWORD"], $env["DATABASE"]);

if (isset($_GET["key"])) {
    $tried = true;
    
    $sql = 'SELECT currency FROM users WHERE apiKey = "' . $_GET["key"] . '"';
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $currency = mysqli_fetch_assoc($result)["currency"];
        if ($currency != NULL) {
            $success = true;
        }
    }
}
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
        <h1>Free Money</h1>
        <?php
        if ($tried) {
            if ($success) {
                echo "Got currency: <code>" . $currency + 1 . "</code>";

                $sql = "UPDATE users SET currency = " . $currency + 1 . " WHERE apiKey = \"" . $_GET["key"] . "\"";
                mysqli_query($conn, $sql);

                echo "<br>You have been given one currency";
            } else {
                echo "Failed to get currency";
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