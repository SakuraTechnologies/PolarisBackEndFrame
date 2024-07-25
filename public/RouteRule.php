<?php
/**
 * Yukina Network 2024
 * Route Regitser
 * How to register: $router->addRoute('login', Login::class . '::index');
 *
 * Change At 2024 7 25
 */

require 'index.php';


$router = new index();
$route = isset($_GET['route']) ? $_GET['route'] : 'home';
$router->addRoute('home', 'YourClass::YourFunc');
$router->matchRoute($route);