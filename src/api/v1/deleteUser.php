<?php

require_once("../includes/Client.php");

header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if($_SERVER['REQUEST_METHOD'] == "DELETE" && isset($_POST['id'])){

    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    try{
        Client::deleteUser($id);
        header("HTTP/1.1 204 No Content");
    }catch(Exception $e){
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }
    

}else{
    header("HTTP/1.1 405 Method Not Allowed");
}