<!DOCTYPE html>

<?php
    if (!isset($_SERVER["HTTPS"])) {
        $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        header("Location: " . $url);
    }
?>

<?php           
    $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    function secure_generate_string($input, $strength = 5, $secure = true) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            if($secure) {
                $random_character = $input[random_int(0, $input_length - 1)];
            } else {
                $random_character = $input[mt_rand(0, $input_length - 1)];
            }
            $random_string .= $random_character;
        }

        return $random_string;
    }
    
    function generate_capatcha($permitted_chars) {
        $im = imagecreatetruecolor(200, 50);
        imageantialias($im, true);

        $colors = [];

        $red = rand(125, 175);
        $green = rand(125, 175);
        $blue = rand(125, 175);

        for($i = 0; $i < 5; $i++) {
            $colors[] = imagecolorallocate($im, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
        }
        imagefill($im, 0, 0, $colors[0]);

        for($i = 0; $i < 10; $i++) {
            imagesetthickness($im, rand(2, 10));
            $rect_color = $colors[rand(1, 4)];
            imagerectangle($im, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
        }

        $black = imagecolorallocate($im, 0, 0, 0);
        $white = imagecolorallocate($im, 255, 255, 255);
        $textcolors = [$black, $white];

        $fonts = [dirname(__FILE__, 2).'/static/fonts/Comic.ttf', dirname(__FILE__, 2).'/static/fonts/Ubuntu.ttf', dirname(__FILE__, 2).'/static/fonts/Bodo.ttf', dirname(__FILE__, 2).'/static/fonts/KOMIKAX.ttf'];

        $string_length = 6;
        $captcha_string = secure_generate_string($permitted_chars, $string_length);
        
        echo "<input type='hidden' id='captcha-string' value='$captcha_string' /> ";

        for($i = 0; $i < $string_length; $i++) {
            $letter_space = 170/$string_length;
            $initial = 15;

            imagettftext($im, 20, rand(-15, 15), $initial + $i*$letter_space, rand(20, 40), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
        }

        ob_start ();

        imagejpeg($im);
        imagedestroy($im);

        $data = ob_get_contents ();
        ob_end_clean ();

        return "<img class='captcha-image' src='data:image/jpeg;base64,".base64_encode ($data)."'>";
    }
?>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "all.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "fontawesome.min.css" ?>">
<meta charset="UTF-8" />
<title>Registracija</title>

<ul class="nav">
      <li id="artikli"><a href="<?= BASE_URL . "artikli" ?>">Artikli</a></li>
      <li id="artikliAdd"><a href="<?= BASE_URL . "artikli/add" ?>">Dodaj artikel</a></li>
      <li id="prodajalci"><a href="<?= BASE_URL . "prodajalci" ?>">Prodajalci</a></li>
      <li id="prodajalciAdd"><a href="<?= BASE_URL . "prodajalci/add" ?>">Dodaj prodajalca</a></li>
      <li id="stranke"><a href="<?= BASE_URL . "stranke" ?>">Stranke</a></li>
      <li id="strankeAdd"><a href="<?= BASE_URL . "stranke/add" ?>">Dodaj stranko</a></li>
      <li id="narocila"><a href="<?= BASE_URL . "narocila" ?>">Narocila</a></li>
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

<h1>Registracija</h1>

<?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<form action="<?= BASE_URL . "register" ?>" method="post">
    <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="priimek" value="<?= $priimek ?>" /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $ulica ?>" /></label></p>
    <p><label>Hisna stevilka: <input type="text" name="hisna_stevilka" value="<?= $hisna_stevilka ?>" /></label></p>
    <p><label>Postna stevilka: <input type="text" name="postna_stevilka" value="<?= $postna_stevilka ?>" /></label></p>
    <p><label>Posta: <input type="text" name="posta" value="<?= $posta ?>" /></label></p>
    <p><label>Email: <input type="text" name="email" value="<?= $email ?>" /></label></p>
    <p><label>Geslo: <input type="password" name="geslo" value="<?= $geslo ?>" /></label></p>
    <input type="hidden" name="izbrisan" value="ne"/>
    <div id="captcha-div">
        <?php echo generate_capatcha($permitted_chars); ?> <i class="fas fa-redo refresh-captcha"></i> <br>
    </div>
    <input style="margin-top: 5px" type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">  
    <input type='hidden' id='captcha-value' name='captcha-value'/>
    <p><button>Registriraj se</button></p>
</form>

<script>
    <?php require_once("static/javaScript/code.js");?>
        
    var refreshButton = document.querySelector(".refresh-captcha");
    refreshButton.onclick = function() {
      window.location.reload();
    }
    
    window.onload = function() {
        document.getElementById('captcha-value').value = document.getElementById('captcha-string').value;
    }
</script>

