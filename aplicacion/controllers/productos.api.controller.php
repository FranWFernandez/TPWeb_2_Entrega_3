<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/productos.model.php';
    require_once 'aplicacion/helpers/autenticar.api.helper.php';

    class ProductosApiController extends ApiController {
        private $model;
        private $autenticarHelper;
        function __construct() {
            parent::__construct();
            $this->model = new ProductosModel();
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
            if(isset($_GET['VariableOrden'])){
                $variableorden=$_GET['VariableOrden'];
                return $variableorden;
            }
        }


        public function getAllProductos($params = null){     
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
                $getParametro['VariableOrden'] = $variableorden;
            }

            $productos=$this->model->getAllProductos($getParametro);

            if($productos) {
                $this->view->response($productos,200);
            } else {
                $this->view->response("no existe", 404);
            }
        } 
        public function getProductosById($params=null){
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


            $producto = $this->model->getItem($params[':ID']);
                if(!empty($producto)) {
                    if($params[':subrecurso']) {
                        switch ($params[':subrecurso']) {
                            case 'Producto':
                                $this->view->response($producto->Producto, 200);
                                break;
                            case 'Precio':
                                $this->view->response($producto->Precio, 200);
                                break;
                            case 'Talle':
                                $this->view->response($producto->Talle, 200);
                                break;
                            case 'id_categoria':
                                $this->view->response($producto->id_categoria, 200);
                                break;   
                            case 'id_marca':
                                $this->view->response($producto->id_marca, 200);
                                break;
                            default:
                            $this->view->response(
                                'El producto no contiene '.$params[':subrecurso'].'.'
                                , 404);
                                break;
                        }
                    } else
                        $this->view->response($producto, 200);
                } else {
                    $this->view->response(
                        'La producto con el id='.$params[':ID'].' no existe.'
                        , 404);
                }
        }   
        function CrearProducto($params = null) {
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
        function UpdateProducto($params = []){
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
            $producto = $this->model->getItem($id);

            if ($producto) {
                $body = $this->getData();
                $producto = $body->Producto;
                $precio = $body->Precio;
                $talle = $body->Talle;
                $id_categorias = $body->id_categoria;
                $id_marcas = $body->id_marca;
                $this->model->updateProducto($id,$producto, $precio, $talle, $id_categorias, $id_marcas);

                $this->view->response('La producto con id='.$id.' ha sido modificada.', 200);
            } else {
                $this->view->response('La producto con id='.$id.' no existe.', 404);
            }
        }
    }