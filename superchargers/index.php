<?php
include "../templates/chemin.php";
$basename=basename(__DIR__);

$tabElement=["Air","Eau","Feu","Lumière","Magie","Mort-vivant","Tech","Ténèbres","Terre","Vie"];
$tabVersion=["Supercharger","Élite"];
$tabSpecial=["Base","Dérive","Dark","Legendary"];
$tabStats=["sante"=>"Santé","vitesse"=>"Vitesse","armure"=>"Armure","coup_critique"=>"Coup critique"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$chemin;?>img/icon.png">
    <title>Skylanders</title>
    <link rel="stylesheet" href="<?=$chemin;?>css/font.css">
    <link rel="stylesheet" href="<?=$chemin;?>css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(()=>{
            $("#count").text($("main > article").length>1 ? $("main > article").length+" Skylanders" : $("main > article").length+" Skylander");

            $("#reset").click(function() {
                window.location.href=document.location.href.replace(document.location.search,"");
            })
        })
    </script>
</head>
<body class="<?=$basename;?>">
    <header>
        <section>
            <?php include("../templates/menu-logo.php"); ?>
        </section>
        <nav>
            <form id="filtreForm" method="get">
                <div>
                    <label for="element">Élément</label>
                    <select name="element" id="element">
                        <option value="" selected>--Sélectionner une valeur--</option>
                        <?php foreach($tabElement as $valElem) {
                            ?>
                            <option value="<?= $valElem; ?>" <?= isset($_GET["element"]) && $_GET["element"]==$valElem ? "selected" : ""?>><?= $valElem; ?></option>
                            <?php
                        } ?>
                    </select> 
                </div>
                
                <div>
                    <label for="version">Version</label>
                    <select name="version" id="version">
                        <option value="" selected>--Sélectionner une valeur--</option>
                        <?php foreach($tabVersion as $valVers) {
                            ?>
                            <option value="<?= $valVers; ?>" <?= isset($_GET["version"]) && $_GET["version"]==$valVers ? "selected" : ""?>><?= $valVers; ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
                
                <div>
                    <label for="special">Spécial</label>
                    <select name="special" id="special">
                        <option value="" selected>--Sélectionner une valeur--</option>
                        <?php foreach($tabSpecial as $valSpecial) {
                            ?>
                            <option value="<?= $valSpecial; ?>" <?= isset($_GET["special"]) && $_GET["special"]==$valSpecial ? "selected" : ""?>><?= $valSpecial; ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
                
                <div id="check">
                    <label for="stats">Ranger selon</label>
                    <select name="stats" id="stats">
                        <option value="" selected>--Sélectionner une valeur--</option>
                        <?php foreach($tabStats as $key=>$valStats) {
                            ?>
                            <option value="<?= $key; ?>" <?= isset($_GET["stats"]) && $_GET["stats"]==$valStats ? "selected" : ""?>><?= $valStats; ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
            </form>
            <div id="btns">
                <input type="submit" id="btnForm" form="filtreForm" value="Filtrer">
                <button id="reset">Réinitialiser</button>
                <a href="../collecte.php"><button id="btnCollecte">Collection</button></a>
            </div>
        </nav>
    </header>
    
    <h1 id="count"></h1>
    <main>
        <?php include("../card.php"); ?>
    </main>
</body>
</html>