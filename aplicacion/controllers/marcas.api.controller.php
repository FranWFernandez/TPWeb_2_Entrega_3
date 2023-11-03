<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/marcas.model.php';
    require_once 'aplicacion/helpers/autenticar.api.helper.php';

    class MarcasApiController extends ApiController {
        private $model;
        private $autenticarHelper;
        function __construct() {
            parent::__construct();
            $this->model = new MarcasModel();
            $this->autenticarHelper = new AutenticarHelper();
        }
        public function getAllMarcas(){
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }


            $marcas = $this->model->getAllMarcas();
            $this->view->response($marcas,200);
        }
        public function getMarcasById($params=null){
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }


            $marca = $this->model->getMarcaByID($params[':ID']);
                if(!empty($marca)) {
                    if($params[':subrecurso']) {
                        switch ($params[':subrecurso']) {
                            case 'marca':
                                $this->view->response($marca->marca, 200);
                                break;
                        }
                    } else
                            $this->view->response($marca, 200);
                } else {
                        $this->view->response(
                            'La marca con el id='.$params[':ID'].' no existe.'
                            , 404);
                    }   
        }   
        function CrearMarca($params = null) {
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }


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
        function UpdateMarca($params = []) {
            $user = $this->autenticarHelper->UsuarioActual();
            if(!$user) {
                $this->view->response('Unauthorized', 401);
                return;
            }
            if($user->role!='ADMIN') {
                $this->view->response('Forbidden', 403);
                return;
            }

            
            $id = $params[':ID'];
            $marca = $this->model->getMarcaByID($id);

            if ($marca) {
                $body = $this->getData();
                $marca = $body->marca;

                $this->model->UpdateMarca($id,$marca);

                $this->view->response('La producto con id='.$id.' ha sido modificada.', 200);
            }else {
                $this->view->response('La producto con id='.$id.' no existe.', 404);
            }
        }
}