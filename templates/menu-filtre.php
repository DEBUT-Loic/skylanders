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

    <?php if(isset($tabVersion)) { ?>
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
    <?php } ?>

    <?php if(isset($tabClasse)) { ?>
    <div>
        <label for="classe">Classe</label>
        <select name="classe" id="classe">
            <option value="" selected>--Sélectionner une valeur--</option>
            <?php foreach($tabClasse as $valClasse) {
                ?>
                <option value="<?= $valClasse; ?>" <?= isset($_GET["classe"]) && $_GET["classe"]==$valClasse ? "selected" : ""?>><?= $valClasse; ?></option>
                <?php
            } ?>
        </select>
    </div>
    <?php } ?>

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

    <div>
        <label for="collecte">Collecté</label>
        <select name="collecte" id="collecte">
            <option value="" selected>--Sélectionner une valeur--</option>
            <option value="true" <?= isset($_GET["collecte"]) && $_GET["collecte"]=="true" ? "selected" : "" ?>>Trouvé</option>
            <option value="false" <?= isset($_GET["collecte"]) && $_GET["collecte"]=="false" ? "selected" : "" ?>>En recherche</option>
        </select>
    </div>
</form>
    <div id="btns">
    <input type="submit" id="btnForm" form="filtreForm" value="Filtrer">
    <button id="reset">Réinitialiser</button>
    <a href="../collecte.php"><button id="btnCollecte">Collection</button></a>
</div>