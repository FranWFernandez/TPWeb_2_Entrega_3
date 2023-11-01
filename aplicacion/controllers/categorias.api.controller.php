<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/categorias.model.php';

    class CategoriasApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new CategoriasModel();
        }
        public function getCategoriasById($params=null){
            $id=$params[':ID'];
            if (!empty($id)){
                $categoria=$this->model->getCategoriaById($id);
                $this->view->response($categoria,200);
            } else {
            
                $this->view->response('no hay categorias con el id='.$id,404);
            }
        }  
}