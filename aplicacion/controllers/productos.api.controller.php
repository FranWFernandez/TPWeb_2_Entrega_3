<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/productos.model.php';

    class ProductosApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new ProductosModel();
        }

        public function getAll(){                  
            $productos=$this->model->getAll();
            // var_dump($productos);
            $this->view->response($productos,200);
        } 

        public function getProductosById($params=null){
            $id=$params[':ID'];
            if (!empty($id)){
                $producto=$this->model->getItem($id);
                // var_dump($producto);
                $this->view->response($producto,200);
            } else {
            
                $this->view->response('no hay productos con el id='.$id,404);
            }
        }   
        function CrearProducto($params = null) {
            $body = $this->getData();

            $producto = $body->Producto;
            $precio = $body->Precio;
            $talle = $body->Talle;
            $id_categoria = $body->id_categoria;
            $id_marca = $body->id_marca;

            if (empty($producto) || empty($talle) || empty($talle) || empty($id_categoria) || empty($id_marca)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->insertProducto($producto, $precio, $talle, $id_categoria, $id_marca);
                $producto = $this->model->getItem($id);
                $this->view->response($producto, 201);
            }
    
        }
}