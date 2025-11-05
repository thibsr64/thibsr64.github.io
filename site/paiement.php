<?php
session_start();

$erreur = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = $_POST["numcarte"];
    $date = $_POST["date"];

    if (!preg_match("/^[0-9]{16}$/", $num)) {
        $erreur = "Le numéro de carte doit contenir 16 chiffres.";
    } elseif ($num[0] !== $num[15]) {
        $erreur = "Le dernier chiffre doit être identique au premier.";
    } else {
        $dateValidite = new DateTime($date);
        $dateMin = (new DateTime())->modify('+3 months');

        if ($dateValidite < $dateMin) {
            $erreur = "La date de validité doit être supérieure à 3 mois à partir d'aujourd'hui.";
        } else {
            $erreur = "✅ Paiement accepté !";
            $_SESSION['panier'] = []; // vider le panier
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement</title>
</head>
<body>

<h1>Paiement</h1>

<form method="post">
  Numéro de carte : <input type="text" name="numcarte" maxlength="16" required><br><br>
  Date de validité : <input type="month" name="date" required><br><br>
  <button type="submit">Valider le paiement</button>
</form>

<p style="color:red;"><?= $erreur ?></p>

</body>
</html>
