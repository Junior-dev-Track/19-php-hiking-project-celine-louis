<?php

namespace Controllers;

use Models\User;

class UserController
{
    public function register()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->addUser($firstname, $lastname, $nickname, $email, $password);

        header('Location: /19-php-hiking-project-celine-louis/');
    }

    public function login()
    {
        $emailNickname = $_POST['emailNickname'];
        $password = $_POST['password'];

        $user = (new User())->loginUser($emailNickname, $password);
        header('Location: /19-php-hiking-project-celine-louis/');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['message']);
        header('Location: /19-php-hiking-project-celine-louis/');
    }

    public function editFirstName()
    {
        $firstname = $_POST['firstname'];
        $password = $_POST['password'];

        $user = (new User())->setFirstname($firstname, $password);
        header("Location: /19-php-hiking-project-celine-louis/profile");
    }

    public function editLastName()
    {
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];

        $user = (new User())->setLastname($lastname, $password);
        header("Location: /19-php-hiking-project-celine-louis/profile");
    }

    public function editEmail()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->setEmail($email, $password);
        header("Location: /19-php-hiking-project-celine-louis/profile");
    }

    public function editPassword()
    {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $newPasswordCheck = $_POST['newPasswordCheck'];

        $user = (new User())->setPassword($oldPassword, $newPassword, $newPasswordCheck);
        header("Location: /19-php-hiking-project-celine-louis/profile");
    }

    public function deleteAccount()
    {
        $password = $_POST['password'];
        $passwordCheck = $_POST['passwordCheck'];

        $user = (new User())->deleteUser($password, $passwordCheck);
        $this->logout();
    }
}