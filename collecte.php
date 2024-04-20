<?php
include "templates/chemin.php";
$valide="";
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
        case "imaginators":
            $path = 'skylandersImaginators.json';
            $title = "Imaginators";
            break;
    }

    $valide=$_GET['jeu'];

    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
}

// Pour éviter le délai lors de l'envoi du formulaire
if(isset($_POST["btnCollection"])) {
    foreach($jsonData as $keySky=>$valSky) {
        $jsonData[$keySky]["collecte"]=false;

        if(!empty($_POST['skylanders'])) {
            foreach($_POST['skylanders'] as $valPost) {
                if($valPost==$valSky["id"]) {
                    $jsonData[$keySky]["collecte"]=true;
                    break;
                }
            }
        }
    }

    file_put_contents($path, json_encode($jsonData));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$chemin;?>img/icon.png">
    <link rel="stylesheet" href="<?=$chemin;?>css/font.css">
    <link rel="stylesheet" href="<?=$chemin;?>css/style.css">
    <title>Collection Skylanders</title>
</head>
<body id="collecteBody" class="<?= $valide; ?>">
    <a href="<?=$chemin;?>">Retour à l'index</a>
    <h1>Collection Skylanders</h1>
    <form id="choixJeuForm" method="get">
        <select name="jeu" id="jeu">
            <option value="spyros-adventure" <?=$valide=="spyros-adventure" ? "selected" : "";?>>Spyro's Adventure</option>
            <option value="giants" <?=$valide=="giants" ? "selected" : "";?>>Giants</option>
            <option value="trap-team" <?=$valide=="trap-team" ? "selected" : "";?>>Trap Team</option>
            <option value="superchargers" <?=$valide=="superchargers" ? "selected" : "";?>>Superchargers</option>
            <option value="imaginators" <?=$valide=="imaginators" ? "selected" : "";?>>Imaginators</option>
        </select>
        <input type="submit" id="btnChoixJeu" form="choixJeuForm">
    </form>

    <?php
    if(!empty($_GET['jeu'])) {
        ?>
        <h2>Skylanders <?=$title;?></h2>
        <form id="collectionForm" method="post">
            <table>
            <tr>
                <?php
                $i=1;
                foreach($jsonData as $val) {
                    $_GET["jeu"]=="spyros-adventure" ? $val["version"]="" : $val["version"];
                    ?>
                    <td>
                        <img src="<?=$chemin;?>img/<?=str_replace("-","",ucwords($_GET['jeu'],"-"));?>/<?= $val["special"]!="" && $val["special"]!==true ? $val["nom"]."_".$val["special"] : ($val["version"]=="Lightcore" ? $val["nom"]."_".$val["version"] : $val["nom"]); ?>.webp" alt="<?= $val["nom"]; ?>">
                        <label for="skylanders<?=$i;?>"><?= $val["special"]!="" && $val["special"]!==true ? $val["special"]." ".$val["nom"] : ($val["version"]=="Lightcore" ? $val["version"]." ".$val["nom"] : $val["nom"]); ?></label>
                        <input type="checkbox" name="skylanders[]" value="<?=$val["id"]?>" id="skylanders<?=$i;?>" <?= $val["collecte"]==true ? "checked" : ""?>>
                    </td>
                    <?php
                    $i++;
                }
                ?>
                </tr>
            </table>
            <input type="submit" id="btnCollection" form="collectionForm" name="btnCollection" value="Collecté">
        </form>
        <?php
    }
    ?>
</body>
</html>