<?php

require_once './aplicacion/models/model.php';

class CategoriasModel extends DB {
    function getAllCategorias($params=null, $getParametro) {
        $consulta = 'SELECT * FROM categorias';

        if (!empty($getParametro)){
            switch ($getParametro) {

                //falta el case de order

                case isset($getParametro['Filtro']) :
                    $consulta .=' WHERE '.$getParametro['Filtro'];
                break;
            }
        }

        $query = $this->connect()->prepare($consulta);
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
    function getCategoriaById($id_categoria) {
        $query = $this->connect()->prepare('SELECT * FROM categorias where id_categoria=?');
        $query->execute([$id_categoria]);
        $itemCat = $query->fetch(PDO::FETCH_OBJ);
        return $itemCat;
    }
    function insertCategoria($categoria) {
        $query = $this->connect()->prepare('INSERT INTO `categorias` (`categoria`) VALUES(?)');
        $query->execute([$categoria]);
        return $this->connect()->lastInsertId();
    }
    function updateCategoria($id_categoria,$categoria) {
        $query = $this->connect()->prepare('UPDATE categorias SET categoria=? WHERE id_categoria=?');
        $query->execute([$categoria, $id_categoria]);
    }
}