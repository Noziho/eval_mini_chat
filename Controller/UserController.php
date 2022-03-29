<?php


use App\Controller\AbstractController;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('users/list-user');
    }



    public function register()
    {
        $this->render('home/register');
        if (isset($_POST['submit'])) {
            if (!$this->formIsset('username', 'mail', 'password', 'password_repeat', 'submit')) {
                header("Location: /index.php?c=user&a=register&f=0");
            }

            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            if (!$mail) {
                header("Location: /index.php?c=user&a=register&f=1");
            }
            if (UserManager::mailExist($mail)) {
                header("Location: /index.php?c=user&a=register&f=7");
            }

            if (UserManager::usernameExist($username)) {
                header("Location: /index.php?c=user&a=register&f=8");
            }

            $this->checkRange($username, 4, 75, '/index.php?c=user&a=register&f=2');
            $this->checkRange($mail, 8, 150, '/index.php?c=user&a=register&f=3');
            $this->checkRange($password, 8, 50, '/index.php?c=user&a=register&f=4');


            if (!$this->checkPassword($password, $password_repeat)) {
                header("Location: /index.php?c=user&a=register&f=5");
                exit();
            }

            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
            UserManager::createUser($username, $mail, $password);
            header("Location: /index.php?c=user&a=register&f=6");
        }
    }

    public function login () {

        if (isset($_POST['submit'])) {
            if (!$this->formIsset('username_login', 'password_login')) {
                header("Location: /index.php?c=login&f=3");
            }
            UserManager::login();
        }
        $this->render("home/login");
    }

    public function dislog () {
        UserManager::dislog();
    }

}