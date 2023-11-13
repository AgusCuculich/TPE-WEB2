<?php

require_once 'app/models/item.model.php';
require_once 'app/controllers/api.controller.php';

class itemApiController extends ApiController {
    private $model;
    private $functionsHelper;


    function __construct() {
        parent::__construct();
        $this->model = new itemModel();
    }


    function get($params = []) {

        if (isset($_GET['field']) && isset($_GET['value'])) {

            $field = $_GET['field'];
            $value = $_GET['value'];

            //utilizamos la siguiente funcion para convertir los guiones bajos del parámetro GET a espacios en blanco
            $value = str_replace("_", " ", $value);

            $allowedColumns = ['id', 'id_categoria', 'nombre', 'procesador', 'grafica', 'mother', 'disco', 'ram', 'imagen', 'precio'];

            //corroboramos que el campo ingresado sea el nombre de una de las columnas de la tabla
            if (in_array($field, $allowedColumns)) {
                $items = $this->model->getByFieldValue($field, $value);

                //corroboramos que se devuelvan elementos en el array de obj (de los que dependera la vista que se muestre)
                if (!empty($items)) {
                    $this->view->response($items, 200);
                } else {
                    $this->view->response("No hay elementos que coincidan con su búsqueda", 404);
                }
        
            } else {
                $this->view->response("Valores inválidos", 400);
            }
            return;
        }



        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $sort = $_GET['sort'];
            $order = $_GET['order'];

            $allowedColumns = ['id', 'id_categoria', 'nombre', 'procesador', 'grafica', 'mother', 'disco', 'ram', 'imagen', 'precio'];
            $allowedOrders = ['asc', 'desc'];

            //corroboramos que el campo ingresado sea el nombre de una de las columnas de la tabla.
            if (in_array($sort, $allowedColumns) && in_array($order, $allowedOrders)) {
                $items = $this->model->getByOrder($sort, $order);
                //No corroboramos si $items puede volver vacio ya que no puede haber un campo que no contenga valores y que por ende no se pueda ordenar y haya que avisar al usuario.
                $this->view->response($items, 200);
            } else {
                $this->view->response("Valores inválidos", 400);
            }
            return;
        }




        if (isset($_GET['page']) && isset($_GET['resultsPerPage'])) {
            $page = $_GET['page'];
            $resultsPerPage = $_GET['resultsPerPage'];

            //este if es para verificar que hayan ingresado un valor numerico y el mismo no tenga punto
            if ((is_numeric($page) && strpos($page, '.') === false) && (is_numeric($resultsPerPage) && strpos($resultsPerPage, '.') === false)) {
                $skip = ($page - 1) * $resultsPerPage;
                $items = $this->model->paginar($resultsPerPage, $skip);

                if (!empty($items)) {
                    $this->view->response($items, 200);
                } else {
                    $this->view->response("No hay más elementos que mostrar", 404);
                }
            
            } else {
                $this->view->response("El valor ingresado es inválido", 400);
            }
            return;
        }


        if (empty($params)) {
            $items = $this->model->getItems();
            $this->view->response($items, 200);
        } else {
            $item = $this->model->getItem($params[':ID']);
            if (!empty($item)) {
                $this->view->response($item, 200);
            } else {
                $this->view->response('La tarea con el id = '.$params[':ID'].' no existe.', 404);
            }
        }
    }


    public function update($params = []) {

        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->rol!='admin') {
            $this->view->response('Forbidden', 403);
            return;
        }


        $id = $params[':ID'];
        $item = $this->model->getItem($id);

        if ($item) {
            $body = $this->getData();

            if (empty($body)) {
                $this->view->response('Ingrese por lo menos un campo que actualizar', 400);
                return;
            }

            $name = isset($body->nombre) ? $body->nombre : $item->nombre;

            $cpu = isset($body->procesador) ? $body->procesador : $item->procesador;

            $gpu = isset($body->grafica) ? $body->grafica : $item->grafica;

            $motherboard = isset($body->mother) ? $body->mother : $item->mother;

            $storage = isset($body->disco) ? $body->disco : $item->disco;

            $ram = isset($body->ram) ? $body->ram : $item->ram;

            $image = isset($body->imagen) ? $body->imagen : $item->imagen;

            $category = isset($body->id_categoria) ? $body->id_categoria : $item->id_categoria;
            
            $price = isset($body->precio) ? $body->precio : $item->precio;
            
            $this->model->updateItem($id, $name, $cpu, $gpu, $motherboard, $storage, $ram, $category, $image, $price);
            $item = $this->model->getItem($id);
            $this->view->response('El item con id = '.$params[':ID'].' fue actualizado.', 200);
            $this->view->response($item, 200);

        } else {
            $this->view->response('El item con id = '.$params[':ID'].' no existe.', 404);
        }
    }


    public function create() {

        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->rol!='admin') {
            $this->view->response('Forbidden', 403);
            return;
        }

        $body = $this->getData();

        $name = isset($body->nombre) ? $body->nombre : null;
        $cpu = isset($body->procesador) ? $body->procesador : null;
        $gpu = isset($body->grafica) ? $body->grafica : null;
        $motherboard = isset($body->mother) ? $body->mother : null;
        $storage = isset($body->disco) ? $body->disco : null;
        $ram = isset($body->ram) ? $body->ram : null;
        $image = isset($body->imagen) ? $body->imagen : null;
        $category = isset($body->id_categoria) ? $body->id_categoria : null;
        $price = isset($body->precio) ? $body->precio : null;

        if (empty($name) || empty($cpu) || empty($gpu) || empty($motherboard) || empty($storage) || empty($ram) || empty($image) || empty($category) || empty($price)) {
            $this->view->response("Complete todos los datos", 400);
            return;
        }

        $this->model->newItem($name, $cpu, $gpu, $motherboard, $storage, $ram, $category, $image, $price);
        $id = $this->model->getLastId();
        $item = $this->model->getItem($id);
        $this->view->response($item, 201);
    }


}