<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj stranko</title>

<h1>Dodaj stranko</h1>

<p>[
<a href="<?= BASE_URL . "stranke" ?>">Stranke</a>
]</p>

<form action="<?= BASE_URL . "stranke/add" ?>" method="post">
    <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $priimek ?>" /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $ulica ?>" /></label></p>
    <p><label>Hisna stevilka: <input type="text" name="hisna_stevilka" value="<?= $hisna_stevilka ?>" /></label></p>
    <p><label>Postna stevilka: <input type="text" name="postna_stevilka" value="<?= $postna_stevilka ?>" /></label></p>
    <p><label>Posta: <input type="text" name="posta" value="<?= $posta ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $email ?>" /></label></p>
    <p><label>Geslo: <input type="text" name="geslo" value="<?= $geslo ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="ne"/>
    <p><button>Dodaj</button></p>
</form>