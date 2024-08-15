<?php

require_once("database.php");

class Client{
    static public function createUser($name,$username,$email,$password){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "INSERT INTO users (name, username, email , password) VALUES (:name, :username, :email, :password)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        try{
            $stmt->execute();
            return true; 
        }catch(PDOException $e){
            echo "ERROR: " . $e;
            return false;
        }
    }
    static public function deleteUser($id){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":id", $id);
        try{
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "ERROR: " . $e;
            return false;
        }
    }
    static public function editUser($name,$username,$email,$id){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "UPDATE users SET name = :name, username = :username, email = :email WHERE  id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id);

        try{
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "ERROR:" .$e->getMessage();
            return false;
        }
    }
    static public function getUser($id){
        $db = new database;
        $conn = $db->getConnect();

            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":id", $id);
            try{
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($result);

            }catch(PDOException $e){
                echo "ERROR:" . $e;
                return false;
            }
    }
    static public function getUsers(){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);
        }catch(PDOException $e){
            return "ERROR:" . $e;
        }
    }
    static public function addNew($title, $body, $image , $creator){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "INSERT INTO news (title, body, image, creator) VALUES (:title, :body, :image, :creator)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":creator", $creator);

        try{
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "ERROR:" .$e;
            return false;
        }
    }
    static public function deleteNew($id){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        try{
            $stmt ->execute();
            return true;
        }catch(PDOException $e){
            echo "ERROR:" . $e ;
            return false;
        }
    }
    static public function editNew($title, $body, $image, $id){
        $db = new database;
        $conn = $db->getConnect();

        $sql =  "UPDATE news SET title = :title , body =  :body, image =  :image WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":id", $id);

        try{
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "ERROR" . $e;
            return false;
        }
    }
    static public function getNews(){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "SELECT * FROM news";
        $stmt = $conn->prepare($sql);

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);
        }catch(PDOException $e){
            echo "ERROR:" . $e;
            return false;
        }
    }
    static public function getNew($id){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "SELECT * FROM news WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);
        }catch(PDOException $e){
            echo "ERROR:" . $e;
            return false;
        }
    }
    static public function getImageName($id){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "SELECT image FROM news WHERE id = :id";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(":id", $id);

        try{
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['image'] : null;
        }catch(PDOException $e){
            return false;
        }
    }
    static public function changePassword($id, $newPassword){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "UPDATE users SET password = :newPassword WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':newPassword', $newPassword);

        try{
            $stmt->execute();
            return true; 
        }catch(PDOException $e){
            echo "ERROR:" . $e->getMessage();
            return false;
        }
    }
    static public function getPassword($username){
        $db = new database;
        $conn = $db->getConnect();

        $sql = "SELECT password FROM users WHERE username = :username ";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username);

        try{
            $stmt->execute();
            $password = $stmt->fetch(PDO::FETCH_ASSOC);
            return $password;
        }catch(PDOException $e){
            echo "ERROR:" . $e->getMessage();
            return false;
        }
    }
}