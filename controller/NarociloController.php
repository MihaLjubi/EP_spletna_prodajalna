<?php

require_once("model/NarociloDB.php");
require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class NarociloController { 
    public static function index() {
        echo ViewHelper::render("view/narocilo-list.php", [
            "narocila" => NarociloDB::getAll()
        ]);      
    }
    
    public static function pregled() {     
        echo ViewHelper::render("view/narocilo-pregled.php", [
            "artikli" => ArtikelDB::getAll()
        ]);       
    }
    
    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());
        if (self::checkValues($data)) {
            $id = NarociloDB::insert($data);
            unset($_SESSION["cart"]);
            echo ViewHelper::render("view/artikel-list.php", [
            "artikli" => ArtikelDB::getAll()
            ]);
        } else {
            self::addForm($data);
        }
    }
    
    public static function edit() {
        $rules = self::getRules();
        $rules["id_narocilo"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        $rules["list"] = 123;
        $data = filter_input_array(INPUT_POST, $rules);  
        if (self::checkValues($data)) {
            NarociloDB::update($data);
            $list = $data["list"];
            header("Location: https://localhost/netbeans/spletnaProdajalna/index.php/narocila?status=$list");
        } else {
            self::editForm($data);
        }
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
            'cena' => FILTER_VALIDATE_FLOAT,
            'status' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}

