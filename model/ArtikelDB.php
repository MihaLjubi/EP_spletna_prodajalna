<?php

require_once 'model/AbstractDB.php';

class ArtikelDB extends AbstractDB{
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO artikel (ime, cena, opis, izbrisan) "
                        . " VALUES (:ime, :cena, :opis, :izbrisan)", $params);
    }

    public static function update(array $params) {
        return parent::modify("update artikel set ime = :ime, cena = :cena, opis = :opis, izbrisan = :izbrisan WHERE id_artikel = :id_artikel", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM artikel WHERE id_artikel = :id_artikel", $id);
    }

    public static function get(array $id) {
        $artikli = parent::query("SELECT id_artikel, ime, cena, opis, izbrisan"
                        . " FROM artikel"
                        . " WHERE id_artikel = :id_artikel", $id);
        if (count($artikli) == 1) {
            return $artikli[0];
        } else {
            throw new InvalidArgumentException("Artikel ne obstaja");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id_artikel, ime, cena, izbrisan"
                        . " FROM artikel"
                        . " ORDER BY ime");
    }
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id_artikel, ime, cena, izbrisan, "
                        . "          CONCAT(:prefix, id_artikel) as uri "
                        . "FROM artikel "
                        . "ORDER BY ime", $prefix);
    }
}
