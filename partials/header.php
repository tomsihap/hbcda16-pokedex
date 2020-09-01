<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="#">HB Pokédex</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list.php">Liste des Pokémons</a>
                </li>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Ajouter un Pokémon</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mon compte</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">

                        <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
                            <a class="dropdown-item" href="#">Bienvenue, <?= $_SESSION['user']['email'] ?> !</a>
                            <a class="dropdown-item" href="auth/logout.php">Déconnexion</a>
                        <?php else : ?>
                            <a class="dropdown-item" href="auth/register.php">Créer un compte</a>
                            <a class="dropdown-item" href="auth/login.php">Connexion</a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
            <form action="search.php" method="get" class="form-inline my-2 my-lg-0">
                <input name="query" class="form-control mr-sm-2" type="text" placeholder="Nom, taille, poids, description...">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col">

                <?php if (isset($_SESSION['messages'])) : ?>
                    <?php foreach ($_SESSION['messages'] as $message) : ?>
                        <div class="alert alert-success">
                            <?= $message ?>
                        </div>
                        <?php unset($_SESSION['messages']); ?>
                    <?php endforeach; ?>
                <?php endif; ?>