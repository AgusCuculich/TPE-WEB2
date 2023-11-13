<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/user.model.php';

    class UserApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->model = new UserModel();
        }


        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

            if(empty($basic)) {
                $this->view->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }

            $userpass = base64_decode($basic[1]); // usr:pass
            $userpass = explode(":", $userpass); // ["usr", "pass"]

            $user = $userpass[0];
            $pass = $userpass[1];

            $userdata = $this->model->getByUsername($user);

            if($user && password_verify($pass, $userdata->contraseña)) {
                
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token);
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 401);
            }
        }
    }
