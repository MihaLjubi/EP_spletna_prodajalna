<!DOCTYPE html>

<?php 
    if (!isset($_SESSION["role"]) || $_SESSION["role"] == "stranka") {
        throw new Exception("Dostop prepovedan");
    } 
?>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj stranko</title>

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

<h1>Dodaj stranko</h1>

<form action="<?= BASE_URL . "stranke/add" ?>" method="post">
    <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $priimek ?>" /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $ulica ?>" /></label></p>
    <p><label>Hisna stevilka: <input type="text" name="hisna_stevilka" value="<?= $hisna_stevilka ?>" /></label></p>
    <p><label>Postna stevilka: <input type="text" name="postna_stevilka" value="<?= $postna_stevilka ?>" /></label></p>
    <p><label>Posta: <input type="text" name="posta" value="<?= $posta ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $email ?>" /></label></p>
    <p><label>Geslo: <input type="text" name="geslo" value="<?= $geslo ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="ne"/>
    <p><button>Dodaj</button></p>
</form>

<script>
    <?php require_once("static/javaScript/code.js");?>
</script>