<?php
    require_once 'aplicacion/views/api.view.php';
    
    abstract class ApiController {
        public $view;
        public $data;
        
        function __construct() {
            $this->view = new ApiView();
            $this->data = file_get_contents('php://input');
        }

        function getData() {
            return json_decode($this->data);
        }
    }