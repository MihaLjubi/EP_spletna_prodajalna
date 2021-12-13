<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj artikel</title>

<h1>Dodaj artikel</h1>

<p>[
<a href="<?= BASE_URL . "artikli" ?>">Artikli</a>
]</p>

<form action="<?= BASE_URL . "artikli/add" ?>" method="post">
    <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
    <p><label>Cena: <input type="text" name="cena" value="<?= $cena ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="ne"/>
    <p><button>Dodaj</button></p>
</form>

