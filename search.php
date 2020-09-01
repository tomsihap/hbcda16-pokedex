<?php
require_once('config/db.php');

$req = "SELECT *
        FROM pokemon
        WHERE name LIKE :name
        OR description LIKE :description
        OR weight LIKE :weight
        OR size LIKE :size
        ";

$res = $bdd->prepare($req);
$res->execute([
    'name' => '%' . $_GET['query'] . '%',
    'description' => '%' . $_GET['query'] . '%',
    'weight' => '%' . $_GET['query'] . '%',
    'size' => '%' . $_GET['query'] . '%',
]);

$pokemons = $res->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include('partials/header.php') ?>

<h1>Résultats de recherche :</h1>

<p class="lead">
    <?php if (count($pokemons) === 0) : ?>
        Aucun résultat trouvé.
    <?php else : ?>
        <?= count($pokemons) ?> résultat(s) trouvé(s).
    <?php endif; ?>
</p>

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