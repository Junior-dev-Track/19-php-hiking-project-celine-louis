<?php

declare(strict_types=1);

namespace Models;

use Exception;
use PDO;

class User extends Database
{
    public function addUser(string $firstname, string $lastname, string $nickname, string $email, string $password)
    {
        if (isset($firstname, $lastname, $nickname, $email, $password) && !empty($firstname) && !empty($lastname) && !empty($nickname) && !empty($email) && !empty($password)) {
            // check if user already registered
            $checkUserNickname = $this->findUserByNickname($nickname);
            $checkUserEmail = $this->findUserByEmail($email);

            if ($checkUserNickname) {
                $_SESSION['message'] = 'Nickname already taken';
                header('Location: /19-php-hiking-project-celine-louis/register');
                exit;
            } else if ($checkUserEmail) {
                $_SESSION['message'] = 'Email already taken';
                header('Location: /19-php-hiking-project-celine-louis/register');
                exit;
            } else {

                // strip_tags for the login
                $firstnamePost = ucfirst(strip_tags($firstname));
                $lastnamePost = ucfirst(strip_tags($lastname));
                $nicknamePost = strip_tags($nickname);

                // check valid email
                $emailPost = filter_var($email, FILTER_VALIDATE_EMAIL);

                // hash the password
                $passPost = password_hash($password, PASSWORD_BCRYPT);

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
            }
        } else {
            throw new Exception("form incomplete");
        }
    }

    private function findUserByNickname(string $nickname)
    {
        try {
            $param = [":nickname" => $nickname];
            $stmt = $this->query(
                "SELECT * FROM `users` WHERE nickname = :nickname",
                $param
            );

            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    private function findUserByEmail(string $email)
    {
        try {
            $param = [':email' => $email];
            $stmt = $this->query(
                "SELECT * FROM users WHERE email = :email",
                $param
            );

            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    private function getPassword($id)
    {
        try {
            $param = [':id' => $id];
            $stmt = $this->query(
                'SELECT password FROM users WHERE id_user = :id',
                $param
            );
            $pwd = $stmt->fetch();
            return $pwd['password'];
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function loginUser(string $emailNickname, string $password)
    {
        if (isset($emailNickname, $password) && !empty($emailNickname) && !empty($password)) {
            // if user entered an email
            if (filter_var($emailNickname, FILTER_VALIDATE_EMAIL)) {
                $email = $emailNickname;
                try {
                    $checkUserEmail = $this->findUSerByEmail($email);
                    if ($checkUserEmail && password_verify($password, $checkUserEmail['password'])) {
                        $_SESSION["user"] = [
                            "id" => $checkUserEmail['id_user'],
                            "firstname" => $checkUserEmail['firstname'],
                            "lastname" => $checkUserEmail['lastname'],
                            "nickname" => $checkUserEmail['nickname'],
                            "email" => $checkUserEmail['email']
                        ];
                    } else {
                        $_SESSION['message'] = 'Wrong password';
                        header("Location: /19-php-hiking-project-celine-louis/login");
                        // echo '<p>Wrong login</p>';
                        // require('../src/views/login.php');
                        // exit;
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                // if user entered a nickname
                $nickname = ucfirst($emailNickname);
                try {
                    $checkUserNickname = $this->findUserByNickname($nickname);
                    if ($checkUserNickname && password_verify($password, $checkUserNickname['password'])) {
                        $_SESSION["user"] = [
                            "id" => $checkUserNickname['id_user'],
                            "firstname" => $checkUserNickname['firstname'],
                            "lastname" => $checkUserNickname['lastname'],
                            "nickname" => $checkUserNickname['nickname'],
                            "email" => $checkUserNickname['email']
                        ];
                    } else {
                        echo '<p>Wrong login</p>';
                        require('../src/views/login.php');
                        exit;
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            }
        }
    }

    public function setFirstname(string $firstname, string $password)
    {
        if (isset($firstname, $password) && !empty($firstname) && !empty($password)) {
            echo gettype($_SESSION['user']['id']);
            $pwdUser = $this->getPassword($_SESSION['user']['id']);
            if ($password && password_verify($password, $pwdUser)) {
                try {
                    $param = [
                        ':firstname' => ucfirst($firstname),
                        ':id_user' => $_SESSION['user']['id']
                    ];
                    $stmt = $this->query(
                        'UPDATE users SET firstname = :firstname WHERE id_user = :id_user',
                        $param
                    );

                    $_SESSION['message'] = 'Firstname updated';
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                $_SESSION['message'] = 'Wrong password';
            }
        }
    }

    public function setLastname(string $lastname, string $password)
    {
        if (isset($lastname, $password) && !empty($lastname) && !empty($password)) {
            $pwdUser = $this->getPassword($_SESSION['user']['id']);
            if ($password && password_verify($password, $pwdUser)) {
                try {
                    $param = [
                        ':lastname' => ucfirst($lastname),
                        ':id_user' => $_SESSION['user']['id']
                    ];
                    $stmt = $this->query(
                        'UPDATE users SET lastname = :lastname WHERE id_user = :id_user',
                        $param
                    );

                    $_SESSION['message'] = 'Lastname updated';
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                $_SESSION['message'] = 'Wrong password';
            }
        }
    }

    public function setEmail(string $email, string $password)
    {
        if (isset($email, $password) && !empty($email) && !empty($password)) {
            $checkEmail = $this->findUserByEmail($email);
            if ($checkEmail)
                $_SESSION['message'] = 'Email already taken';
            else {
                $pwdUser = $this->getPassword($_SESSION['user']['id']);
                if ($password && password_verify($password, $pwdUser)) {
                    try {
                        $param = [
                            ':email' => $email,
                            ':id_user' => $_SESSION['user']['id']
                        ];
                        $stmt = $this->query(
                            'UPDATE users SET email = :email WHERE id_user = :id_user',
                            $param
                        );

                        $_SESSION['message'] = 'Email updated';
                    } catch (Exception $e) {
                        error_log($e->getMessage());
                    }
                } else {
                    $_SESSION['message'] = 'Wrong password';
                }
            }
        }
    }

    public function setPassword(string $oldPassword, string $newPassword, string $newPasswordCheck)
    {
        if (isset($oldPassword, $newPassword, $newPasswordCheck) && !empty($oldPassword) && !empty($newPassword) && !empty($newPasswordCheck)) {
            $pwdUser = $this->getPassword($_SESSION['user']['id']);
            if ($oldPassword && password_verify($oldPassword, $pwdUser) && $newPassword == $newPasswordCheck) {
                try {
                    $param = [
                        ':newPassword' => password_hash($newPassword, PASSWORD_BCRYPT),
                        ':id_user' => $_SESSION['user']['id']
                    ];
                    $stmt = $this->query(
                        'UPDATE users SET password = :newPassword WHERE id_user = :id_user',
                        $param
                    );

                    $_SESSION['message'] = 'Password updated';
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                $_SESSION['message'] = 'Wrong password';
            }
        }
    }

    // TODO delete account
    public function deleteUser(string $password, string $passwordCheck)
    {
        if (isset($password, $passwordCheck) && !empty($password) && !empty($passwordCheck)) {
            $pwdUser = $this->getPassword($_SESSION['user']['id']);
            if ($password && password_verify($password, $pwdUser) && $password == $passwordCheck) {
                try {
                    $param = [':id_user' => $_SESSION['user']['id']];
                    $stmt = $this->query(
                        "DELETE FROM users WHERE id_user = :id_user",
                        $param
                    );

                    $_SESSION['message'] = 'Account deleted';
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                $_SESSION['message'] = 'Wrong password';
            }
        }
    }

    // TODO phpMailer
}
