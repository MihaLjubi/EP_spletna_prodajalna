<?php

require_once 'model/AbstractDB.php';

class NarociloDB extends AbstractDB{
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO narocilo (id_stranka, cena, datum, status) "
                        . " VALUES (:id_stranka, :cena, :datum, :status)", $params);
    }

    public static function update(array $params) {
        return parent::modify("update narocilo set status = :status WHERE id_narocilo = :id_narocilo", $params);
    }

    // get not needed???
    public static function get(array $id) {
        $narocila = parent::query("SELECT id_narocilo, ime, cena, izbrisan"
                        . " FROM narocilo"
                        . " WHERE id_narocilo = :id_narocilo", $id);
        
        if (count($narocila) == 1) {
            return $narocila[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }
    
    public static function delete(array $id) {
        
    }

    public static function getAll() {
        return parent::query("SELECT id_narocilo, id_stranka, cena, datum, status"
                        . " FROM narocilo"
                        . " ORDER BY id_narocilo DESC");
    }
}
