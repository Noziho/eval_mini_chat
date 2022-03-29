<?php

use App\Model\Entity\User;
use App\Model\Manager\UserManager;

class MessageManager
{
    public const TABLE = 'message';

    public static function getAll (): array
    {
        $messages = [];
        $query = DB_connect::dbConnect()->query("SELECT * FROM " . self::TABLE );

        if($query) {
            foreach ($query->fetchAll() as $data) {
                $messages[] = self::makeMessage($data);
            }
        }
        return $messages;
    }

    public static function addMessage (Message &$message): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO ". self::TABLE ." (content, user_fk) VALUES (:content, :author)
        ");

        $stmt->bindValue(':content', $message->getContent());
        $stmt->bindValue(':author', $message->getAuthor()->getId());

        $result = $stmt->execute();
        $message->setId(DB_Connect::dbConnect()->lastInsertId());
        return $result;

    }

    private static function makeMessage($data): Message
    {
        return (new Message())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setAuthor(UserManager::getUserById($data['user_fk']));
    }
}