<?php
include "../templates/chemin.php";
$basename=basename(__DIR__);

$tabElement=["Air","Eau","Feu","Lumière","Magie","Mort-vivant","Tech","Ténèbres","Terre","Vie"];
$tabVersion=["Trap Master","Élite","Mini","Série 1","Série 2","Série 3","Série 4"];
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
            <?php include("../templates/menu-filtre.php"); ?>
        </nav>
    </header>
    
    <h1 id="count"></h1>
    <main>
        <?php include("../card.php"); ?>
    </main>
</body>
</html>