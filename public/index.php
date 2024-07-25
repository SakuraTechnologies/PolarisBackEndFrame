<?php

// 路由类
class index {
    private $routes = [];

    public function addRoute($route, $handler) {
        $this->routes[$route] = $handler;
    }

    public function matchRoute($route) {
        $segments = explode('/', trim($route, '/'));

        if (array_key_exists($segments[0], $this->routes)) {
            $controllerMethod = $this->routes[$segments[0]];
            list($controllerClass, $method) = explode('::', $controllerMethod);

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                if (method_exists($controller, $method)) {
                    call_user_func([$controller, $method]);
                } else {
                    echo "Method $method not found in class $controllerClass";
                }
            } else {
                echo "Class $controllerClass not found";
            }
        } else {
            echo "Route '$route' not defined";
        }
    }
}

