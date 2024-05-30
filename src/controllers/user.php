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

        // TODO temp
        header('Location: /19-php-hiking-project-celine-louis/');
        // header('Location: /19-php-hiking-project-celine-louis/profile');
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

    public function editProfile()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->editUser($firstname, $lastname, $email, $password);
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
        if ($_SESSION['message'] === 'Account deleted') {
            $this->logout();
            header('Location: /19-php-hiking-project-celine-louis');
        } else {
            header("Location: /19-php-hiking-project-celine-louis/profile");
        }
    }

    public function listUser() {
        $users = (new User())->getAllUsers();
        var_dump($users);
        require('../src/views/admin.php');
    }
}