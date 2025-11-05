<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    if ($login === 'trosa' && $mdp === 'Thibaut@22ROSA') {
        $_SESSION['admin'] = true;
        header('Location: backoffice.php');
        exit;
    } else {
        $erreur = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Connexion admin</title></head>
<body>
<h2>Connexion au back-office</h2>
<form method="post">
  Login : <input type="text" name="login" required><br>
  Mot de passe : <input type="password" name="mdp" required><br>
  <button type="submit">Se connecter</button>
</form>
<p style="color:red;"><?= $erreur ?? "" ?></p>
</body>
</html>
