<?php

require_once("model/StrankaDB.php");
require_once("ViewHelper.php");

class StrankaController {
    
    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if (self::checkValues($data)) {
            echo ViewHelper::render("view/stranka-detail.php", [
                "stranka" => StrankaDB::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/stranka-list.php", [
                "stranke" => StrankaDB::getAll()
            ]);
        }
    }
    
    public static function addForm($values = [
        "ime" => "",
        "priimek" => "",
        "ulica" => "",
        "hisna_stevilka" => "",
        "postna_stevilka" => "",
        "posta" => "",
        "email" => "",
        "geslo" => ""
    ]) {
        echo ViewHelper::render("view/stranka-add.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $hash = password_hash($data["geslo"], PASSWORD_DEFAULT);
            $data["geslo"] = $hash;
            $id = StrankaDB::insert($data);
            echo ViewHelper::render("view/stranka-list.php", [
            "stranke" => StrankaDB::getAll()
            ]);
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($stranka = []) {
        if (empty($stranka)) {
            $rules = [
                "id_stranka" => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }

            $stranka = StrankaDB::get($data);
        }

        echo ViewHelper::render("view/stranka-edit.php", ["stranka" => $stranka]);
    }

    public static function edit() {
        $rules = self::getRules();
        $rules["id_stranka"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            $hash = password_hash($data["geslo"], PASSWORD_DEFAULT);
            $data["geslo"] = $hash;
            StrankaDB::update($data);
            echo ViewHelper::render("view/stranka-list.php", [
            "stranke" => StrankaDB::getAll()
            ]);
        } else {
            self::editForm($data);
        }
    }

    public static function delete() {
        $rules = [
            'id_stranka' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            StrankaDB::delete($data);
            $url = BASE_URL . "stranke";
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "stranke/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "stranke";
            }
        }

        ViewHelper::redirect($url);
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

