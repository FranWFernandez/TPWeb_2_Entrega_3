<?php
    require_once 'aplicacion/models/config.php';
    require_once 'libs/router.php';
    require_once 'aplicacion/controllers/productos.api.controller.php';

    $router = new Router();

    //                 endpoint           verbo     controller                método
    $router->addRoute('productos',      'GET',    'ProductosApiController', 'getAll'   );
    $router->addRoute('productos',      'POST',   'ProductosApiController', 'CrearProducto');
    $router->addRoute('productos/:ID',  'GET',    'ProductosApiController', 'getProductosById');
    $router->addRoute('productos/:ID',  'PUT',    'ProductosApiController', 'update');

    // $router->addRoute('categorias',     'GET',    'CategoriasApiController', 'get'   );
    // $router->addRoute('categorias',     'POST',   'CategoriasApiController', 'CrearCategoria');
    // $router->addRoute('categorias/:ID', 'GET',    'CategoriasApiController', 'getCategoriasById'   );
    // $router->addRoute('categorias/:ID', 'PUT',    'CategoriasApiController', 'update');

    // $router->addRoute('marcas',         'GET',    'MarcasApiController', 'get'   );
    // $router->addRoute('marcas',         'POST',   'MarcasApiController', 'CrearMarca');
    // $router->addRoute('marcas/:ID',     'GET',    'MarcasApiController', 'getMarcasById'   );
    // $router->addRoute('marcas/:ID',     'PUT',    'MarcasApiController', 'update');

    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);