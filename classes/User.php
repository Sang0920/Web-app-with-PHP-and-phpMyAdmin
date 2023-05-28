<?php
class User
{
    public $id;
    public $birthday;
    public $firstname;
    public $lastname;
    public $gender;
    public $email;
    public $emailconfirmed;
    public $passwordhash;
    public $accessfailedcount;
    public $username;
    public $confirmationtoken;
    public $resettoken;
    public $resettokenissuedtime;
    public $roleid;

    public function create($pdo)
    {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO users (birthday, firstname, lastname, gender, email, passwordhash, username, confirmationtoken, roleid)
                VALUES (:birthday, :firstname, :lastname, :gender, :email, :passwordhash, :username, :confirmationtoken, :roleid);
            ");
            $stmt->bindParam(':birthday', $this->birthday, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $this->gender, PDO::PARAM_INT);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':passwordhash', $this->passwordhash, PDO::PARAM_STR);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindParam(':confirmationtoken', $this->confirmationtoken, PDO::PARAM_STR);
            $stmt->bindvalue(':roleid', 1, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }

    public function sendConfirmationEmail($email_pwd)
    {
        _sendConfirmationEmail($this, $email_pwd);
    }

    public function setConfirmationToken($pdo)
    {
        $this->confirmationtoken = bin2hex(random_bytes(3));
        try {
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE confirmationtoken = :confirmationtoken;");
            $stmt->bindParam(':confirmationtoken', $this->confirmationtoken, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                $user = $stmt->fetch();
                if (isset($user->confirmationtoken)) {
                    $this->setConfirmationToken($pdo);
                } else {
                    return $this->confirmationtoken;
                }
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function confirmEmail($pdo)
    {
        $this->emailconfirmed = 1;
        $this->confirmationtoken = null;
        try {
            $stmt = $pdo->prepare("UPDATE `users` SET `emailconfirmed` = :emailconfirmed, `confirmationtoken` = :confirmationtoken WHERE `id` = :id;");
            $stmt->bindParam(':emailconfirmed', $this->emailconfirmed, PDO::PARAM_INT);
            $stmt->bindParam(':confirmationtoken', $this->confirmationtoken, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function saveLogin($time)
    {
        $user = $this;
        $user = serialize($user);
        setcookie('user', $user, $time, '/');
    }

    public static function logout()
    {
        setcookie('user', '', time() - 3600, '/');
        unset($_COOKIE['username']);
    }

    public static function login($pdo, $username, $password)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE username = :username;");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                $user = $stmt->fetch();
                if (isset($user->username)) {
                    if (password_verify($password, $user->passwordhash)) {
                        return $user;
                    }
                }
            }
            return false;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getUserByConfirmationToken($pdo, $confirmationtoken)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE confirmationtoken = :confirmationtoken;");
            $stmt->bindParam(':confirmationtoken', $confirmationtoken, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getUserByUsername($pdo, $username)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username;");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getUserByEmail($pdo, $email)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email;");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getById($pdo, $id){
        try{
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                return $stmt->fetch();
            }
        }catch(PDOException $e){
            die("Error: " . $e->getMessage());
        }
    }
}
