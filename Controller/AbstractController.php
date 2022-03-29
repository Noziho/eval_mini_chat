<?php

namespace App\Controller;

use App\Model\Entity\User;

abstract class AbstractController
{
    abstract public function index ();


    /**
     * require each view on param
     * @param string $template
     * @param array $data
     */
    public function render (string $template, array $data = []) {
        ob_start();
        require __DIR__ . "/../View/" . $template . ".html.php";
        $html = ob_get_clean();
        require __DIR__. "/../View/base.html.php";
    }

    /**
     * checking if form are isset
     * @param ...$inputNames
     * @return bool
     */
    public function formIsset (...$inputNames): bool
    {
        foreach ($inputNames as $name) {
            if (!isset($_POST[$name])) {
                return false;
            }
        }
        return true;
    }

    /**
     * check input range
     * @param string $value
     * @param int $min
     * @param int $max
     * @param string $redirect
     */
    public function checkRange (string $value, int $min, int $max, string $redirect): void
    {
        if (strlen($value) < $min || strlen($value) > $max) {
            header("Location: " . $redirect);
            exit();
        }
    }

    /**
     * check if password === password_repeat
     * @param string $password
     * @param string $password_repeat
     * @return bool
     */
    public function checkPassword (string $password, string $password_repeat): bool
    {
        if ($password !== $password_repeat) {
            return false;
        }
        return true;
    }

}