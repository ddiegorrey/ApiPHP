<?php

require_once("../includes/Client.php");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){

    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try{
    Client::createUser($name, $username, $email, $password);
    header ("HTTP/1.1 201 Created");
    }catch(Exception $e){
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }
}else{
    header("HTTP/1.1 405 Method Not Allowed");
}