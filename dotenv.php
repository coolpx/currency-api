<?php
function load_dotenv() {
    $file = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/.env");
    $pairs = explode("\n", $file);
    $result = array();
    foreach($pairs as $pair) {
        $pair = explode("=", $pair);
        $result[$pair[0]] = $pair[1];
    }
    return $result;
}
?>