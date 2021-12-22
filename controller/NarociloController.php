<?php

require_once("model/NarociloDB.php");
require_once("model/StrankaDB.php");
require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class NarociloController { 
    public static function index() {
        $narocila = NarociloDB::getAll();
        $i = 0;
        foreach ($narocila as $narocilo):
            $stranka = StrankaDB::get(["id_stranka" => $narocilo["id_stranka"]]);
            $narocila[$i]["stranka_ime"] = $stranka["ime"];
            $narocila[$i]["stranka_priimek"] = $stranka["priimek"];
            $i++;
        endforeach;
        echo ViewHelper::render("view/narocilo-list.php", [
            "narocila" => $narocila
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
        $rules = ['status' => FILTER_SANITIZE_SPECIAL_CHARS];
        $rules["id_narocilo"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        $data = filter_input_array(INPUT_POST, $rules); 
        if (self::checkValues($data)) {
            NarociloDB::update($data);
            $list = $data["list"];
            header("Location: https://localhost/netbeans/spletnaProdajalna/index.php/narocila?status=$list");
        } else {
            self::pregled($data);
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
            'id_stranka' => FILTER_VALIDATE_INT,
            'cena' => FILTER_VALIDATE_FLOAT,
            'datum' => "",
            'status' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}

