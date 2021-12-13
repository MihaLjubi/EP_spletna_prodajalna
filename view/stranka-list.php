<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Stranke</title>

<h1>Stranke</h1>

<p>[
<a href="<?= BASE_URL . "stranke" ?>">Stranke</a> |
<a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a>
]</p>

<div id="main">
    <?php foreach ($stranke as $stranka): 
        if($stranka["izbrisan"] == "ne") { ?>
            <form>
                <div class="uporabniki">
                    <p><b>Ime: </b><?= $stranka["ime"] ?></p>
                    <p><b>Priimek: </b><?= $stranka["priimek"] ?></p>
                    <p><b>Naslov: </b><?= $stranka["ulica"] ?> <?= $stranka["hisna_stevilka"] ?>, <?= $stranka["postna_stevilka"] ?> <?= $stranka["posta"] ?></p>
                    <p><b>Email: </b><?= $stranka["email"] ?></p>
                    <a href="<?= BASE_URL . "stranke/edit?id_stranka=" . $stranka["id_stranka"] ?>"> [Uredi] </a>
                </div>
            </form>        
    <?php } endforeach; ?>
</div>