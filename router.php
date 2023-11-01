<?php
    require_once 'aplicacion/models/config.php';
    require_once 'libs/router.php';
    require_once 'aplicacion/controllers/task.api.controller.php';

    $router = new Router();

    #                 endpoint          verbo     controller           método
    $router->addRoute('productos',     'GET',    'TaskApiController', 'get'   );
    $router->addRoute('productos',     'POST',   'TaskApiController', 'create');
    $router->addRoute('productos/:ID', 'GET',    'TaskApiController', 'get'   );
    $router->addRoute('productos/:ID', 'PUT',    'TaskApiController', 'update');
    $router->addRoute('productos/:ID', 'DELETE', 'TaskApiController', 'delete');
    
    $router->addRoute('productos/:ID/:subrecurso', 'GET',    'TaskApiController', 'get'   );
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);