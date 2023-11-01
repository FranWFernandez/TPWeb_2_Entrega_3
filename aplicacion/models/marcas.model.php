<?php

require_once './aplicacion/models/model.php';

class MarcasModel extends DB {
    function getMarcasNames() {
        $query = $this->connect()->prepare('SELECT * FROM marcas');
        $query->execute();

        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }
    public function getMarcabyID ($id){
        $query= $this->connect()->prepare('SELECT * FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
        $Item = $query->fetch(PDO::FETCH_OBJ);
        return $Item;
    }
    function insertMarca($marca) {
        $query = $this->connect()->prepare('INSERT INTO marcas (marca) VALUES(?)');
        $query->execute([$marca]);
        return $this->connect()->lastInsertId();
    }
    function deleteMarca($id) {
        $query = $this->connect()->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
    }
    function updateMarca($id, $marca) {
        $query = $this->connect()->prepare('UPDATE marcas SET marca=? WHERE id_marca =?');
        $query->execute([$marca, $id]);
    } 
}