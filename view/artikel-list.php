<?php

$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);

function role_display() {
    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == "stranka") 
            echo "hidden";
        } else {
            echo "hidden";
        }
}

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

                if (isset($_SESSION["cart"][$artikel["id_artikel"]])) {
                    $_SESSION["cart"][$artikel["id_artikel"]]++;
                } else {
                    $_SESSION["cart"][$artikel["id_artikel"]] = 1;
                }
                
            } catch (Exception $exc) {
                die($exc->getMessage());
            }
            break;
        case "purge_cart":
            unset($_SESSION["cart"]);
            break;
        default:
            break;
        }
}

?><!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
        <meta charset="UTF-8" />
        <title>Artikli</title>
    </head>
    <body>
        
    <ul class="nav">
      <li id="artikli"><a href="<?= BASE_URL . "artikli" ?>">Artikli</a></li>
      <li id="artikliAdd"><a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a></li>
      <li id="prodajalci"><a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a></li>
      <li id="prodajalciAdd"><a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a></li>
      <li id="stranke"><a href="<?= BASE_URL . "stranke" ?>">Stranke</a></li>
      <li id="strankeAdd"><a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a></li>
      <li id="narocila"><a href="<?= BASE_URL . "narocila?status=all" ?>">Narocila</a></li>
      <li id="dropdown" class="dropdown">
        <a href="javascript:void(0)" class="dropbtn"><?= $_SESSION["ime"] ?> <?= $_SESSION["priimek"] ?></a>
        <div class="dropdown-content">
            <a href="
                    <?php 
                        if($_SESSION["role"] == "prodajalec" || $_SESSION["role"] == "admin") {
                            echo BASE_URL . "prodajalci/edit?id_prodajalec=" . $_SESSION["id"];
                        } else {
                            echo BASE_URL . "stranke/edit?id_stranka=" . $_SESSION["id"];
                        } 
                    ?>">Uredi podatke</a>
            <a href="<?= BASE_URL . "logout" ?>">Odjava</a>
        </div>
      </li>
      <li id="login" style="float: right"><a href="<?= BASE_URL . "login" ?>">Prijava</a></li>
      <li id="register" style="float: right"><a href="<?= BASE_URL . "register" ?>">Registracija</a></li>
    </ul>
    <input id="role" type="hidden" name="izbrisan" value="<?php if(isset($_SESSION["role"])) { 
        echo $_SESSION["role"];          
    } else {
        echo "notlogged";
    } ?>" />

    <h1 style="margin-left: 10px">Artikli</h1>

        <div class="main">
            <?php foreach ($artikli as $artikel):
                if($artikel["izbrisan"] == "ne") {?>
                <div class="artikel">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="add_into_cart" />
                        <input type="hidden" name="id_artikel" value="<?= $artikel["id_artikel"] ?>" />
                        <p><?= $artikel["ime"] ?></p>
                        <p><?= $artikel["cena"] ?>€<br/>
                        <button <?php if(!isset($_SESSION["role"]) || $_SESSION["role"] == "prodajalec" || $_SESSION["role"] == "admin") echo "hidden" ?> type="submit">V košarico</button><br>
                        <a <?php role_display() ?> href="<?= BASE_URL . "artikli/edit?id_artikel=" . $artikel["id_artikel"] ?>">Uredi</a>
                    </form>
                </div>
                <?php } endforeach; ?>
        </div>

        <div <?php if(!isset($_SESSION["role"]) || $_SESSION["role"] == "prodajalec" || $_SESSION["role"] == "admin") echo "hidden" ?> class="cart">
            <h3>Košarica</h3>
            <p><?php
            $cena = 0;

            if(isset($_POST['minus'])) {
                if($_SESSION["cart"][$_POST['minus']] > 0)
                    $_SESSION["cart"][$_POST['minus']]--;
                }
            if(isset($_POST['plus'])) {
                $_SESSION["cart"][$_POST['plus']]++;
            }

            if (isset($_SESSION["cart"])) {
                $cena = 0;
                foreach ($_SESSION["cart"] as $id_artikel => $kolicina):
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
            <div style="display: flex;">
                <form action="<?= $url ?>" method="post" style="margin-right: 10px">
                    <input type="hidden" name="do" value="purge_cart"/>
                    <button>Izprazni</button>
                </form>
                <a href="<?= BASE_URL . "narocila/pregled" ?>"><input type="button" value="Zakljuci nakup"/></a>
            </div>      
        </div>

        <script>
            <?php require_once("static/javaScript/code.js");?>
        </script>
    </body>
</html>


