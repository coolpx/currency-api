<?php
include "dotenv.php";

$id = 0;
$msg = "An error occured and an API key was not generated.";

$env = load_dotenv();

$conn = mysqli_connect($env["HOST"], $env["USER"], $env["PASSWORD"], $env["DATABASE"]);

$key = exec("uuidgen -r");

$sql = "INSERT INTO users (apiKey) values (\"" . $key . "\")";

if (mysqli_query($conn, $sql)) {
    $msg = $key . " is your API key. DO NOT LOSE IT! Only share it with people you absolutely trust. Anybody who has this key has access to all of your currency and can give it to anyone.";
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Create a new API key for CoolPixels Currency">
        
        <title>Register</title>
        <link rel="stylesheet" href="/.css">
    </head>
    <body>
        <h1>Register</h1>
        <p><?php echo $msg ?></p>
    </body>
</html>