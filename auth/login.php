<?php include('../partials/headerAuth.php'); ?>

<h1>Se connecter</h1>

<form action="loginTraitement.php" method="post">

    <div class="form-group">
        <label for="">Email</label>
        <input name="email" type="text" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mot de passe</label>
        <input name="password" type="password" class="form-control">
    </div>

    <button class="btn btn-primary float-right">Connexion</button>

</form>

<?php include('../partials/footer.php'); ?>