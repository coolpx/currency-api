<?php
include "../dotenv.php";

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

$resp = [];

$resp["id"] = -1;
$resp["message"] = "Failed to get ID";

if ($tried) {
    if ($success) {
        $resp["id"] = $id;
        $resp["message"] = "Got ID";
    }
} else {
    $resp["message"] = "Missing item in request body: key";
}

header("Content-Type: application/json");
echo json_encode($resp);
?>