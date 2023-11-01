<?php
    require_once 'aplicacion/models/config.php';
    require_once 'libs/router.php';
    require_once 'aplicacion/controllers/productos.api.controller.php';

    $router = new Router();

    #                 endpoint          verbo     controller           método
    $router->addRoute('productos',     'GET',    'ProductosApiController', 'get'   );
    $router->addRoute('productos',     'POST',   'ProductosApiController', 'create');
    $router->addRoute('productos/:ID', 'GET',    'ProductosApiController', 'get'   );
    $router->addRoute('productos/:ID', 'PUT',    'ProductosApiController', 'update');
    $router->addRoute('productos/:ID', 'DELETE', 'ProductosApiController', 'delete');
    
    $router->addRoute('productos/:ID/:subrecurso', 'GET',    'ProductosApiController', 'get'   );
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);