<?php
session_start();

require_once("controller/LoginController.php");
require_once("controller/ArtikelController.php");
require_once("controller/ProdajalecController.php");
require_once("controller/StrankaController.php");
require_once("controller/NarociloController.php");
require_once("controller/ArtikelRESTController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
var_dump(BASE_URL);
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/^register$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            LoginController::register();
        } else {
            LoginController::registerForm();
        }
    },
    "/^verify-email$/" => function () {
        LoginController::verify_email();
    },   
    "/^login$/" => function () {
        LoginController::index();
    },
    "/^logout$/" => function () {
        LoginController::logout();
    },
    "/^artikli$/" => function () {
        ArtikelController::index();
    },
    "/^artikli\/add$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArtikelController::add($id);
        } else {
            ArtikelController::addForm($id);
        }
    },
    "/^artikli\/edit\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ArtikelController::edit();
        } else {
            ArtikelController::editForm();
        }
    },
    "/^artikli\/delete\/(\d+)$/" => function () {
        ArtikelController::delete();
    },
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "artikli");
    },
    "/^prodajalci$/" => function () {
        ProdajalecController::index();
    },
    "/^prodajalci\/add$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ProdajalecController::add();
        } else {
            ProdajalecController::addForm();
        }
    },
    "/^prodajalci\/edit\/(\d+)$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ProdajalecController::edit();
        } else {
            ProdajalecController::editForm();
        }
    },
    "/^prodajalci\/delete\/(\d+)$/" => function () {
        ProdajalecController::delete();
    },
    "/^stranke$/" => function () {
        StrankaController::index();
    },
    "/^stranke\/add$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            StrankaController::add();
        } else {
            StrankaController::addForm();
        }
    },
    "/^stranke\/edit\/(\d+)$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            StrankaController::edit();
        } else {
            StrankaController::editForm();
        }
    },
    "/^stranke\/delete\/(\d+)$/" => function () {
        StrankaController::delete();
    },
    "/^narocila$/" => function () {
        NarociloController::index();
    },
    "/^narocila\/pregled$/" => function () {
        NarociloController::pregled();
    },
    "/^narocila\/add$/" => function () {
        NarociloController::add();
    },
    "/^narocila\/edit\/(\d+)$/" => function () {
        NarociloController::edit();
    },
            
    # REST API
    "/^api\/artikli\/(\d+)$/" => function ($method, $id) {
        switch ($method) {
            case "PUT":
                ArtikelRESTController::edit($id);
                break;
            case "DELETE":
                ArtikelRESTController::delete($id);
            default: # GET
                ArtikelRESTController::get($id);
                break;
        }
    },
    "/^api\/artikli$/" => function ($method) {
        switch ($method) {
            case "POST":
                ArtikelRESTController::add();
                break;
            default: # GET
                ArtikelRESTController::index();
                break;
        }
    },
];
    
foreach ($urls as $pattern => $controller) {
        if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);