<?php

session_start();


if (!isset($_SESSION['username'])) {

    header("location: login.php");
    exit;
}
?>


<?php
include 'dbinfo.php';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_car'])) {

    $title = sanitize_input($_POST['car_title']);
    $content = sanitize_input($_POST['car_content']);
    $image_url = isset($_POST['car_image_url']) ? sanitize_input($_POST['car_image_url']) : ''; 

    $sql = "INSERT INTO cars (title, content, image_url) VALUES ('$title', '$content', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "car added successfully";
    
        header("Location: car-index.php");
        exit();
    } else {
        echo "Error adding car: " . $conn->error;
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$conn->close();
?>