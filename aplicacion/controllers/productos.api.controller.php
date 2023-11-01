<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/productos.model.php';

    class ProductosApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new ProductosModel();
            

        }
        public function getProductosById($params=null){
            $id=$params[':ID'];
            if (!empty($id)){
                $producto=$this->model->getItem($id);
                $this->view->response($producto,200);
            } else {
            
                $this->view->response('no hay productos con el id='.$id,404);
            }
    }
}