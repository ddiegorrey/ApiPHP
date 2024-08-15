<?php

require_once("../includes/Client.php");

if($_SERVER['REQUEST_METHOD'] == "PUT" && isset($_GET['id']) && isset($_GET['newPassword'])){
    $id = filter_var($_GET['id']);
    $newPassword = password_hash($_GET['newPassword'], PASSWORD_BCRYPT);

    try{
        Client::changePassword($id, $newPassword);
        header("HTTP/1.1 200 OK");
    }catch(Exception $e){
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }
}else{
    header("HTTP/1.1 405 Method Not Allowed");
}