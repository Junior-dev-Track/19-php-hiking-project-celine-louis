<?php

namespace Controllers;

use Models\HikeRepository;
use Models\User;

class UserController
{
    public function register()
    {
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['nickname']) && !empty($_POST['password'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new User())->addUser($firstname, $lastname, $nickname, $email, $password);

            // TODO temp
            header('Location: /19-php-hiking-project-celine-louis/');
            // header('Location: /19-php-hiking-project-celine-louis/profile');
        } else {
            $_SESSION['message'] = 'Fields must not be empty';
            require '../src/views/register.php';
            unset($_SESSION['message']);
        }
    }

    public function login()
    {
        if (!empty($_POST['emailNickname']) && !empty($_POST['password'])) {
            $emailNickname = $_POST['emailNickname'];
            $password = $_POST['password'];

            $user = (new User())->loginUser($emailNickname, $password);
            header('Location: /19-php-hiking-project-celine-louis/');
        } else {
            $_SESSION['message'] = 'Email/Nickname or password not valid';
            require '../src/views/login.php';
            unset($_SESSION['message']);
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['message']);
        header('Location: /19-php-hiking-project-celine-louis/');
    }

    public function editProfile()
    {
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new User())->editUser($firstname, $lastname, $email, $password);
            header("Location: /19-php-hiking-project-celine-louis/profile");
        } else {
            $_SESSION['message'] = 'Fields not valid';
            require '../src/views/editProfile.php';
            unset($_SESSION['message']);
        }
    }

    public function editPassword()
    {
        if (!empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['newPasswordCheck'])) {
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $newPasswordCheck = $_POST['newPasswordCheck'];

            $user = (new User())->setPassword($oldPassword, $newPassword, $newPasswordCheck);
            header("Location: /19-php-hiking-project-celine-louis/profile");
        } else {
            $_SESSION['message'] = 'Fields must not be empty';
            require '../src/views/editProfile.php';
            unset($_SESSION['message']);
        }
    }

    public function deleteAccount($id = null)
    {
        if ($id == null) {
            if (!empty($_POST['password']) && !empty($_POST['passwordCheck'])) {
                $password = $_POST['password'];
                $passwordCheck = $_POST['passwordCheck'];
                $user = (new User())->deleteUser($password, $passwordCheck);
                $this->logout();
                header('Location: /19-php-hiking-project-celine-louis');
            } else {
                $_SESSION['message'] = 'Fields must not be empty';
                require '../src/views/editProfile.php';
                unset($_SESSION['message']);
            }
        } else {
            $user = (new User())->deleteUser(null, null, $id);
        }
    }

    public function manageAdmin()
    {
        $users = (new User())->getAllUsers();
        $tags = (new HikeRepository())->getListOfTag();
        require('../src/views/admin.php');
    }

    public function updateAdmin($id_user, $isAdmin)
    {
        $users = (new User())->changeAdmin($id_user, $isAdmin);
    }
}
