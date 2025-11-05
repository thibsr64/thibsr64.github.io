<?php
// Génère une miniature à partir d'une image originale
function genererVignette($src, $dest, $largeurVoulue = 150, $hauteurVoulue = 150) {
    [$largeurSrc, $hauteurSrc] = getimagesize($src);
    $imgSrc = imagecreatefromjpeg($src);

    $vignette = imagecreatetruecolor($largeurVoulue, $hauteurVoulue);
    imagecopyresampled($vignette, $imgSrc, 0, 0, 0, 0, $largeurVoulue, $hauteurVoulue, $largeurSrc, $hauteurSrc);

    imagejpeg($vignette, $dest, 100); // qualité 80%
    imagedestroy($vignette);
    imagedestroy($imgSrc);
}

// Exemple : génération pour tous les fichiers de /images/
$dir = "../site/images";
$vignettes = "../site/vignettes";
if (!is_dir($vignettes)) mkdir($vignettes);

foreach (glob("$dir/*.jpg") as $img) {
    $nom = basename($img);
    genererVignette($img, "$vignettes/$nom");
}

echo "✅ Vignettes générées dans le dossier vignettes/";
?>
