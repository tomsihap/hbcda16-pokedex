<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    $_SESSION['messages'][] = "Vous n'avez pas accès à cette page.";
    header('Location: index.php');
    die;
}

require_once('config/db.php');

$req = "UPDATE pokemon
        SET name= :name, description = :description, weight = :weight, size = :size
        WHERE id = :id";
$res = $bdd->prepare($req);
$res->execute([
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "weight" => $_POST['weight'],
    "size" => $_POST['size'],
    "id" => $_POST['id']
]);

header('Location: show.php?id=' . $_POST['id']);