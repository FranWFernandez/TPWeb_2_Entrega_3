<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/marcas.model.php';

    class MarcasApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new MarcasModel();
        }
}