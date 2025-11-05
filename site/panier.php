<?php
session_start();
$xml = simplexml_load_file("listes_de_films.xml");

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajout au panier
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $_SESSION['panier'][] = $id;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon panier</title>
  <link rel="stylesheet" href ="../css/style.css">
</head>
<body>
    <header>
        <h1>Votre Panier</h1>
    </header>
<?php
if (empty($_SESSION['panier'])) {
    echo "<p>Le panier est vide.</p>";
} else {
    foreach ($_SESSION['panier'] as $id) {
        $film = $xml->xpath("//film[@id='$id']")[0];
        echo "<p>{$film->titre} - {$film->prix} €</p>";
        $total += floatval($film->prix);
    }
    echo "<p><strong>Total : $total €</strong></p>";
    echo '<a href="paiement.php">Procéder au paiement</a>';
}
?>

</body>
</html>
