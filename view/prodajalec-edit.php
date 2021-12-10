<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj prodajalca</title>

<h1>Dodaj prodajalca</h1>

<p>[
<a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a> |
<a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a>
]</p>

<form action="<?= BASE_URL . "prodajalci/edit" ?>" method="post">
    <input type="hidden" name="id_prodajalec" value="<?= $prodajalec["id_prodajalec"] ?>"  />
    <p><label>Ime: <input type="text" name="ime" value="<?= $prodajalec["ime"] ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $prodajalec["priimek"] ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $prodajalec["email"] ?>" /></label></p>
    <p><label>Geslo: <input type="text" name="geslo" value="<?= $prodajalec["geslo"] ?>" /></label></p>
    <p><button>Posodobi</button></p>
</form>

<form action="<?= BASE_URL . "prodajalci/delete" ?>" method="post">
    <input type="hidden" name="id_prodajalec" value="<?= $prodajalec["id_prodajalec"] ?>"  />
    <button type="submit" class="important">Odstrani</button>
</form>