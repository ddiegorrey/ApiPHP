<?php 

require_once("../includes/Client.php");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));

    $passwordEncrypt = Client::getPassword($username);

    if(password_verify($password, $passwordEncrypt)){
        header("HTTP/1.1 202 Accepted");
    }else if(!$passwordEncrypt){
        header("HTTP/1.1 404 Not Found");
    }else{
        header("HTTP/1.1 Unauthorized");
    }
}