<?php


use App\Model\Entity\User;

$messages = [
    "Success: Connexion réussi.",
    "Sucess: Déconnexion réussi.",
    "Error: Vous devez être connecter pour pouvoir vous déconnecter",
    "Sucess: Votre article à bien été créer",
    "Error: Erreur lors de la création de l'article",
    "Sucess: L'article à été supprimer avec succès",
    "Sucess: L'article à été modifiez avec succès",
    "Error: Un champ pour le commentaire est manquant",
    "Error: La longueur du champ commentaire doit-être comprise entre 20 et 255",
    "Error: Le champ password est manquant",
];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}?>


<div class="article-container">
    <h2>Bienvenue:</h2>
    <p>Pour accèder au mini chat vueillez vous enregister ou vous connecter.</p>
</div>


