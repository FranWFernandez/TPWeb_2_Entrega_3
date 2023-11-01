<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/categorias.model.php';

    class CategoriasApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new CategoriasModel();
        }
}