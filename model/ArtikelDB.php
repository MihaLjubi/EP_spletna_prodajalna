<?php

require_once 'model/AbstractDB.php';

class ArtikelDB extends AbstractDB{
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO artikel (ime, cena) "
                        . " VALUES (:ime, :cena)", $params);
    }

    public static function update(array $params) {
        return parent::modify("update artikel set ime = :ime, cena = :cena WHERE id_artikel = :id_artikel", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM artikel WHERE id_artikel = :id_artikel", $id);
    }

    public static function get(array $id) {
        $artikli = parent::query("SELECT id_artikel, ime, cena"
                        . " FROM artikel"
                        . " WHERE id_artikel = :id_artikel", $id);
        
        if (count($artikli) == 1) {
            return $artikli[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id_artikel, ime, cena"
                        . " FROM artikel"
                        . " ORDER BY ime");
    }
}
