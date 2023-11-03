<?php
    require_once 'aplicacion/models/config.php';
    require_once 'libs/router.php';
    require_once 'aplicacion/controllers/productos.api.controller.php';
    require_once 'aplicacion/controllers/categorias.api.controller.php';
    require_once 'aplicacion/controllers/marcas.api.controller.php';
    require_once 'aplicacion/controllers/usuario.api.controller.php';
    

    $router = new Router();

    //                 endpoint                       verbo     controller                 método
    $router->addRoute('productos',                    'GET',    'ProductosApiController',    'getAllProductos'    );
    $router->addRoute('productos',                    'POST',   'ProductosApiController',    'CrearProducto'      );
    $router->addRoute('productos/:ID',                'GET',    'ProductosApiController',    'getProductosById'   );
    $router->addRoute('productos/:ID',                'PUT',    'ProductosApiController',    'UpdateProducto'     );
    $router->addRoute('productos/:ID/:subrecurso',    'GET',    'ProductosApiController',    'getProductosById'   );

    $router->addRoute('categorias',                   'GET',    'CategoriasApiController',   'getAllCategorias'   );
    $router->addRoute('categorias',                   'POST',   'CategoriasApiController',   'CrearCategoria'     );
    $router->addRoute('categorias/:ID',               'GET',    'CategoriasApiController',   'getCategoriasById'  );
    $router->addRoute('categorias/:ID',               'PUT',    'CategoriasApiController',   'UpdateCategoria'    );
    $router->addRoute('categorias/:ID/:subrecurso',   'GET',    'CategoriasApiController',   'getCategoriasById'  );

    $router->addRoute('marcas',                       'GET',    'MarcasApiController',       'getAllMarcas'      );
    $router->addRoute('marcas',                       'POST',   'MarcasApiController',       'CrearMarca'        );
    $router->addRoute('marcas/:ID',                   'GET',    'MarcasApiController',       'getMarcasById'     );
    $router->addRoute('marcas/:ID',                   'PUT',    'MarcasApiController',       'UpdateMarca'       );
    $router->addRoute('marcas/:ID/:subrecurso',       'GET',    'MarcasApiController',       'getMarcasById'     );

    $router->addRoute('usuario/token',                'GET',    'UsuarioApiController', 'getToken'   );
    $router->addRoute('usuario/token',                'POST',   'UsuarioApiController', 'getToken'   );
    $router->addRoute('usuario/token/:ID',            'GET',    'UsuarioApiController', 'getToken'   );
    $router->addRoute('usuario/token',                'PUT',    'UsuarioApiController', 'getToken'   );
    $router->addRoute('usuario/token/:ID/:subrecurso','GET',    'UsuarioApiController', 'getToken'   );


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);