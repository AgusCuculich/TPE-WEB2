<?php

require_once './config.php';
require_once 'app/models/model.php';

class userModel extends Model {

    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE usuario = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}