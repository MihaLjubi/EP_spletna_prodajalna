<?php

require_once("model/ProdajalecDB.php");
require_once("ViewHelper.php");

class ProdajalecController {
    
    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if (self::checkValues($data)) {
            echo ViewHelper::render("view/prodajalec-detail.php", [
                "prodajalec" => ProdajalecDB::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/prodajalec-list.php", [
                "prodajalci" => ProdajalecDB::getAll()
            ]);
        }
    }
    
    public static function addForm($values = [
        "ime" => "",
        "priimek" => "",
        "email" => "",
        "geslo" => ""
    ]) {
        echo ViewHelper::render("view/prodajalec-add.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());;
        if (self::checkValues($data)) {
            $hash = password_hash($data["geslo"], PASSWORD_DEFAULT);
            $data["geslo"] = $hash;
            $id = ProdajalecDB::insert($data);
            header("Location: https://localhost/netbeans/spletnaProdajalna/prodajalci");
        } else {
            self::addForm($data);
        }
}

    public static function editForm($prodajalec = []) {
        if (empty($prodajalec)) {
            $rules = [
                "id_prodajalec" => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }

            $prodajalec = ProdajalecDB::get($data);
        }

        echo ViewHelper::render("view/prodajalec-edit.php", ["prodajalec" => $prodajalec]);
    }

    public static function edit() {
        $rules = self::getRules();
        $rules["id_prodajalec"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        $rules["update_password"] = [FILTER_REQUIRE_SCALAR];
        $data = filter_input_array(INPUT_POST, $rules);
        if($data["update_password"] == null)
            $data["update_password"] = "off";
        if($data["update_password"] == "off")
            $data["geslo"] = $_SESSION['geslo'];
        if($data["update_password"] == "on" && $data["geslo"] == "")
           header('Location: edit?id_prodajalec=' .$_SESSION["id"] ."&error=Vnesite novo geslo");
        if (self::checkValues($data)) {
            if($data["update_password"] != "off") {
                $hash = password_hash($data["geslo"], PASSWORD_DEFAULT);
                $data["geslo"] = $hash;
            }
            ProdajalecDB::update($data);
            if($data["id_prodajalec"] == $_SESSION["id"]) {
                $_SESSION["ime"] = $data["ime"];
                $_SESSION["priimek"] = $data["priimek"];
                $_SESSION["geslo"] = $data["geslo"];
            }
            if($_SESSION["id"] == 999) {
                echo ViewHelper::render("view/prodajalec-list.php", [
                "prodajalci" => ProdajalecDB::getAll()
                ]);
            } else {
                header('Location: edit?id_prodajalec=' .$_SESSION["id"] ."&error=Podatki posodobljeni");
            }
        } else {
            self::editForm($data);
        }
    }

    public static function delete() {
        $rules = [
            'id_prodajalec' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            ProdajalecDB::delete($data);
            $url = BASE_URL . "prodajalci";
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "prodajalci/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "prodajalci";
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
            'email' => FILTER_SANITIZE_SPECIAL_CHARS,
            'geslo' => FILTER_SANITIZE_SPECIAL_CHARS,
            'izbrisan' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}

