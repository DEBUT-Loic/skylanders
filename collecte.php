<?php
include "templates/chemin.php";

if(!empty($_GET['jeu'])) {
    switch($_GET['jeu']) {
        case "spyros-adventure":
            $path = 'skylandersSpyrosAdventure.json';
            $title = "Spyro's Adventure";
            break;
        case "giants":
            $path = 'skylandersGiants.json';
            $title = "Giants";
            break;
        case "trap-team":
            $path = 'skylandersTrapTeam.json';
            $title = "Trap Team";
            break;
        case "superchargers":
            $path = 'skylandersSuperchargers.json';
            $title = "Superchargers";
            break;
    }

    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$chemin;?>css/font.css">
    <link rel="stylesheet" href="<?=$chemin;?>css/style.css">
    <title>Collection Skylanders</title>
</head>
<body id="collecteBody">
    <h1>Collection Skylanders</h1>
    <form id="choixJeuForm" method="get">
        <select name="jeu" id="jeu">
            <option value="spyros-adventure">Spyro's Adventure</option>
            <option value="giants">Giants</option>
            <option value="trap-team">Trap Team</option>
            <option value="superchargers">Superchargers</option>
        </select>
        <input type="submit" form="choixJeuForm">
    </form>

    <?php
    if(!empty($_GET['jeu'])) {
        ?>
        <h2>Skylanders <?=$title;?></h2>
        <form id="collectionForm" method="post"></form>
            <table>
                <?php
                $i=1;
                foreach($jsonData as $val) {
                    $_GET["jeu"]=="spyros-adventure" ? $val["version"]="" : $val["version"];
                    ?>
                    <tr>
                        <td><input type="checkbox" name="skylanders[]" value="<?=$val["id"]?>" id="skylanders<?=$i;?>" <?= $val["collecte"] ? "checked" : ""?>></td>
                        <td><label for="skylanders<?=$i;?>"><?= $val["special"]!="" && $val["special"]!==true ? $val["special"]." ".$val["nom"] : ($val["version"]=="Lightcore" ? $val["version"]." ".$val["nom"] : $val["nom"]); ?></label></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
            <input type="submit" form="collectionForm" value="Collecté">
        </form>
        <?php
    }
    ?>
</body>
</html>