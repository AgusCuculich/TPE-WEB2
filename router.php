<?php

require_once './config.php';
require_once './libs/router.php';
require_once 'app/controllers/item.api.controller.php';
require_once 'app/controllers/user.api.controller.php';

$router = new Router();

$router->addRoute('pc',         'GET',      'itemApiController',        'get');
$router->addRoute('pc/:ID',     'GET',      'itemApiController',        'get');
$router->addRoute('pc/:ID',     'PUT',      'itemApiController',        'update');
$router->addRoute('pc',         'POST',     'itemApiController',        'create');

$router->addRoute('user/token', 'GET',      'UserApiController',        'getToken');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);