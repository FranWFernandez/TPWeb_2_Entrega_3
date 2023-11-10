<?php

require_once './aplicacion/models/model.php';

class ProductosModel extends DB {

    function getAllProductos($getParametro) {
        $consulta= 'SELECT productos.*, marcas.marca , categorias.categoria FROM productos INNER JOIN marcas ON productos.id_marca = marcas.id_marca INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria';     

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



    public function getItem ($id){
        $query= $this->connect()->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $Item = $query->fetch(PDO::FETCH_OBJ);
        return $Item;
    }
    function insertProducto($producto, $precio, $talle, $id_categorias, $id_marcas) {
        $query = $this->connect()->prepare('INSERT INTO `productos` (`Producto`, `Precio`, `Talle`, `id_categoria`, `id_marca`) VALUES(?,?,?,?,?)');
        $query->execute([$producto, $precio, $talle, $id_categorias, $id_marcas]);
        return $this->connect()->lastInsertId();
    }
    function updateProducto($id,$producto, $precio, $talle, $id_categorias, $id_marcas) {
        $query = $this->connect()->prepare('UPDATE productos SET Producto=?, Precio=?, Talle=?, id_categoria=?, id_marca=? WHERE id_producto=?');
        $query->execute([$producto, $precio, $talle, $id_categorias, $id_marcas, $id]);
    } 
}