<?php
include "../dotenv.php";

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

$resp = [];

$resp["currency"] = -1;
$resp["message"] = "Failed to get currency";

if ($tried) {
    if ($success) {
        $sql = "UPDATE users SET currency = " . $currency + 1 . " WHERE apiKey = \"" . $_GET["key"] . "\"";
        mysqli_query($conn, $sql);

        $resp["message"] = "You have been given one currency";
        $resp["currency"] = $currency + 1;
    }
} else {
    $resp["message"] = "Missing item in request body: key";
}

header("Content-Type: application/json");
echo json_encode($resp);
?>