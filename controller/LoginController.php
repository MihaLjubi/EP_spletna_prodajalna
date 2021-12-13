<?php

require_once("model/ProdajalecDB.php");
require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class LoginController {
    public static function index() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['email']) && isset($_POST['geslo'])) {
                $email = self::validate($_POST['email']);
                $geslo = self::validate($_POST['geslo']);
                
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
                            $_SESSION['email'] = $prodajalec["email"];
                            $_SESSION['id'] = $prodajalec["id_prodajalec"];
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



