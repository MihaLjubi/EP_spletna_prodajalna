<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj prodajalca</title>

<h1>Dodaj prodajalca</h1>

<p>[
<a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a>
]</p>

<form action="<?= BASE_URL . "prodajalci/add" ?>" method="post">
    <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $priimek ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $email ?>" /></label></p>
    <p><label>Geslo: <input type="text" name="geslo" value="<?= $geslo ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="ne"/>
    <p><button>Dodaj</button></p>
</form>