<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/marcas.model.php';

    class MarcasApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new MarcasModel();
        }
        public function getMarcasById($params=null){
            $id=$params[':ID'];
            if (!empty($id)){
                $marca=$this->model->getMarcaById($id);
                $this->view->response($marca,200);
            } else {
            
                $this->view->response('no hay marcas con el id='.$id,404);
            }
        }  
        function CrearMarca($params = null) {
            $marcas = $this->getData();
            $marcaName = $marcas->marca;

            if (empty($marcaName)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->insertMarca($marcaName);
                $marca = $this->model->getMarcaByID($id);
                $this->view->response($marca, 201);
            }
        }
}