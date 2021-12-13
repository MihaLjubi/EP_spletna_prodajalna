<?php

$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
$cart_id = $_SESSION["email"];
var_dump($cart_id);

if ($method == "POST") {
    $validationRules = [
        'do' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                // dopustne vrednosti spremenljivke do, popravi po potrebi
                "regexp" => "/^(add_into_cart|purge_cart)$/"
            ]
        ],
        'id_artikel' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 0]
        ]
    ];
    $post = filter_input_array(INPUT_POST, $validationRules);
    
    switch ($post["do"]) {
        case "add_into_cart":
            try {
                $id = ["id_artikel" => $post["id_artikel"]];
                $artikel = ArtikelDB::get($id);

                if (isset($_SESSION[$cart_id][$artikel["id_artikel"]])) {
                    $_SESSION[$cart_id][$artikel["id_artikel"]]++;
                } else {
                    $_SESSION[$cart_id][$artikel["id_artikel"]] = 1;
                }
                
            } catch (Exception $exc) {
                die($exc->getMessage());
            }
            break;
        case "purge_cart":
            unset($_SESSION[$cart_id]);
            break;
        default:
            break;
        }
}

?><!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Artikli</title>

<h1>Artikli</h1>


<p>[
<a href="<?= BASE_URL . "artikli" ?>">Artikli</a> |
<a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a> |
<a href="<?= BASE_URL . "logout" ?>">Odjava</a>
]</p>

    <div id="main">
        <?php foreach ($artikli as $artikel): ?>
            <div class="artikel">
                <form action="<?= $url ?>" method="post">
                    <input type="hidden" name="do" value="add_into_cart" />
                    <input type="hidden" name="id_artikel" value="<?= $artikel["id_artikel"] ?>" />
                    <p><?= $artikel["ime"] ?></p>
                    <p><?= $artikel["cena"] ?>€<br/>
                    <button type="submit">V košarico</button><br>
                    <a href="<?= BASE_URL . "artikli/edit?id_artikel=" . $artikel["id_artikel"] ?>">Uredi</a>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cart">
        <h3>Košarica</h3>
        <p><?php
        $cena = 0;
        
        if(isset($_POST['minus'])) {
            if($_SESSION[$cart_id][$_POST['minus']] > 0)
                $_SESSION[$cart_id][$_POST['minus']]--;
            }
        if(isset($_POST['plus'])) {
            $_SESSION[$cart_id][$_POST['plus']]++;
        }
        
        if (isset($_SESSION[$cart_id])) {
            var_dump($_SESSION);
            $cena = 0;
            foreach ($_SESSION[$cart_id] as $id_artikel => $kolicina):
                  foreach ($artikli as $artikel):
                    if($id_artikel == $artikel["id_artikel"]) { 
                        $cena = $cena + ($artikel["cena"] * $kolicina) ?>
            <form method="post">
                <p><?= $artikel["ime"] ?> 
                <button type="submit" name="minus" value=<?= $artikel["id_artikel"] ?>>&minus;</button> <?=$kolicina?> 
                <button type="submit" name="plus" value=<?= $artikel["id_artikel"] ?>>&plus;</button>
            </form>
            <?php
                    }
                  endforeach;
             endforeach;
        } else {
            echo "Košara je prazna.";
        }            
        ?></p>
        <p>CENA:  <?=$cena ?></p>
        <form action="<?= $url ?>" method="post">
            <input type="hidden" name="do" value="purge_cart"/>
            <button>Izprazni</button>
        </form>
    </div>

