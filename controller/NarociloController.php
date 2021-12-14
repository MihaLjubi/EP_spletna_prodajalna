<?php

require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class NarociloController { 
    public static function pregled() {
        
        echo ViewHelper::render("view/narocilo-pregled.php", [
            "artikli" => ArtikelDB::getAll()
        ]);
        
    }
    
    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
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

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    private static function getRules() {
        return [
            'ime' => FILTER_SANITIZE_SPECIAL_CHARS,
            'cena' => FILTER_VALIDATE_FLOAT,
            'izbrisan' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}

