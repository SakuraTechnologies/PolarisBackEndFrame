<?php

require 'index.php';

function Router($RouteName, $Yourclass, $YourFunc)
{
    $router = new index();
    $route = isset($_GET['route']) ? $_GET['route'] : 'home';
    $router->addRoute("$RouteName", "$Yourclass::$YourFunc");
    $router->matchRoute($route);
}
