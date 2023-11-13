Integrantes:
    Francisco Wenceslao Fernandez y
    Valentino Malassisi

Endpoints
 
  GETS:
    
    GET user/token/
        El endpoint GET/user/token se utiliza para validar la autenticidad de un usuario mediante la presentación de un token. tiene una duración limitada, lo que significa que solo es válido durante un 
        período específico de tiempo.
      Detalles del Endpoint
        Método HTTP: GET
        Ruta: /user/token
        Parámetros de la Solicitud
        Este endpoint requiere que se incluya el token en la URL o en la cabecera de la solicitud.
      Respuestas Posibles
        Éxito (200 OK): Si el token es válido y aún está dentro de su período de vigencia, el servidor puede responder con un estado 200 OK, indicando que la validación fue exitosa.
        Error de Autenticación (401 Unauthorized): Si el token no es válido, expiró o no se proporcionó, el servidor puede devolver un estado 401 Unauthorized,indicando que la autenticación ha fallado.
      Ejemplo de Uso:
   
  GET /productos/ 
        
        Este endpoint permite acceder a la colección completa de productos.
      Ejemplo de Respuesta:
![image](https://github.com/FranWFernandez/TPWeb_2_Entrega_3/assets/145360524/6e7bd45f-94af-4349-9ad5-c96c506ce573)
    
  GET /productos/?Orden&Sort
        
        Este endpoint permite ordenar la colección de productos de manera ascendente o descendente según un campo específico.
      Parámetros de la Solicitud:
        Sort: Campo por el cual ordenar los productos (puede ser cualquier campo de la base de datos).
        Orden: Dirección de la ordenación (por defecto, es descendente). Puede ser asc para ascendente o desc para descendente.
      Valores por Defecto:
        Si no se proporciona el parámetro Sort o el campo no existe en la base de datos , se ordenará por defecto por el campo Precio.
        Si no se proporciona el parámetro Orden, la dirección de ordenación será por defecto descendente.
      Ejemplo de endpoint:
![image](https://github.com/FranWFernandez/TPWeb_2_Entrega_3/assets/145360524/3621b85b-91a5-4587-9b29-0eba63ae295b)
    
  GET /productos/?limit=&offset= :
        Se permite establecer un limite(limit) de productos que se mostrara depende la pagina(offset) elegida.
      Ejemplo de Uso:
    
  GET /productos/?Filtro=
        
        Este endpoint permite filtrar la colección de productos según una condición especificada.
      Parámetros de la Solicitud:
        Filtro:	Condición por la cual filtrar los productos. Puede ser cualquier campo de la base de datos.
      Ejemplo de Uso:
![image](https://github.com/FranWFernandez/TPWeb_2_Entrega_3/assets/145360524/99f413d3-ec90-4e51-9604-a84a93f2ef65)
    
  GET /productos/:ID
        
        Se permite acceder a un determinado producto dado por su ID.
      Respuestas Posibles
        Éxito (200 OK): si el producto con el id existe;
        (404 not found): el producto con el id no existe;
      Ejemplo de Respuesta:
![image](https://github.com/FranWFernandez/TPWeb_2_Entrega_3/assets/145360524/473ea4a2-0a82-4669-b338-fc561a5a1cfa)
    
    GET /marcas :
        Se permite acceder a la coleccion entera de marcas.
    GET /marcas/?Orden=&Sort
        Se permite ordenar las marcas de manera descendente o ascendente y por un campo en especifico.
    GET /marcas/?limit=&offset=
        Se permite establecer un limite(limit) de marcas que se mostrara depende la pagina(offset) elegida.
    GET /marcas/:ID
        Se permite acceder a una determinada marca dada por su ID.
    GET /categorias :
        Se permite acceder a la coleccion entera de categorias.
    GET /categorias/?Orden=&Sort
        Se permite ordenar las categorias de manera descendente o ascendente y por un campo en especifico.
    GET /categorias/?limit=&offset=
        Se permite establecer un limite(limit) de categorias que se mostrara depende la pagina(offset) elegida.
    GET /categorias/:ID
        Se permite acceder a una determinadac ategoria dada por su ID.

  POSTS:
    POST /productos
        
        Este endpoint permite agregar un nuevo producto. La acción se realiza mediante el cuerpo (BODY) de la solicitud POST. Es importante destacar que se requiere
        validación mediante token para realizar esta acción.
      Parámetros del Cuerpo (BODY):
        Se deben proporcionar los detalles del nuevo producto en el cuerpo de la solicitud en formato JSON.
      Ejemplo del cuerpo de la solicitud:
![image](https://github.com/FranWFernandez/TPWeb_2_Entrega_3/assets/145360524/325be362-c224-4775-8f78-33eea58c6467)
      
      Posibles Respuestas:
        Éxito (201 Created) : La solicitud de agregar el nuevo producto fue exitosa.El servidor responderá con un estado 201 Created y, posiblemente, con detalles
        adicionales sobre el producto recién creado.
        Error de Autenticación (401 Unauthorized): Si la validación del token falla,el servidor responderá con un estado 401 Unauthorized, indicando que la acción no está autorizada.
    
    POST /marcas:
        Se permite agregar una nueva marca. Esta accion se realiza mediante el BODY de POSTMAN.
    POST /categorias:
        Se permite agregar una nueva  categoria. Esta accion se realiza mediante el BODY de POSTMAN.

  PUTS:
    PUT /productos/:ID :
       
        Se permite actualizar un producto mediante su ID. Esta accion se realiza mediante el BODY de POSTMAN.
      Parámetros del Cuerpo (BODY):
        Se deben proporcionar los detalles del nuevo producto en el cuerpo de la solicitud en formato JSON.
      Ejemplo del cuerpo de la solicitud:
  ![image](https://github.com/FranWFernandez/TPWeb_2_Entrega_3/assets/145360524/cb2664f8-25f8-49e4-a0d9-74624bbe3ba4)
    
    PUT /marcas/:ID :
        Se permite actualizar una marca mediante su ID. Esta accion se realiza mediante 
        el BODY de POSTMAN.
    PUT /categorias/:ID :
        Se permite actualizar una categoria mediante su ID. Esta accion se realiza mediante 
        el BODY de POSTMAN.
