<?php

require_once('../includes/Client.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title']) && isset($_POST['body']) && isset($_FILES['image']) && isset($_POST['creator'])) {

    $title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES, "UTF-8");
    $body = htmlspecialchars(trim($_POST['body']), ENT_QUOTES, "UTF-8");
    $creator = htmlspecialchars(trim($_POST['creator']), ENT_QUOTES, "UTF-8");
    $image = $_FILES['image'];

    $uploadDir = "../../imagesNews/";

    $imageFileName = uniqid() . '-' . basename($image['name']);
    $uploadFilePath = $uploadDir . $imageFileName;

    if (move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
        Client::addNew($title, $body, $imageFileName, $creator);
        header("HTTP/1.1 201 Created");
    } else {
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }
}