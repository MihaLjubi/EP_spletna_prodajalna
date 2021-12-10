<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj stranko</title>

<h1>Dodaj stranko</h1>

<p>[
<a href="<?= BASE_URL . "stranke" ?>">Stranke</a> |
<a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a>
]</p>

<form action="<?= BASE_URL . "stranke/edit" ?>" method="post">
    <input type="hidden" name="id_stranka" value="<?= $stranka["id_stranka"] ?>"  />
    <p><label>Ime: <input type="text" name="ime" value="<?= $stranka["ime"] ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $stranka["priimek"] ?>" /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $stranka["ulica"] ?>"/></label></p>
    <p><label>Hisna stevilka: <input type="text" name="hisna_stevilka" value="<?= $stranka["hisna_stevilka"] ?>"/></label></p>
    <p><label>Postna stevilka: <input type="text" name="postna_stevilka" value="<?= $stranka["postna_stevilka"] ?>"/></label></p>
    <p><label>Posta: <input type="text" name="posta" value="<?= $stranka["posta"] ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $stranka["email"] ?>" /></label></p>
    <p><label>Geslo: <input type="text" name="geslo" value="<?= $stranka["geslo"] ?>" /></label></p>
    <p><button>Posodobi</button></p>
</form>

<form action="<?= BASE_URL . "stranke/delete" ?>" method="post">
    <input type="hidden" name="id_stranka" value="<?= $stranka["id_stranka"] ?>"  />
    <button type="submit" class="important">Odstrani</button>
</form>