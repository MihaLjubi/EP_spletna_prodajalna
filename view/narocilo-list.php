<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Narocila</title>

<ul class="nav">
    <li id="artikli"><a href="<?= BASE_URL . "artikli" ?>">Artikli</a></li>
    <li id="artikliAdd"><a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a></li>
    <li id="prodajalci"><a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a></li>
    <li id="prodajalciAdd"><a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a></li>
    <li id="stranke"><a href="<?= BASE_URL . "stranke" ?>">Stranke</a></li>
    <li id="strankeAdd"><a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a></li>
    <li id="narocila"><a href="<?= BASE_URL . "narocila?status=all" ?>">Narocila</a></li>
    <li id="dropdown" class="dropdown">
        <a href="javascript:void(0)" class="dropbtn"><?php if(isset($_SESSION["ime"])) echo $_SESSION["ime"] ?> <?php if(isset($_SESSION["priimek"])) echo $_SESSION["priimek"] ?></a>
        <div class="dropdown-content">
            <a href="
                    <?php 
                        if(isset($_SESSION["role"])) {
                            if($_SESSION["role"] == "prodajalec" || $_SESSION["role"] == "admin") {
                                echo BASE_URL . "prodajalci/edit?id_prodajalec=" . $_SESSION["id"];
                            } else {
                                echo BASE_URL . "stranke/edit?id_stranka=" . $_SESSION["id"];
                            } 
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

<h1>Narocila</h1>

<div class="main">
    <p>[
        <a href="<?= BASE_URL . "narocila?status=all" ?>">Vsa</a> |
        <a href="<?= BASE_URL . "narocila?status=neobdelano" ?>">Neobdelana</a> |
        <a href="<?= BASE_URL . "narocila?status=potrjeno" ?>">Potrjena</a> |
        <a href="<?= BASE_URL . "narocila?status=preklicano" ?>">Preklicana</a>
    ]</p>
    <?php
    foreach ($narocila as $narocilo): 
        if($narocilo["status"] == $_GET["status"] || $_GET["status"] == "all" || ($narocilo["status"] == "stornirano" && $_GET["status"] == "preklicano")) {?>
        <div style="
            display: flex;
            justify-content: space-between;
            width: auto;
            min-height: 100px;
            margin: 1em;
            border: 1px solid black;
            vertical-align: top;">
                <div style="margin-left: 20px">
                    <p><b>Stranka: </b><?= $narocilo["stranka_ime"] ?> <?= $narocilo["stranka_priimek"] ?></p>
                    <p><b>Datum: </b><?= $narocilo["datum"] ?></p>
                    <p><b>Cena: </b><?= $narocilo["cena"] ?>€</p>
                    <p><b>Status: </b><?= $narocilo["status"] ?></p>
                </div>
                
                <div style="margin-right: 20px">
                    <form <?php if($narocilo["status"] != "neobdelano") echo "hidden" ?> action="<?= BASE_URL . "narocila/edit" ?>" method="post">
                        <input type="hidden" name="id_narocilo" value="<?= $narocilo["id_narocilo"] ?>" />
                        <input type="hidden" name="status" value="potrjeno" />
                        <p><button>Potrdi</button></p>
                    </form>
                    <form  <?php if($narocilo["status"] != "neobdelano") echo "hidden" ?> action="<?= BASE_URL . "narocila/edit" ?>" method="post">
                        <input type="hidden" name="id_narocilo" value="<?= $narocilo["id_narocilo"] ?>" />
                        <input type="hidden" name="status" value="preklicano" />
                        <p><button>Prekliči</button></p>
                    </form>
                    <form <?php if($narocilo["status"] != "potrjeno") echo "hidden" ?> action="<?= BASE_URL . "narocila/edit" ?>" method="post">
                        <input type="hidden" name="id_narocilo" value="<?= $narocilo["id_narocilo"] ?>" />
                        <input type="hidden" name="status" value="stornirano" />
                        <p><button>Storniraj</button></p>
                    </form>
                </div>             
        </div>
        <?php } endforeach; ?>
</div>
<script>
    <?php require_once("static/javaScript/code.js");?>
</script>