<?php

require_once './config.php';
require_once 'app/models/model.php';

class itemModel extends Model{

    function __construct() {
        parent::__construct();
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }


    public function getItem($id) {
        $query = $this->db->prepare('SELECT * FROM pc INNER JOIN categoria ON pc.id_categoria = categoria.id_categoria WHERE id = ?');
        $query->execute([$id]);
        $item = $query->fetch(PDO::FETCH_OBJ);
        return $item;
    }


    public function getItems() {
        $query = $this->db->prepare('SELECT * FROM pc INNER JOIN categoria ON pc.id_categoria = categoria.id_categoria');
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }


    public function deleteItem($id) {
        $query = $this->db->prepare('DELETE FROM pc WHERE id = ?');
        $query->execute([$id]);
    
    }


    public function updateItem($id, $name, $cpu, $gpu, $motherboard, $storage, $ram, $category, $image, $price) {    
        $query = $this->db->prepare('UPDATE pc SET 
        id_categoria = ?,
        nombre = ?,
        procesador = ?,
        grafica = ?,
        mother = ?,
        disco = ?,
        ram = ?,
        imagen = ?,
        precio = ?
        WHERE id = ?');
        $query->execute([$category, $name, $cpu, $gpu, $motherboard, $storage, $ram, $image, $price, $id]);
    }


    public function newItem($name, $cpu, $gpu, $motherboard, $storage, $ram, $category, $image, $price) {
        $query = $this->db->prepare('INSERT INTO pc 
        (id, id_categoria, nombre, procesador, grafica, mother, disco, ram, imagen, precio)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        $id = $this->db->lastInsertId();

        $query->execute([$id, $category, $name, $cpu, $gpu, $motherboard, $storage, $ram, $image, $price]);
    }


    public function getByOrder($sort, $order) {
        $query = $this->db->prepare("SELECT * FROM pc ORDER BY $sort $order");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function getLastId() {
        return $this->db->lastInsertId();
    }

    public function paginar($results, $skip) {
        $query = $this->db->prepare("SELECT * FROM pc LIMIT :limit OFFSET :offset");
        $query->bindValue(':limit', $results, PDO::PARAM_INT);
        $query->bindValue(':offset', $skip, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function getByFieldValue($field, $value) {
        $query = $this->db->prepare("SELECT * FROM pc WHERE $field = :value");
        $query->bindValue(':value', $value, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}