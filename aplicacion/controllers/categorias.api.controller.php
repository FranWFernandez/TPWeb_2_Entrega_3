<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/categorias.model.php';
    require_once 'aplicacion/helpers/autenticar.api.helper.php';

    class CategoriasApiController extends ApiController {
        private $model;
        private $autenticarHelper;

        function __construct() {
            parent::__construct();
            $this->model = new CategoriasModel();
            $this->autenticarHelper = new AutenticarHelper();
        }

        public function setOrden(){
            //para hacer el orden
            if(isset($_GET['Orden'])){
                $Orden=$_GET['Orden'];
                return $Orden;
            }
    
        }
        public function setFiltro(){
            if(isset($_GET['Filtro'])){
                $campo=$_GET['Filtro'];
                return $campo;
            }
        }
        public function variableOrden(){
            if(isset($_GET['Sort'])){
                $variableorden=$_GET['Sort'];
                return $variableorden;
            }
        }


        public function getAllCategorias($params=null){        
            /*
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }
            */
            $getParametro=[];
            $filtro=$this->setFiltro();
            $order = $this->setOrden();
            $variableorden = $this->variableOrden();

            if(!empty($filtro)) {
                $getParametro['Filtro'] = $filtro;
            }
            if(!empty($order)) {
                $getParametro['Orden'] = $order;
            }
            if(!empty($variableorden)) {
                $getParametro['Sort'] = $variableorden;
            }
            
            $categorias=$this->model->getAllCategorias($getParametro);

            if($categorias) {
                $this->view->response($categorias,200);
            } else {
                $this->view->response("no existe", 404);
            }
        } 
        public function getCategoriasById($params=null){
            /*
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }
            */


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
            /*
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }
            */


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
        function UpdateCategoria($params = []) {
            /*
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }
            */



            $id = $params[':ID'];
            $categoria = $this->model->getCategoriaByID($id);

            if ($categoria) {
                $body = $this->getData();
                $categoria = $body->categoria;

                $this->model->updateCategoria($id,$categoria);

                $this->view->response('La producto con id='.$id.' ha sido modificada.', 200);
            }else {
                $this->view->response('La producto con id='.$id.' no existe.', 404);
            }
        }

}