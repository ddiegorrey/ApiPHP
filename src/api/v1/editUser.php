<?php

require_once("../includes/Client.php");

if($_SERVER['REQUEST_METHOD'] == "PUT" && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['id'])){

    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, "UTF-8");
    $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, "UTF-8");
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    try{
        Client::editUser($name, $username, $email, $id);
        header("HTTP/1.1 200 OK");
    }catch(Exception $e){
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }

}else{
    header("HTTP/1.1 405 Method Not Allowed");
}