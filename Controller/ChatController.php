<?php

use App\Controller\AbstractController;

class ChatController extends AbstractController
{
    public function index () {
        $this->render('chat/message', [
            'messages' => MessageManager::getAll(),
        ]);
    }

    public function getAll() :void
    {
        $messages = [];
        foreach (MessageManager::getAll() as $key => $message) {
             /* @var Message $message */
            $messages[$key]['content'] = $message->getContent();
            $messages[$key]['author'] = $message->getAuthor()->getUsername();
        }

        echo json_encode($messages);
    }

}