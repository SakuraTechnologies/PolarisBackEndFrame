<?php

require_once 'index.php';
require_once '../src/HttpResponse/SimpleRedirector.php';

function registerAndMatchRoutes()
{
    $router = new index();
    $routes = [
        'index' => 'HomeController::index',
        'motd' => 'MotdInfo::index',
    ];

    foreach ($routes as $route => $handler) {
        $router->addRoute($route, $handler);
    }

    $route = isset($_GET['route']) ? $_GET['route'] : 'home';

    $router->matchRoute($route);
}

registerAndMatchRoutes();

class HomeController
{
    public function index()
    {
        $redir = new SimpleRedirector("http://localhost:8001/ColdCityMC/App/ServerBasicInfo.php");
    }
}

class MotdInfo
{
    public function index()
    {
        $redir = new SimpleRedirector("http://localhost:8001/ColdCityMC/App/ServerStatus.php");
    }
}
