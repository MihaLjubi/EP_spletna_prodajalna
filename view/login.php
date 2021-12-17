<!DOCTYPE html>

<html>

<head>
    <title>Prijava</title>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
</head>

<body>
    <ul class="nav">
      <li id="artikli"><a href="<?= BASE_URL . "artikli" ?>">Artikli</a></li>
      <li id="artikliAdd"><a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a></li>
      <li id="prodajalci"><a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a></li>
      <li id="prodajalciAdd"><a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a></li>
      <li id="stranke"><a href="<?= BASE_URL . "stranke" ?>">Stranke</a></li>
      <li id="strankeAdd"><a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a></li>
      <li id="narocila"><a href="<?= BASE_URL . "narocila" ?>">Narocila</a></li>
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

     <form action="<?= BASE_URL . "login" ?>" method="post">
        <h2>PRIJAVA</h2>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>User Name</label>
        <input type="text" name="email" placeholder="Elektronski naslov"><br>
        <label>Password</label>
        <input type="password" name="geslo" placeholder="Geslo"><br> 
        <button type="submit">Prijava</button>
     </form>
    
    <script>
        <?php require_once("static/javaScript/code.js");?>
    </script>

</body>

</html>