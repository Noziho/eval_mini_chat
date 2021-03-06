<?php
require __DIR__ . '/Config.php';
require __DIR__ . '/Model/DB_Connect.php';

require __DIR__ . '/Model/Entity/AbstractEntity.php';
require __DIR__ . '/Model/Entity/User.php';
require __DIR__ . '/Model/Entity/Message.php';


require __DIR__ . '/Model/Manager/UserManager.php';
require __DIR__ . '/Model/Manager/MessageManager.php';



require __DIR__ . '/Controller/AbstractController.php';
require __DIR__ . '/Controller/HomeController.php';
require __DIR__ . '/Controller/UserController.php';
require __DIR__ . '/Controller/ChatController.php';
require __DIR__ . '/Controller/MessageApiController.php';
require __DIR__ . '/Controller/ErrorController.php';

require __DIR__ . '/Router.php';