<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Uredi stranko</title>

<ul class="nav">
    <li id="artikli"><a href="<?= BASE_URL . "artikli" ?>">Artikli</a></li>
    <li id="artikliAdd"><a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a></li>
    <li id="prodajalci"><a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a></li>
    <li id="prodajalciAdd"><a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a></li>
    <li id="stranke"><a href="<?= BASE_URL . "stranke" ?>">Stranke</a></li>
    <li id="strankeAdd"><a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a></li>
    <li id="dropdown" class="dropdown">
      <a href="javascript:void(0)" class="dropbtn"><?= $_SESSION["ime"] ?> <?= $_SESSION["priimek"] ?></a>
      <div class="dropdown-content">
          <a href="
                  <?php 
                      if($_SESSION["role"] == "prodajalec") {
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

<h1>Uredi stranko</h1>

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
    <input type="hidden" name="izbrisan" value="<?= $stranka["izbrisan"] ?>" />
    <p><button>Posodobi</button></p>
</form>

<form action="<?= BASE_URL . "stranke/delete" ?>" method="post">
    <input type="hidden" name="id_stranka" value="<?= $stranka["id_stranka"] ?>"  />
    <button type="submit" class="important">Odstrani</button>
</form>

<form action="<?= BASE_URL . "stranke/edit" ?>" method="post">
    <input type="hidden" name="id_stranka" value="<?= $stranka["id_stranka"] ?>"  />
    <input type="hidden" name="ime" value="<?= $stranka["ime"] ?>" autofocus />
    <input type="hidden" name="priimek" value="<?= $stranka["priimek"] ?>" />
    <input type="hidden" name="ulica" value="<?= $stranka["ulica"] ?>"/>
    <input type="hidden" name="hisna_stevilka" value="<?= $stranka["hisna_stevilka"] ?>"/>
    <input type="hidden" name="postna_stevilka" value="<?= $stranka["postna_stevilka"] ?>"/>
    <input type="hidden" name="posta" value="<?= $stranka["posta"] ?>" />
    <input type="hidden" name="email" value="<?= $stranka["email"] ?>" />
    <input type="hidden" name="geslo" value="<?= $stranka["geslo"] ?>" />
    <input type="hidden" name="izbrisan" value="da" />
    <button type="submit" class="important">Deaktiviraj</button>
</form>

<script>
    <?php require_once("static/javaScript/code.js");?>
</script>