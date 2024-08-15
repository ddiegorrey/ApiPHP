<?php

require_once("../includes/Client.php");


if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) ){

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    try{
        $result =  Client::getNew($id);
        header("HTTP/1.1 200 OK");
        return $result;
    }catch(Exception $e){
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }
}else{
    header("HTTP/1.1 405 Method Not Allowed");
}