<?php
require_once "../classes/Station.php";

if (isset($_POST["name"], $_POST["local_government"], $_POST["capacity"])) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $local_government = htmlspecialchars(trim($_POST["local_government"]));
    $capacity = intval(trim($_POST["capacity"]));

    if (empty($name) || empty($local_government) || empty($capacity)) {
        echo "All fields are required!";
        exit();
    }

    if ($capacity <= 0) {
        echo "Please enter a valid capacity!";
        exit();
    }

    $station = new Station();
    $result = $station->insert_station($name, $local_government, $capacity);

    echo $result ? "Station saved successfully!" : "Error: Unable to save station!";
} else {
    echo "Invalid request!";
}