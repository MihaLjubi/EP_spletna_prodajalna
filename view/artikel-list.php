<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Artikli</title>

<h1>Artikli</h1>

<p>[
<a href="<?= BASE_URL . "artikli" ?>">Artikli</a> |
<a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a>
]</p>

    <div id="main">
        <?php foreach ($artikli as $artikel): ?>
            <div class="artikel">
                <form>
                    <p><?= $artikel["ime"] ?></p>
                    <p><?= $artikel["cena"] ?>€<br/>
                    <button type="submit">V košarico</button><br>
                    <a href="<?= BASE_URL . "artikli/edit?id_artikel=" . $artikel["id_artikel"] ?>">Uredi</a>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

