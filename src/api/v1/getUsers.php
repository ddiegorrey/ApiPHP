<?php

require_once("../includes/Client.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){

    try{
        $result = Client::getUsers();
        header("HTTP/1.1 200 OK");
        return $result;
    }catch(Exception $e){
        header("HTTP/1.1 500 INTERNAL SERVER ERROR");
    }

}else{
    header("HTTP/1.1 405 Method Not Allowed");
}