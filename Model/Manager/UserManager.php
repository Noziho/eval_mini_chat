<?php

namespace App\Model\Manager;

use App\Model\Entity\User;
use DB_Connect;

class UserManager
{
    public const TABLE = "user";


    public static function login()
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            SELECT * FROM " . self::TABLE . " WHERE username = :username
        ");

        $username = filter_var($_POST['username_login']);
        $stmt->bindParam(':username', $username);

        $password_en_clair = $_POST['password_login'];

        if ($stmt->execute()) {
            $user = $stmt->fetch();
            if (isset($user['password'])) {
                if (password_verify($password_en_clair, $user['password'])) {
                    $userSession = (new User())
                        ->setId($user['id'])
                        ->setUsername($user['username'])
                        ->setMail($user['mail'])
                        ->setPassword('');


                    if (!isset($_SESSION['user'])) {
                        $_SESSION['user'] = $userSession;
                    }


                    $_SESSION['id'] = $userSession->getId();
                    header("Location: /index.php?c=chat");
                } else {
                    header("Location: /index.php?c=user&a=login&f=0");
                }
            } else {
                header("Location: /index.php?c=user&a=login&f=0");
            }
        }
    }


    public static function dislog()
    {
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();
            header("Location: /index.php?c=home&f=1");
        } else {
            header("Location: /index.php?c=home&f=2");
        }

    }

    /**
     * create user in DB
     * @param $username
     * @param $mail
     * @param $password
     */
    public static function createUser($username, $mail, $password)
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO " . self::TABLE . " (username, mail, password)
            VALUES (:username, :email, :password) 
        ");

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $mail);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

    }


    /**
     * same for mail
     * @param string $email
     * @return int|mixed
     */
    public static function mailExist(string $email)
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE mail = \"$email\"");
        return $query ? $query->fetch()['cnt'] : 0;
    }

    public static function usernameExist(string $username)
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE username = \"$username\"");
        return $query ? $query->fetch()['cnt'] : 0;
    }


    /**
     * Get user on DB
     * @param int $id
     * @return User|null
     */
    public static function getUserById(int $id): ?User
    {
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $query ? self::makeUser($query->fetch()) : null;
    }


    private static function makeUser(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setPassword($data['password'])
            ->setMail($data['mail'])
            ->setUsername($data['username']);

    }
}