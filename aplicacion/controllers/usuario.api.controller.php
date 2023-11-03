<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/usuario.model.php';
    require_once 'aplicacion/helpers/autenticar.api.helper.php';

    class UsuarioApiController extends ApiController {
        private $model;
        private $autenticarHelper;

        function __construct() {
            parent::__construct();
            $this->autenticarHelper = new AutenticarHelper();
            $this->model = new UsuarioModel();
        }

        function getToken($params = []) {
            $basic = $this->autenticarHelper->getAutenticarHeaders();

            if(empty($basic)) {
                $this->view->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic); 

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }

            $usuariopassword = base64_decode($basic[1]); 
            $usuariopassword = explode(":", $usuariopassword); 

            $email = $usuariopassword[0];
            $password = $usuariopassword[1];

            $usuariodata = [ "email" => $email, "id" => 1, "role" => 'ADMIN' ]; // Llamar a la DB

        
            
            if($email == "webadmin@gmail.com" && $password == "admin") {
                // Usuario es válido
                
                $token = $this->autenticarHelper->crearToken($usuariodata);
                $this->view->response($token);
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 401);
            }
        }
    }