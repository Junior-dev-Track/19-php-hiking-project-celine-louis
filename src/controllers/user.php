<?php

namespace Controllers;

use Models\User;

class UserController
{
    public function subscription() {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->addUser($firstname, $lastname, $nickname, $email, $password);

        if (gettype($user) === 'string') {
            echo $user;
            require('src/views/register.php');
        } else {
            $_SESSION['login'] = true;
            header("Location: index.php?action=");
            exit;
        }
    }

    public function login() {

    }

    public function logout() {

    }

    public function deleteAccount() {

    }
}