<?php include('../partials/headerAuth.php'); ?>

<h1>Créer un compte</h1>

<form action="registerTraitement.php" method="post">

    <div class="form-group">
        <label for="">Email</label>
        <input name="email" type="text" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mot de passe</label>
        <input name="password" type="password" class="form-control">
    </div>

    <button class="btn btn-primary float-right">Créer un compte</button>

</form>

<?php include('../partials/footer.php'); ?>