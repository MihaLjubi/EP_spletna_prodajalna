<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Stranke</title>

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

<h1>Stranke</h1>

<div class="main">
    <?php foreach ($stranke as $stranka): 
        if($stranka["izbrisan"] == "ne") { ?>
            <form>
                <div class="uporabniki">
                    <p><b>Ime: </b><?= $stranka["ime"] ?></p>
                    <p><b>Priimek: </b><?= $stranka["priimek"] ?></p>
                    <p><b>Naslov: </b><?= $stranka["ulica"] ?> <?= $stranka["hisna_stevilka"] ?>, <?= $stranka["postna_stevilka"] ?> <?= $stranka["posta"] ?></p>
                    <p><b>Email: </b><?= $stranka["email"] ?></p>
                    <a href="<?= BASE_URL . "stranke/edit?id_stranka=" . $stranka["id_stranka"] ?>"> [Uredi] </a>
                </div>
            </form>        
    <?php } endforeach; ?>
</div>

<script>
    <?php require_once("static/javaScript/code.js");?>
</script>