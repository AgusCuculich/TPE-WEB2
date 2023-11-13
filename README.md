# API RESTful

Comportamiento de cada endpoint:

- **[GET] `localhost/folder/api/user/token`**

Un usuario podrá ingresar sus credenciales (usuario y contraseña) que en caso de ser correctas, se generará un token que tendrá una duración de una hora hasta que se vuelva inválido.

Ingreso con privilegios: username -> webadmin, password -> admin

Ingreso sin privilegios: username -> queso, password -> queso

- **[GET] `localhost/folder/api/pc`**

Nos permite obtener toda la colección de la base de datos. A través del uso de Query Params podemos obtener un resultado modificado.

_**Uso de parámetros para paginar:**_

| Query Params  | Descripción                                                     |
|---------------|-----------------------------------------------------------------|
| page          | Página en la que nos queremos posicionar                        |
| resultsPerPage| Cantidad de resultados que queremos mostrar por página          |

Ejemplos

Nos posiciona en la tercer pagina en donde se mostraran hasta 4 elementos por página:

        localhost/folder/api/pc?page=3&resultsPerPage=4
    
Nos posiciona en la segunda pagina en donde se mostraran hasta 8 elementos por página:

        localhost/folder/api/pc?page=2&resultsPerPage=8

_**Uso de parámetros para filtrar los resultados:**_

| Query Params  | Descripción                                                     |
|---------------|-----------------------------------------------------------------|
| field         | Campo de la tabla por el que queremos filtrar                   |
| value         | Valor buscado dentro del campo especificado                     |

Ejemplos:

Nos devuelve aquellos elementos de la colección cuyo procesador sea un Ryzem 3 3200G:

        localhost/folder/api/pc?field=procesador&value=AMD_Ryzen_3_3200G

Nos devuelve aquellos elementos de la colección cuya tarjeta gráfica sea una NVIDIA GeForce GTX 1650 Super:

        localhost/folder/api/pc?field=grafica&value=NVIDIA_GeForce_GTX_1650_Super

_**Uso de parámetros para ordenar de manera ascendente o descandente la colección:**_

| Query Params  | Descripción                                                     |
|---------------|-----------------------------------------------------------------|
| sort          | Campo cuyos elementos deseamos que se muestren ordenados        |
| order         | Puede ser 'asc' (ascendente) o 'desc' (descendente)             |

Ejemplos:

Para enseñar los elementos de la colección ordenados de manera descendente por id:

        localhost/folder/api/pc?sort=id&order=desc

Para enseñar los elementos de la colección ordenados de manera ascendente por nombre:

        localhost/folder/api/pc?sort=nombre&order=asc

- **[GET] `localhost/folder/api/pc/:ID`**

Nos devuelve un elemento en base a su id.

| parámetro     | Descripción                                                     |
|---------------|-----------------------------------------------------------------|
| :ID           | id del elemento que deseamos mostrar                            |

Ejemplo:

Nos devuelve aquel elemento con id = 1

        localhost/folder/api/pc/1

- **[PUT] `localhost/folder/api/pc/:ID`**

Cumple con la función de actualizar/editar aquel elemento cuyo id especificamos.

| parámetro     | Descripción                                                     |
|---------------|-----------------------------------------------------------------|
| :ID           | id del elemento que deseamos actualizar/editar                  |

Ejemplo:

        localhost/folder/api/pc/9

- **[POST] `localhost/folder/api/pc`**

Cumple con la función de añadir un nuevo elemento a la base de datos. La información del nuevo elemento debe ser proporcionada a través del body de la solicitud en formato JSON.

```json
{
    "nombre": "ejemplo_nombre",
    "procesador": "ejemplo_procesador",
    "grafica": "ejemplo_grafica",
    "mother": "ejemplo_motherboard",
    "disco": "ejemplo_almacenamiento",
    "ram": "ejemplo_cant_ram",
    "imagen": "ejemplo_url_imagen",
    "id_categoria": "ejemplo_categoria",
}
```

Ejemplo:

```json
{
    "id_categoria": 1,
    "nombre": "Aqua Aurora",
    "procesador": "AMD RYZEN 9 5900X",
    "grafica": "Nvidia RTX 3060 12GB",
    "mother": "ASUS PRIME X570",
    "disco": "SDD 2TB",
    "ram": 32,
    "imagen": "https://res.cloudinary.com/jawa/image/upload/f_auto,ar_1:1,c_fill,w_3840,q_auto/production/listings/p3buijgwhvwiyp53k6ep",
}
```