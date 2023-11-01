<?php
    require_once 'aplicacion/controllers/api.controller.php';
    require_once 'aplicacion/models/productos.model.php';

    class ProductosApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new ProductosModel();
        }
}