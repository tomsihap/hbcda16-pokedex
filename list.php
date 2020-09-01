<?php
require_once('config/db.php');

$req = "SELECT * FROM pokemon";
$res = $bdd->prepare($req);
$res->execute();
$pokemons = $res->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include('partials/header.php') ?>

<h1>Liste des Pokémons enregistrés</h1>

<?php foreach ($pokemons as $pokemon) : ?>
    <div class="card mb-1">
        <div class="card-header">
            #<?= $pokemon['id'] ?>
            <a href="show.php?id=<?= $pokemon['id'] ?>">
                <?= $pokemon['name'] ?>
            </a>
        </div>
        <div class="card-body">Un poids de <?= $pokemon['weight'] ?> g et une taille de <?= $pokemon['size'] ?> cm.</div>
    </div>
<?php endforeach; ?>


<?php include('partials/footer.php') ?>