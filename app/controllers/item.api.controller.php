<?php

require_once 'app/models/item.model.php';
require_once 'app/views/api.view.php';

class itemApiController {

    private $model;
    private $view;
    private $data;


    function __construct() {
        $this->view = new apiView();
        $this->model = new itemModel();
        $this->data = file_get_contents('php://input');
        
    }


    public function getData() {
        return json_decode($this->data);
    }


    function get($params = []) {

        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $sort = $_GET['sort'];
            $order = $_GET['order'];

            $allowedColumns = ['id', 'id_categoria', 'nombre'];
            $allowedOrders = ['asc', 'desc'];

            if (in_array($sort, $allowedColumns) && in_array($order, $allowedOrders)) {
                $items = $this->model->getByOrder($sort, $order);
                $this->view->response($items, 200);
            } else {
                $this->view->response("Valores inválidos", 400);
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
        $id = $params[':ID'];
        $item = $this->model->getItem($id);

        if ($item) {
            $body = $this->getData();

            $name = isset($body->nombre) ? $body->nombre : $item->nombre;
            $cpu = isset($body->procesador) ? $body->procesador : $item->procesador;
            $gpu = isset($body->grafica) ? $body->grafica : $item->grafica;
            $motherboard = isset($body->mother) ? $body->mother : $item->mother;
            $storage = isset($body->disco) ? $body->disco : $item->disco;
            $ram = isset($body->ram) ? $body->ram : $item->ram;
            $image = isset($body->imagen) ? $body->imagen : $item->imagen;
            $category = isset($body->id_categoria) ? $body->id_categoria : $item->id_categoria;
            
            $this->model->updateItem($id, $name, $cpu, $gpu, $motherboard, $storage, $ram, $category, $image);
            $this->view->response('El item con id = '.$params[':ID'].' fue actualizado.', 200);

        } else {
            $this->view->response('El item con id = '.$params[':ID'].' no existe.', 404);
        }
    }


    public function create() {
        $body = $this->getData();


        $name = isset($body->nombre) ? $body->nombre : null;
        $cpu = isset($body->procesador) ? $body->procesador : null;
        $gpu = isset($body->grafica) ? $body->grafica : null;
        $motherboard = isset($body->mother) ? $body->mother : null;
        $storage = isset($body->disco) ? $body->disco : null;
        $ram = isset($body->ram) ? $body->ram : null;
        $image = isset($body->imagen) ? $body->imagen : null;
        $category = isset($body->id_categoria) ? $body->id_categoria : null;

        if (empty($name) || empty($cpu) || empty($gpu) || empty($motherboard) || empty($storage) || empty($ram) || empty($image) || empty($category)) {
            $this->view->response("Complete todos los datos", 400);
            return;
        }

        $this->model->newItem($name, $cpu, $gpu, $motherboard, $storage, $ram, $category, $image);
        $id = $this->model->getLastId();
        $item = $this->model->getItem($id);
        $this->view->response($item, 201);
    }
}