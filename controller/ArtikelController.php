<?php

require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class ArtikelController {
    
    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if (self::checkValues($data)) {
            echo ViewHelper::render("view/artikel-detail.php", [
                "artikel" => ArtikelDB::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/artikel-list.php", [
                "artikli" => ArtikelDB::getAll()
            ]);
        }
    }
    
    public static function addForm($values = [
        "ime" => "",
        "cena" => "",
    ]) {
        echo ViewHelper::render("view/artikel-add.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = ArtikelDB::insert($data);
            echo ViewHelper::render("view/artikel-list.php", [
            "artikli" => ArtikelDB::getAll()
            ]);
        } else {
            self::addForm($data);
        }
}

    public static function editForm($artikel = []) {
        if (empty($artikel)) {
            $rules = [
                "id_artikel" => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }

            $artikel = ArtikelDB::get($data);
        }

        echo ViewHelper::render("view/artikel-edit.php", ["artikel" => $artikel]);
    }

    public static function edit() {
        $rules = self::getRules();
        $rules["id_artikel"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            ArtikelDB::update($data);
            echo ViewHelper::render("view/artikel-list.php", [
            "artikli" => ArtikelDB::getAll()
            ]);
        } else {
            self::editForm($data);
        }
    }

    public static function delete() {
        $rules = [
            'id_artikel' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            ArtikelDB::delete($data);
            $url = BASE_URL . "artikli";
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "artikli/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "artikli";
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
            'cena' => FILTER_VALIDATE_FLOAT,
        ];
    }
}

