<?php

require_once 'model/AbstractDB.php';

class ProdajalecDB extends AbstractDB{
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO prodajalec (ime, priimek, email, geslo, izbrisan) "
                        . " VALUES (:ime, :priimek, :email, :geslo, :izbrisan)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE prodajalec SET ime = :ime, priimek = :priimek, email = :email, geslo = :geslo, izbrisan = :izbrisan WHERE id_prodajalec = :id_prodajalec", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM prodajalec WHERE id_prodajalec = :id_prodajalec", $id);
    }

    public static function get(array $id) {
        $prodajalci = parent::query("SELECT id_prodajalec, ime, priimek, email, geslo, izbrisan"
                        . " FROM prodajalec"
                        . " WHERE id_prodajalec = :id_prodajalec", $id);
        
        if (count($prodajalci) == 1) {
            return $prodajalci[0];
        } else {
            throw new InvalidArgumentException("Prodajalec ne obstaja");
        }
    }
    
    public static function getAll() {
        return parent::query("SELECT id_prodajalec, ime, priimek, email, geslo, izbrisan"
                        . " FROM prodajalec"
                        . " ORDER BY id_prodajalec");
    }
}
