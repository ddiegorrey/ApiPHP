<?php

require_once("../includes/Client.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['title']) && isset($_POST['body']) && isset($_FILES['image']) && isset($_POST['id'])) {
    $title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES, "UTF-8");
    $body = htmlspecialchars(trim($_POST['body']), ENT_QUOTES, "UTF-8");
    $image = $_FILES['image'];
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    $uploadDir = "../../imagesNews/";

    $imageFileName = uniqid() . "-" . basename($image['name']);
    $uploadFilePath = $uploadDir . $imageFileName;

    $oldImage = Client::getImageName($title);

    if (move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
        
        if ($oldImage && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
        }

        Client::editNew($title, $body, $imageFileName, $id);
        header("HTTP/1.1 200 OK");
    }
}
