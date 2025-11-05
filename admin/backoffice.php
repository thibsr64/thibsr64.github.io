<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$xmlFile = "../site/listes_de_films.xml";
$xml = simplexml_load_file($xmlFile);

// Suppression
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $i = 0;
    foreach ($xml->film as $film) {
        if ($film['id'] == $id) {
            unset($xml->film[$i]);
            break;
        }
        $i++;
    }
    $xml->asXML($xmlFile);
    header("Location: backoffice.php");
    exit;
}

// Ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = uniqid();
    $film = $xml->addChild('film');
    $film->addAttribute('id', $id);
    $film->addChild('titre', $_POST['titre']);
    $film->addChild('auteur', $_POST['auteur']);
    $film->addChild('date', $_POST['date']);
    $film->addChild('prix', $_POST['prix']);
    $film->addChild('note', $_POST['note']);
    $film->addChild('image', "../site/images/" . $_POST['image']);

    $xml->asXML($xmlFile);
    header("Location: backoffice.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Back-office</title></head>
<body>
<h1>Back-office</h1>
<a href="logout.php">🔒 Déconnexion</a>

<h2>Ajouter un film</h2>
<form method="post">
  Titre: <input name="titre" required><br>
  Auteur: <input name="auteur" required><br>
  Date: <input name="date" required><br>
  Prix: <input name="prix" required><br>
  Note: <input name="note" required><br>
  Nom du fichier image (déjà dans /images/): <input name="image" required><br>
  <button type="submit">Ajouter</button>
</form>

<h2>Liste des films</h2>
<ul>
<?php foreach ($xml->film as $film): ?>
  <li>
    <?= $film->titre ?> (<?= $film->auteur ?>) - <?= $film->prix ?> € 
    <a href="?supprimer=<?= $film['id'] ?>" onclick="return confirm('Supprimer ?')">🗑️</a>
  </li>
<?php endforeach; ?>
</ul>
</body>
</html>
