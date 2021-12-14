<?php

require_once("model/ProdajalecDB.php");
require_once("model/StrankaDB.php");
require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class LoginController {
    public static function index() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['email']) && isset($_POST['geslo'])) {
                $email = self::validate($_POST['email']);
                $geslo = self::validate($_POST['geslo']);
                var_dump($email);
                var_dump($geslo);
                
                if (empty($email)) {
                    header("Location: login?error=Vnesite elektronski naslov");
                    exit();
                }else if(empty($geslo)){
                    header("Location: login?error=Vnesite geslo");
                    exit();
                }else{
                    $found = false;
                    $prodajalci = ProdajalecDB::getAll();
                    foreach ($prodajalci as $prodajalec) {
                        if($prodajalec["email"] === $email && $prodajalec["geslo"] === $geslo) {
                            $found = true;
                            $_SESSION['id'] = $prodajalec["id_prodajalec"];
                            $_SESSION['ime'] = $prodajalec["ime"];
                            $_SESSION['priimek'] = $prodajalec["priimek"];
                            $_SESSION['role'] = "prodajalec";
                            header("Location: artikli");
                        }
                    }
                    $stranke = StrankaDB::getAll();
                    foreach ($stranke as $stranka) {                     
                        if($stranka["email"] === $email && $stranka["geslo"] === $geslo) {
                            $found = true;
                            $_SESSION['id'] = $stranka["id_stranka"];
                            $_SESSION['ime'] = $stranka["ime"];
                            $_SESSION['priimek'] = $stranka["priimek"];
                            $_SESSION['role'] = "stranka";
                            header("Location: artikli");
                        }
                    }
                    if(!$found) {
                        header("Location: login?error=Naroben elektronski naslov ali geslo");
                        exit(); 
                   }
                }
            
            }
        } else {
            $parameters = [];
            echo ViewHelper::render("view/login.php", $parameters);
        }
    }
    
    public static function logout() {
        $parameters = [];
        echo ViewHelper::render("view/logout.php", $parameters);
    }
    
     function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);

       return $data;
    }
}



