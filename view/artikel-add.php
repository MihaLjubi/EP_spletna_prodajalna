<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj artikel</title>

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

<h1>Dodaj artikel</h1>

<form action="<?= BASE_URL . "artikli/add" ?>" method="post">
    <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
    <p><label>Cena: <input type="text" name="cena" value="<?= $cena ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="ne"/>
    <p><button>Dodaj</button></p>
</form>

<script>
    <?php require_once("static/javaScript/code.js");?>
</script>