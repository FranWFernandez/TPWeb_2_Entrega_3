<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/categorias.model.php';

    class CategoriasApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new CategoriasModel();
        }
        public function getAllCategorias(){                  
            $categorias=$this->model->getAllCategorias();
            $this->view->response($categorias,200);
        } 
        public function getCategoriasById($params=null){
            $categoria = $this->model->getCategoriaByID($params[':ID']);
                if(!empty($categoria)) {
                    if($params[':subrecurso']) {
                        switch ($params[':subrecurso']) {
                            case 'categoria':
                                $this->view->response($categoria->categoria, 200);
                                break;
                        }
                    } else
                            $this->view->response($categoria, 200);
                } else {
                        $this->view->response(
                            'La categoria con el id='.$params[':ID'].' no existe.'
                            , 404);
                }   
        }    
        function CrearCategoria($params = null) {
            $categorias = $this->getData();
            $categoria = $categorias->categoria;

            if (empty($categoria)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->insertCategoria($categoria);
                $categoria = $this->model->getCategoriaByID($id);
                $this->view->response($categoria, 201);
            }
        }
        // function UpdateCategoria($params = []) {
        //     $id = $params[':ID'];
        // }

}