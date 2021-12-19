<?php

$cena = 0;

if (!isset($_SERVER["HTTPS"]) && $_SESSION["role"] == "stranka") {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}

?>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Pregled narocila</title>

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

    <h1 style="margin-left: 10px">Pregled naročila</h1>
    
    <div class="main">
        <?php foreach ($artikli as $artikel):
            if(isset($_SESSION["cart"][$artikel["id_artikel"]])) {?>
                <p><b>Izdelek: </b><?= $artikel["ime"] ?> <b>Količina: </b><?= $_SESSION["cart"][$artikel["id_artikel"]] ?></p>
        <?php 
                $cena = $cena + $artikel["cena"] * $_SESSION["cart"][$artikel["id_artikel"]];
            } endforeach; ?>
                            
        <p>CENA:  <?= $cena ?> €</p>
        
        <div style="display: flex;">
            <a href="<?= BASE_URL . "artikli" ?>"><input type="button" value="Nazaj"/></a>
            <form action="<?= BASE_URL . "narocila/add" ?>" method="post">
                <input type="hidden" name="cena" value="<?= $cena ?>"  />
                <input type="hidden" name="status" value="neobdelano" />
                <p><button style="margin-top: -16px;">Zaključi nakup</button></p>
            </form>   
        </div>
    </div>

<script>
    <?php require_once("static/javaScript/code.js");?>
</script>


