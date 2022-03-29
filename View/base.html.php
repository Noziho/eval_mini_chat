<?php

use App\Model\Entity\User;

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini chat</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header>
    <div class="main-menu">
        <div class="header-logo-title">
            <div class="container-menu-logo"><i class="fas fa-bars" id="hoveredMenu"></i></div>
            <h1>Mini chat</h1>
        </div>
        <div class="header-link">
            <ul id="responsive-menu">
                <?php
                if (!isset($_SESSION['user'])) {
                    ?>
                    <li><a href="/index.php?c=home">Accueil</a></li>
                    <li><a href="/index.php?c=user&a=login">Connexion</a></li>
                    <li><a href="/index.php?c=user&a=register">Inscription</a></li><?php
                }
                else {?>

                    <li><a href="/index.php?c=home">Accueil</a></li>
                    <li><a href="/index.php?c=user&a=dislog">Déconnexion</a></li>
                    <li><a href="/index.php?c=chat">Chat</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>


</header>

<main>
    <?= $html ?>
</main>


<footer>Mon footer</footer>
<script src="https://kit.fontawesome.com/f06b2f84ad.js" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/message.js"></script>
</body>
</html>