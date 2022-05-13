<?php
include "../dotenv.php";

$success = false;
$msg = "An error occured and an API key was not generated.";

$env = load_dotenv();

$conn = mysqli_connect($env["HOST"], $env["USER"], $env["PASSWORD"], $env["DATABASE"]);

$key = exec("uuidgen -r");

$sql = "INSERT INTO users (apiKey) values (\"" . $key . "\")";

if (mysqli_query($conn, $sql)) {
    $msg = "Your key is " . $key;
    $success = true;
}

$resp = [];

if ($success) {
    $resp["key"] = $key;
}
$resp["message"] = $msg;

header("Content-Type: application/json");
echo json_encode($resp);
?>