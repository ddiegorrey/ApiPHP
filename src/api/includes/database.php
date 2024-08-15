<?php


class database{
    private $database = "reyshome";
    private$host = "localhost";
    private $password = "";
    private $user = "user";

    public function getConnect(){
        $hostDB = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";";

        try{ 
            $connection = new PDO ($hostDB, $this->user, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection ;
        }catch(PDOException $e){
            die("ERROR: " . $e->getMessage());
        }

    }
}
