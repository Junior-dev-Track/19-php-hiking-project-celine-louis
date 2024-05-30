<?php

declare(strict_types=1);

namespace Models;

use Exception;
use PDO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;


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
                try {
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

                    // retreive the last ID
                    $id = $this->lastInsertId();

                    // store data of user in $_SESSION
                    $_SESSION["user"] = [
                        "id" => $id,
                        "firstname" => $firstnamePost,
                        "lastname" => $lastnamePost,
                        "nickname" => $nicknamePost,
                        "email" => $emailPost,
                        "isAdmin" => 0
                    ];

                    $subjectEmail = 'Welcome on the hike project website!';
                    $bodyEmail = 'Dear ' . $_SESSION['user']['firsname'] . ', <br><br>Thank you for registering We\'re glad to have you with us.';
                    $this->sendEmail($subjectEmail, $bodyEmail);
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            }
        } else {
            throw new Exception("form incomplete");
        }
    }

    // TODO seems to work, still waiting to receive my email ?
    private function sendEmail(string $subjectEmail, string $bodyEmail)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {

            try {
                // Configure PHP Mailer
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPDebug = 2;
                $mail->Host = 'live.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 587;
                $mail->Username = 'api';
                $mail->Password = 'b4d0f6052ac3da85244c3ff4b9dd6653';

                // Set who the message is to be sent from and who the sender will appear to be
                $mail->setFrom('no-reply@becode.com', 'No Reply'); // Use a "no-reply" email address and name
                $mail->addAddress($_SESSION['user']['mail']); // Add a recipient

                // Set email format to HTML
                $mail->isHTML(true);

                // Set email content
                $mail->Subject = $subjectEmail;
                $mail->Body    = $bodyEmail;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                // Send the email
                $mail->send();
                $_SESSION['message'] = $mail;
                // $_SESSION['message'] = 'Message has been sent';
            } catch (Exception $e) {
                error_log($e->getMessage());
                $_SESSION['message'] = 'No email send';
            }
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

    public function findUserByID(int $id)
    {
        try {
            $param = [':id_user' => $id];
            $stmt = $this->query(
                "SELECT firstname, lastname FROM users WHERE id_user = :id_user",
                $param
            );
            $result = $stmt->fetch();
            if ($result && is_array($result)) {
                $user = [
                    'firstname' => $result['firstname'],
                    'lastname' => $result['lastname']
                ];
                return $user;
            } else {
                throw new Exception("No result found for user ID: $id");
            }
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
                            "email" => $checkUserEmail['email'],
                            "isAdmin" => $checkUserEmail['is_admin']
                        ];
                    } else {
                        $_SESSION['message'] = 'Wrong password';
                        header("Location: /19-php-hiking-project-celine-louis/login");
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
                            "email" => $checkUserNickname['email'],
                            "isAdmin" => $checkUserNickname['is_admin']
                        ];
                    } else {
                        $_SESSION['message'] = 'Wrong login or password';
                        require('../src/views/login.php');
                        exit;
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            }
        }
    }

    public function editUser(string $firstname, string $lastname, string $email, string $password)
    {
        if (isset($firstname, $lastname, $email, $password) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
            $pwdUser = $this->getPassword($_SESSION['user']['id']);
            if ($password && password_verify($password, $pwdUser)) {
                try {
                    $param = [
                        ':firstname' => ucfirst($firstname),
                        ':lastname' => ucfirst($lastname),
                        ':email' => $email,
                        ':id_user' => $_SESSION['user']['id']
                    ];
                    $stmt = $this->query(
                        'UPDATE users 
                        SET firstname = :firstname, lastname = :lastname, email = :email
                        WHERE id_user = :id_user',
                        $param
                    );

                    $_SESSION['message'] = 'Profile updated';
                    $_SESSION['user']['firstname'] = ucfirst($firstname);
                    $_SESSION['user']['lastname'] = ucfirst($lastname);
                    $_SESSION['user']['email'] = $email;
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                $_SESSION['message'] = 'Wrong password';
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

                    $subjectEmail = 'Important Notice';
                    $bodyEmail = 'Your new password is updated.';
                    $this->sendEmail($subjectEmail, $bodyEmail);
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            } else {
                $_SESSION['message'] = 'Wrong password';
            }
        }
    }

    public function deleteUser(string $password, string $passwordCheck)
    {
        if (isset($password, $passwordCheck) && !empty($password) && !empty($passwordCheck)) {
            $pwdUser = $this->getPassword($_SESSION['user']['id']);
            if ($password && password_verify($password, $pwdUser) && $password == $passwordCheck) {
                try {
                    $param = [':id_user' => $_SESSION['user']['id']];
                    // delete his id from hikes
                    $stmt = $this->query(
                        'UPDATE hikes SET id_user = NULL where id_user = :id_user',
                        $param
                    );
                    // delete the user
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

    public function getAllUsers(): array
    {
        try {
            $stmt = $this->query(
                "SELECT id_user, firstname, lastname, nickname, email, is_admin FROM users"
            );
            $users = [];
            while ($result = $stmt->fetch()) {
                $users[] = [
                    'id_user' => $result['id_user'],
                    'firstname' => $result['firstname'],
                    'lastname' => $result['lastname'],
                    'nickname' => $result['nickname'],
                    'email' => $result['email'],
                    'isAdmin' => $result['is_admin']
                ];
            }
            return $users;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
