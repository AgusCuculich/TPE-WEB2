<?php
    require_once 'app/views/api.view.php';
    require_once 'app/helpers/auth.api.helper.php';
    
    abstract class ApiController {
        protected $view;
        private $data;
        protected $authHelper;
        
        function __construct() {
            $this->view = new ApiView();
            $this->data = file_get_contents('php://input');
            $this->authHelper = new AuthHelper();
        }

        function getData() {
            return json_decode($this->data);
        }
    }
