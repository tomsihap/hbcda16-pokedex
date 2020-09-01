<?php
require_once('config/db.php');

/**
 * !empty: teste si $_GET n'est pas vide (il existe toujours mais n'a pas forcément de params)
 * isset: teste si $_GET['id'] fait parti des params GET
 * > 0 : teste si c'est un INT valide
 */
if (!empty($_GET) && isset($_GET['id']) && $_GET['id'] > 0) {

    $bdd = new PDO('mysql:host=localhost;dbname=cda16;charset=utf8;port=8889', 'root', 'root', [
        'ATTR_ERRMODE' => PDO::ERRMODE_EXCEPTION
    ]);

    $req = "SELECT * FROM pokemon WHERE id = :id";
    $res = $bdd->prepare($req);
    $res->execute([
        'id' => $_GET['id']
    ]);

    $pokemon = $res->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: list.php');
}

?>

<?php include('partials/header.php') ?>

<h1>Consulter un Pokémon : <?= $pokemon['name'] ?></h1>

<div class="card mb-1">
    <div class="card-header">#<?= $pokemon['id'] ?> <?= $pokemon['name'] ?></div>
    <div class="card-body">Un poids de <?= $pokemon['weight'] ?> g et une taille de <?= $pokemon['size'] ?> cm.</div>

    <div class="card-footer">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
            <a href="form.php?id=<?= $pokemon['id'] ?>" class="btn btn-warning">Éditer</a>
            <a href="delete.php?id=<?= $pokemon['id'] ?>" class="btn btn-danger">Supprimer</a>
        <?php endif; ?>
    </div>
</div>


<?php include('partials/footer.php') ?>