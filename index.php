<?php
session_start();

require_once("controller/LoginController.php");
require_once("controller/ArtikelController.php");
require_once("controller/ProdajalecController.php");
require_once("controller/StrankaController.php");
require_once("controller/NarociloController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "register" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            LoginController::register();
        } else {
            LoginController::registerForm();
        }
    },
    "login" => function () {
        LoginController::index();
    },
    "logout" => function () {
        LoginController::logout();
    },
    "artikli" => function () {
        ArtikelController::index();
    },
    "artikli/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArtikelController::add();
        } else {
            ArtikelController::addForm();
        }
    },
    "artikli/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArtikelController::edit();
        } else {
            ArtikelController::editForm();
        }
    },
    "artikli/delete" => function () {
        ArtikelController::delete();
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "artikli");
    },
    "prodajalci" => function () {
        ProdajalecController::index();
    },
    "prodajalci/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ProdajalecController::add();
        } else {
            ProdajalecController::addForm();
        }
    },
    "prodajalci/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ProdajalecController::edit();
        } else {
            ProdajalecController::editForm();
        }
    },
    "prodajalci/delete" => function () {
        ProdajalecController::delete();
    },
    "stranke" => function () {
        StrankaController::index();
    },
    "stranke/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            StrankaController::add();
        } else {
            StrankaController::addForm();
        }
    },
    "stranke/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            StrankaController::edit();
        } else {
            StrankaController::editForm();
        }
    },
    "stranke/delete" => function () {
        StrankaController::delete();
    },
    "narocilo/pregled" => function () {
        NarociloController::pregled();
    },
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (InvalidArgumentException $e) {
    ViewHelper::error404();
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
} 