<?php

if (!isset($_SESSION['user'])){
    header("Location: /index.php?c=home");
}

if (isset($data['messages'])) {
$messages = $data['messages'];
}

?>


<div class="article-container">
    <h2>Chat:  </h2>
    <div id="container-message">
        <?php
        foreach ($messages as $message) {
            /* @var Message $message */ ?>
                <div class="message">
                    <p class="user"><?= $message->getAuthor()->getUsername() ?>:</p>
                    <p><?= $message->getContent() ?></p>
                </div>
            <?php
        }
        ?>

    </div>

    <?php
    if (isset($_SESSION['user'])) {?>
        <input type="text" id="message-content" name="content" placeholder="Votre message...">
        <button id="send-button" name="submit">Envoyez</button><?php
    }
    ?>

</div>