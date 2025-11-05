<!doctype html> <!--je définis l'extension du fichier-->
<html lang="fr"><!--langue-->
<head> <!--début de l'entête-->
  <meta charset="utf-8">
  <title>Liste des films disponibles</title> <!--titre de la page internet-->
  <link rel="stylesheet" href ="css/style.css"> <!--nom et chemin pour trouver la fiche de style-->
</head> <!--fin de l'entête-->
<body>
    <header>
        <h1>Vente de films en ligne</h1>
        <div align = "right">
            <button class = "connexion">
                <a href = "admin/login.php">Se connecter</a>
            </button><br>
            <button>S'inscrire</button><br>
            <button class = "panier">
                <a href = "site/panier.php">Mon panier</a>
            </button>
        </div>
    </header>
    <div class = "container">
        <?php
        $xml = new DomDocument();
        $xml->load("site/listes_de_films.xml");
        $listeFilms = $xml->getElementsByTagName("film");

        foreach ($listeFilms as $film) {
            $id = $film->getAttribute("id");
            $titre = $film->getElementsByTagName("Nom")->item(0)->nodeValue;
            $Realisateur = $film->getElementsByTagName("Realisateur")->item(0)->nodeValue;
            $prix = $film->getElementsByTagName("Prix")->item(0)->nodeValue;
            $image = $film->getElementsByTagName("image")->item(0)->nodeValue;

            echo "<div class='film'>";
            echo "<img src='$image' alt='$titre'><br>";
            echo "<strong>$titre</strong><br>$Realisateur<br><em>$prix €</em><br>";
            echo "<button>Ajouter au panier</button>";
            echo "</div>";
}
?>
    </div>
</body>
</html>