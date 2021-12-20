<?php

require_once("model/ProdajalecDB.php");
require_once("model/StrankaDB.php");
require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

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
                    $authorized_users = ["Admin", "Janez"];
                    $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
                    $cert_data = openssl_x509_parse($client_cert);
                    $commonname = $cert_data['subject']['CN'];
                    
                    $found = false;
                    $prodajalci = ProdajalecDB::getAll();
                    foreach ($prodajalci as $prodajalec) {
                        if($prodajalec["email"] === $email && password_verify($geslo, $prodajalec["geslo"])) {
                            $found = true;
                            if (in_array($commonname, $authorized_users)) {
                                $_SESSION['id'] = $prodajalec["id_prodajalec"];
                                $_SESSION['ime'] = $prodajalec["ime"];
                                $_SESSION['priimek'] = $prodajalec["priimek"];
                                if($prodajalec["email"] == 'admin@admin')
                                    $_SESSION['role'] = "admin";
                                else
                                    $_SESSION['role'] = "prodajalec";
                                header("Location: artikli");
                            } else {
                                header("Location: login?error=Uporabnik ni avtoriziran");
                            }
                        }
                    }
                    $stranke = StrankaDB::getAll();
                    foreach ($stranke as $stranka) {                     
                        if($stranka["email"] === $email && password_verify($geslo, $stranka["geslo"])) {
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
    
    public static function registerForm($values = [
        "ime" => "",
        "priimek" => "",
        "ulica" => "",
        "hisna_stevilka" => "",
        "postna_stevilka" => "",
        "posta" => "",
        "email" => "",
        "geslo" => ""
    ]) {
        echo ViewHelper::render("view/register.php", $values);
    }

    public static function register() {
        $data = filter_input_array(INPUT_POST, self::getRules());
        if (self::checkValues($data)) {
                /*
                $token = md5($data['email']).rand(10,9999);
                $link = "<a href='localhost/netbeans/spletnaProdajalna/index.php/verify-email.php?key=".$data['email']."&token=".$token."'>Click and Verify Email</a>";
                try {
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                $mail->CharSet =  "utf-8";
                $mail->IsSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "user@example.com";
                $mail->Password = "secret";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
                $mail->Port = "465";

                $mail->setFrom('from@example.com', 'Mailer');
                $mail->AddAddress('matic46@gmail.com');

                $mail->IsHTML(true);
                $mail->Subject  =  'Reset Password';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            var_dump($link);
            var_dump($token);
            exit();
            */
            $hash = password_hash($data["geslo"], PASSWORD_DEFAULT);
            $data["geslo"] = $hash;
            $id = StrankaDB::insert($data);
            header("Location: login");
        } else {
            self::registerForm($data);
        }
    }
    
     function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);

       return $data;
    }
    
    private static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }
        
    private static function getRules() {
        return [
            'ime' => FILTER_SANITIZE_SPECIAL_CHARS,
            'priimek' => FILTER_SANITIZE_SPECIAL_CHARS,
            'ulica' => FILTER_SANITIZE_SPECIAL_CHARS,
            'hisna_stevilka' => FILTER_SANITIZE_NUMBER_INT,
            'postna_stevilka' => FILTER_SANITIZE_NUMBER_INT,
            'posta' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_SPECIAL_CHARS,
            'geslo' => FILTER_SANITIZE_SPECIAL_CHARS,
            'izbrisan' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}



