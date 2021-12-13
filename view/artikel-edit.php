<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Uredi artikel</title>

<h1>Uredi artikel</h1>

<p>[
<a href="<?= BASE_URL . "artikli" ?>">Artikli</a> |
<a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a>
]</p>

<form action="<?= BASE_URL . "artikli/edit" ?>" method="post">
    <input type="hidden" name="id_artikel" value="<?= $artikel["id_artikel"] ?>"  />
    <p><label>Ime: <input type="text" name="ime" value="<?= $artikel["ime"] ?>" autofocus /></label></p>
    <p><label>Cena: <input type="text" name="cena" value="<?= $artikel["cena"] ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="<?= $artikel["izbrisan"] ?>" />
    <p><button>Posodobi</button></p>
</form>

<form action="<?= BASE_URL . "artikli/delete" ?>" method="post">
    <input type="hidden" name="id_artikel" value="<?= $artikel["id_artikel"] ?>"  />
    <button type="submit" class="important">Odstrani</button>
</form>

<form action="<?= BASE_URL . "artikli/edit" ?>" method="post">
    <input type="hidden" name="id_artikel" value="<?= $artikel["id_artikel"] ?>"  />
    <input type="hidden" name="ime" value="<?= $artikel["ime"] ?>" autofocus />
    <input type="hidden" name="cena" value="<?= $artikel["cena"] ?>" />
    <input type="hidden" name="izbrisan" value=1 />
    <button type="submit" class="important">Deaktiviraj</button>
</form>

