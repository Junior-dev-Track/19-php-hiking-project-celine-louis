<?php

declare(strict_types=1);

namespace Models;

use Exception;
use PDO;

require_once('src/model/database.php');

class User extends Database
{
    public function addUser(string $firstname, string $lastname, string $nickname, string $email, string $password)
    {
        if (isset($firstname, $lastname, $nickname, $email, $password) && !empty($login) && !empty($email) && !empty($pass)) 
        {
            // strip_tags for the login
            $firstnamePost = strip_tags($firstname);
            $lastnamePost = strip_tags($lastname);
            $nicknamePost = strip_tags($nickname);

            // check valid email
            $emailPost = filter_var($email, FILTER_VALIDATE_EMAIL);

            // hash the password
            $passPost = password_hash($pass, PASSWORD_BCRYPT);

            //SQL part
            $param = [
                ":firstname" => $firstnamePost,
                ":lastname" => $lastnamePost,
                ":nickname" => $nicknamePost,
                ":email" => $emailPost,
                ":password" => $passPost
            ];
            $stmt = $this->query(
                "INSERT INTO users (firstname, lastname, nickname, email, password) 
                    VALUES (:firstname, :lastname, :nickname, :email, :password)",
                $param
            );

            if (!$stmt) {
                die("form not sent to the db");
            }

            // retreive the last ID
            $id = $this->lastInsertId();

            // store data of user in $_SESSION
            $_SESSION["user"] = [
                "id" => $id,
                "firstname" => $firstnamePost,
                "lastname" => $lastnamePost,
                "nickname" => $nicknamePost,
                "email" => $emailPost
            ];
        } else {
            throw new Exception("form incomplete");
        }
    }
}
