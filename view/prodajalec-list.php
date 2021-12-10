<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Prodajalci</title>

<h1>Prodajalci</h1>

<p>[
<a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a> |
<a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a>
]</p>

<div id="main">
    <?php foreach ($prodajalci as $prodajalec): ?>
            <form>
                <div class="uporabniki">
                    <p><b>Ime: </b><?= $prodajalec["ime"] ?></p>
                    <p><b>Priimek: </b><?= $prodajalec["priimek"] ?></p>
                    <p><b>Email: </b><?= $prodajalec["email"] ?></p>
                    <a href="<?= BASE_URL . "prodajalci/edit?id_prodajalec=" . $prodajalec["id_prodajalec"] ?>"> [Uredi] </a>
                </div>
            </form>        
    <?php endforeach; ?>
</div>