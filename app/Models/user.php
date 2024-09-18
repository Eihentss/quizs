<?php

require_once "../app/Core/DBConnect.php";

class userModel {

    private $db;

    public function __construct() {
        $this->db = new DBConnect();
    }

    public function createUser(string $email, string $password, string $username)
    {
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);
        $quary = $this->db->dbconn->prepare("INSERT INTO Users (username, password, email) VALUES (:username,:password,:email)");
        $quary->execute([':username' => $username, ':password' => $password , ':email' => $email]);
        return $quary->fetchAll();
    }

    public function checkIfUserExsistsByUsername(string $username)
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM Users WHERE username = :username");
        $quary->execute([':username' => $username]);
        if($quary->fetchAll() != []){
            return false;
        }else{
            return true;
        }
    }

    public function checkIfUserExsistsByEmail(string $email)
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM Users WHERE email = :email");
        $quary->execute([':email' => $email]);
        if($quary->fetchAll() != []){
            return false;
        }else{
            return true;
        }
    }

    public function loginUser(string $username ,string $password)
    {
        $quary = $this->db->dbconn->prepare("SELECT * FROM users WHERE username = :username");
        $quary->execute([':username' => $username]);
        $user = $quary->fetch();
        if($user && password_verify($password , $user['password'])){
            return $user;
        }
        return false;   
    }

    public function userChangePassword(int $user_id ,string $username,string $oldPassword, string $newPassword)
    {
        $quary = $this->db->dbconn->prepare("SELECT * FROM users WHERE username = :username");
        $quary->execute([':username' => $username]);
        $user = $quary->fetch();

        if($user && password_verify($oldPassword , $user['password']))
        {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $quary = $this->db->dbconn->prepare("UPDATE users SET Password = :newPassword WHERE user_id = :user_id");
            $quary->execute([':user_id' => $user_id, ':newPassword' => $newPassword]);
            return true;
        }
        
        return false;   
    }

    public function userLostPassword(int $user_id ,string $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $quary = $this->db->dbconn->prepare("UPDATE users SET Password = :newPassword WHERE user_id = :user_id");
        $quary->execute([':user_id' => $user_id, ':newPassword' => $newPassword]);
        $quary->fetch();
    }

    public function userChangeEmail(int $user_id , string $newEmail)
    {
        $quary = $this->db->dbconn->prepare("UPDATE users SET email = :newEmail WHERE user_id = :user_id");
        $quary->execute([':user_id' => $user_id, ':newEmail' => $newEmail]);
        $quary->fetchAll();
        return true;
    }
    
    public function deleteUser(int $user_id , string $username , string $password)
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM users WHERE username = :username");
        $quary->execute([':username' => $username]);
        $user = $quary->fetch();
        if($user && password_verify($password , $user['password'])){

            $quary = $this->db->dbconn->prepare("DELETE FROM tasks WHERE user_id = :user_id");
            $quary->execute([':user_id' => $user_id]);

            $quary = $this->db->dbconn->prepare("DELETE FROM projects WHERE user_id = :user_id");
            $quary->execute([':user_id' => $user_id]);

            $quary = $this->db->dbconn->prepare("DELETE FROM users WHERE user_id = :user_id");
            $quary->execute([':user_id' => $user_id]);
            return true;
        }
        return false;   

    }

    public function getAllUsers()
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM Users");
        $quary->execute();
        return $quary->fetchAll();
    }




    

}