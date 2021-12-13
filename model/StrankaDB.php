<?php

require_once 'model/AbstractDB.php';

class StrankaDB extends AbstractDB{
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO stranka (ime, priimek, ulica, hisna_stevilka, postna_stevilka, posta, email, geslo, izbrisan) "
                        . " VALUES (:ime, :priimek, :ulica, :hisna_stevilka, :postna_stevilka, :posta, :email, :geslo, :izbrisan)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE stranka SET ime = :ime, priimek = :priimek, ulica = :ulica, hisna_stevilka = :hisna_stevilka, postna_stevilka = :postna_stevilka, posta = :posta, email = :email, geslo = :geslo, izbrisan = :izbrisan WHERE id_stranka = :id_stranka", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM stranka WHERE id_stranka = :id_stranka", $id);
    }

    public static function get(array $id) {
        $stranke = parent::query("SELECT id_stranka, ime, priimek, ulica, hisna_stevilka, postna_stevilka, posta, email, geslo, izbrisan"
                        . " FROM stranka"
                        . " WHERE id_stranka = :id_stranka", $id);
        
        if (count($stranke) == 1) {
            return $stranke[0];
        } else {
            throw new InvalidArgumentException("stranka ne obstaja");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id_stranka, ime, priimek, ulica, hisna_stevilka, postna_stevilka, posta, email, geslo, izbrisan"
                        . " FROM stranka"
                        . " ORDER BY id_stranka");
    }
}
