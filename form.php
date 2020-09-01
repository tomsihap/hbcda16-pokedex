<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    $_SESSION['messages'][] = "Vous n'avez pas accès à cette page.";
    header('Location: index.php');
    die;
}

$pokemon = null;

if (!empty($_GET) && isset($_GET['id']) && $_GET['id'] > 0) {
    require_once('config/db.php');

    $req = "SELECT * FROM pokemon WHERE id = :id";
    $res = $bdd->prepare($req);
    $res->execute([
        'id' => $_GET['id']
    ]);

    $pokemon = $res->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include('partials/header.php') ?>

<?php if ($pokemon) : ?>
    <h1>Éditer un Pokémon : <?= $pokemon['name'] ?></h1>
<?php else : ?>
    <h1>Ajouter un Pokémon</h1>
<?php endif; ?>

<form action="<?= $pokemon ? "editTraitement.php" : "newTraitement.php" ?>" method="post">

    <?php if ($pokemon) : ?>
        <input type="hidden" name="id" value="<?= $pokemon['id'] ?>">
    <?php endif; ?>

    <div class="form-group">
        <label for="">Nom</label>
        <input name="name" type="text" class="form-control" value="<?= $pokemon ? $pokemon['name'] : null ?>">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" id="" cols="30" rows="10" class="form-control"><?= $pokemon ? $pokemon['description'] : null ?></textarea>
    </div>

    <div class="form-group">
        <label for="">Taille</label>
        <input name="size" type="number" class="form-control" value="<?= $pokemon ? $pokemon['size'] : null ?>">
    </div>

    <div class="form-group">
        <label for="">Poids</label>
        <input name="weight" type="number" class="form-control" value="<?= $pokemon ? $pokemon['weight'] : null ?>">
    </div>

    <?php if ($pokemon) : ?>
        <button class="btn btn-warning float-right">Éditer</button>
    <?php else : ?>
        <button class="btn btn-success float-right">Ajouter</button>
    <?php endif; ?>

</form>

<?php include('partials/footer.php') ?>