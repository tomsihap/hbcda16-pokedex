<?php

session_start();

if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    $_SESSION['messages'][] = "Vous n'avez pas accès à cette page.";
    header('Location: index.php');
    die;
}

require_once('config/db.php');

$req = "DELETE FROM pokemon WHERE id = :id";

$response = $bdd->prepare($req);
$response->execute([
    'id' => $_GET['id']
]);

header('Location: list.php');