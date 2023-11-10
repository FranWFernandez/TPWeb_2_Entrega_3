<?php

require_once './aplicacion/models/model.php';

class MarcasModel extends DB {
    function getAllMarcas($getParametro) {
        $consulta = 'SELECT * FROM marcas';
        
        if (!empty($getParametro['Filtro'])){
            $consulta .=' WHERE '.$getParametro['Filtro'];   
        }
        if (!empty($getParametro['VariableOrden'])){
            $consulta .=' ORDER BY '.$getParametro['VariableOrden'];
            if (!empty($getParametro['Orden'])) {
                $consulta .= ' '.$getParametro['Orden'];
            }
        }

        $query = $this->connect()->prepare($consulta);
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    public function getMarcaByID ($id){
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
    function updateMarca($id, $marca) {
        $query = $this->connect()->prepare('UPDATE marcas SET marca=? WHERE id_marca =?');
        $query->execute([$marca, $id]);
    } 
}