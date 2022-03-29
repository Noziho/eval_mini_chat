<?php

use App\Controller\AbstractController;

class MessageApiController extends AbstractController
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function addMessage()
    {
        $payload = file_get_contents('php://input');
        $payload = json_decode($payload);

        if (empty($payload->content)) {
            http_response_code(400);
            exit;
        }

        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            exit;
        }

        $content = filter_var($payload->content, FILTER_SANITIZE_STRING);

        $user = $_SESSION['user'];

        $message = (new Message())
            ->setContent($content)
            ->setAuthor($user)
            ;


        if (MessageManager::addMessage($message)) {
            echo json_encode([
                'id' => $message->getId(),
                'content' => $message->getContent(),
                'author' => $message->getAuthor()->getUsername(),
            ]);
            http_response_code(200);
            exit;
        }
    }

}