<?php

namespace core;

class Router
{
    private array $routes = [];

    public function get($path, $action) {
        $this->addRoute('GET', $path, $action);
    }

    public function post($path, $action) {
        $this->addRoute('POST', $path, $action);
    }

    public function addRoute($method, $path, $action) {
        $pattern = preg_replace('#\{\w+}#', '([\w-]+)', $path);
        $pattern = "#^" . $pattern . "/?$#";
        $this->routes[] = compact('method', 'pattern', 'action');
    }

    public function dispatch($uri, $method) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);
                return $this->callAction($route['action'], $matches);
            }
        }
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
        exit;
    }

    private function callAction($action, array $params) {
        list($controllerName, $method) = explode('@', $action);
        require_once 'controllers/' . $controllerName . '.php';
        $controller = new $controllerName();
        return call_user_func_array([$controller, $method], $params);
    }
}