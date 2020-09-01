<?php
session_start();

require_once('../config/db.php');

$req = "SELECT email, password FROM user WHERE email = :email";

$res = $bdd->prepare($req);
$res->execute([
    'email' => $_POST['email']
]);

$user = $res->fetch(PDO::FETCH_ASSOC);

if (password_verify($_POST['password'], $user['password'])) {
    $_SESSION['user'] = $user;
    $_SESSION['messages'][] = "Vous êtes bien connecté.";
}
else {
    $_SESSION['user'] = null;
    $_SESSION['messages'][] = "Erreur d'authentification.";
}

header('Location: ../index.php');