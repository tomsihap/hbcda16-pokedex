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

$req = "INSERT INTO pokemon(name, description, size, weight)
        VALUES(:name, :description, :size, :weight)";

$res = $bdd->prepare($req);
$res->execute([
    'name'          => $_POST['name'],
    'description'   => $_POST['description'],
    'size'          => $_POST['size'],
    'weight'        => $_POST['weight'],
]);

$pokemonId = $bdd->lastInsertId();

header('Location: show.php?id=' . $pokemonId);

