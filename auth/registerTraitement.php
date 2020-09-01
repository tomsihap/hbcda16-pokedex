<?php

require_once('../config/db.php');

$req = "INSERT INTO user(email, password) VALUES(:email, :password)";

$res = $bdd->prepare($req);
$res->execute([
    "email" => $_POST['email'],
    "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
]);
$_SESSION['messages'][] = "Votre compte a bien été créé !";


header('Location: ../index.php ');