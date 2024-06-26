<?php
switch($basename) {
    case "spyros-adventure":
        $path = $chemin.'skylandersSpyrosAdventure.json';
        break;
    case "giants":
        $path = $chemin.'skylandersGiants.json';
        break;
    case "swap-force":
        $path = $chemin.'skylandersSwapForce.json';
        break;
    case "trap-team":
        $path = $chemin.'skylandersTrapTeam.json';
        break;
    case "superchargers":
        $path = $chemin.'skylandersSuperchargers.json';
        break;
    case "imaginators":
        $path = $chemin.'skylandersImaginators.json';
        break;
}

$jsonString = file_get_contents($path);
$jsonData = json_decode($jsonString, true);
asort($jsonData);
$jsonData=array_values($jsonData);

if(!empty($_GET["stats"])) {
    function compareStats($a, $b) {
        if ($a[$_GET['stats']] == $b[$_GET['stats']]) {
            return 0;
        }
        return ($a[$_GET['stats']] > $b[$_GET['stats']]) ? -1 : 1;
    }
    usort($jsonData, 'compareStats');
}

$_GET['stats']="";
if(!empty($_GET['element']) || !empty($_GET['version']) || !empty($_GET['classe']) || !empty($_GET['special']) || !empty($_GET['collecte'])) {
    $_GET=array_filter($_GET);

    if(isset($_GET['collecte']) && $_GET['collecte']=="false") {
       $_GET['collecte']=filter_var($_GET['collecte'], FILTER_VALIDATE_BOOLEAN); 
    }
    foreach($jsonData as $keyJson=>$valJson) {
        foreach($_GET as $keyGet=>$valGet) {
            if(isset($valJson)) {
                if(($valJson[$keyGet]!=$valGet && ($keyGet!="special" || $keyGet=="collecte")) || ($valGet=="Base" && $valJson[$keyGet]!==null) || ($valGet=="Dérive" && $valJson[$keyGet]===null) || ($valGet=="Legendary" && $valJson[$keyGet]!="Legendary")) {
                    unset($jsonData[$keyJson]);
                }
            }
        }
    }
}

foreach($jsonData as $val) {
    if(!isset($val["version"])) {
        $val["version"]="";
    }
    ?>
    <article class="<?= strtolower($val["element"]); ?> <?= $val["special"]=="Legendary" ? strtolower($val["special"]) : ""; ?>">
        <h1><?= $val["special"]!="" && $val["special"]!==true ? $val["special"]." ".$val["nom"] : ($val["version"]=="Lightcore" ? $val["version"]." ".$val["nom"] : $val["nom"]); ?></h1>
        <div class="imgCard">
            <img src="<?=$chemin;?>img/<?=str_replace("-","",ucwords($basename,"-"));?>/<?= $val["special"]!="" && $val["special"]!==true ? $val["nom"]."_".$val["special"] : ($val["version"]=="Lightcore" ? $val["nom"]."_".$val["version"] : $val["nom"]); ?>.webp" alt="<?= $val["nom"]; ?>">
            <small><?php if($basename!="spyros-adventure") {echo $val["version"];} ?></small>
        </div>
        <div class="stats">
            <?php
            if($basename=="imaginators") {
            ?>
            <ul>
                <li><b>Santé</b> : <?= $val["sante"]; ?></li>
                <li><b>Attaque</b> : <?= $val["attaque"]; ?></li>
                <li><b>Armure</b> : <?= $val["armure"]; ?></li>
                <li><b>Vitesse</b> : <?= $val["vitesse"]; ?></li>
                <li><b>Chance</b> : <?= $val["chance"]; ?></li>
                <li><b>Puissance élémentaire</b> : <?= $val["puissance_elementaire"]; ?></li>
            </ul>
            <?php
            }
            else {
            ?>
            <ul>
                <li><b>Santé</b> : <?= $val["sante"]; ?></li>
                <li><b>Vitesse</b> : <?= $val["vitesse"]; ?></li>
                <li><b>Armure</b> : <?= $val["armure"]; ?></li>
                <li><b>Coup critique</b> : <?= $val["coup_critique"]; ?></li>
                <li><b>Puissance élémentaire</b> : <?= $val["puissance_elementaire"]; ?></li>
            </ul>
            <?php
            }
            ?>
            </div>
        
        <?php if($val["collecte"]==true) { ?> <div class="collecte trouve"><p>Trouvé !</p> </div><?php } else { ?><div class="collecte search"><p>Recherche...</p> <?php } ?>        
    </article>
    <?php
}
?>