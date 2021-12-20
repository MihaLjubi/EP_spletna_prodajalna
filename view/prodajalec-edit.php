<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Uredi prodajalca</title>

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

<h1>Uredi prodajalca</h1>

<form action="<?= BASE_URL . "prodajalci/edit" ?>" method="post">
    <input type="hidden" name="id_prodajalec" value="<?= $prodajalec["id_prodajalec"] ?>"  />
    <p><label>Ime: <input type="text" name="ime" value="<?= $prodajalec["ime"] ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $prodajalec["priimek"] ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $prodajalec["email"] ?>" /></label></p>
    <p><label>Geslo: <input type="text" name="geslo" value="" /></label></p>
    <input type="hidden" name="izbrisan" value="<?= $prodajalec["izbrisan"] ?>" />
    <p><button>Posodobi</button></p>
</form>

<form action="<?= BASE_URL . "prodajalci/delete" ?>" method="post">
    <input type="hidden" name="id_prodajalec" value="<?= $prodajalec["id_prodajalec"] ?>"  />
    <button <?php if($_SESSION["role"] == "prodajalec") echo "hidden" ?>  type="submit" class="important">Odstrani</button>
</form>

<form action="<?= BASE_URL . "prodajalci/edit" ?>" method="post">
    <input type="hidden" name="id_prodajalec" value="<?= $prodajalec["id_prodajalec"] ?>"  />
    <input type="hidden" name="ime" value="<?= $prodajalec["ime"] ?>" autofocus />
    <input type="hidden" name="priimek" value="<?= $prodajalec["priimek"] ?>" />
    <input type="hidden" name="email" value="<?= $prodajalec["email"] ?>" />
    <input type="hidden" name="geslo" value="<?= $prodajalec["geslo"] ?>" />
    <input type="hidden" name="izbrisan" value="da" />
    <button <?php if($_SESSION["role"] == "prodajalec") echo "hidden" ?> type="submit" class="important">Deaktiviraj</button>
</form>

<script>
    <?php require_once("static/javaScript/code.js");?>
</script>