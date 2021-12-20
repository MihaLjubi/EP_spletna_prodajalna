<?php

require_once("model/ArtikelDB.php");
require_once("controller/ArtikelController.php");
require_once("ViewHelper.php");

class ArtikelRESTController {

    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(ArtikelDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(ArtikelDB::getAllwithURI(["prefix" => $prefix]));
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, ArtikelController::getRules());

        if (ArtikelController::checkValues($data)) {
            $id = ArtikelDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/artikli/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, ArtikelController::getRules());

        if (ArtikelController::checkValues($data)) {
            $data["id"] = $id;
            ArtikelDB::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function delete($id) {
        // TODO: Implementiraj delete
        // Vrni kodo 204 v primeru uspeha oz. kodo 404, če knjiga ne obstaja
        try {
            $artikel = ArtikelDB::get(["id" => $id]);
            ArtikelDB::delete(["id" => $id]);
            echo ViewHelper::renderJSON("", 204);
        } catch (Exception $exc) {
            echo ViewHelper::renderJSON("No such artikel", 404);
        }
        // https://www.restapitutorial.com/httpstatuscodes.html
    }
    
}
