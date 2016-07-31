<?php

require_once __DIR__ . '/autoload.php';
session_start();
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathPars = explode('/', $path);

$ctrl = !empty($pathPars[1]) ?  ucfirst($pathPars[1]) : 'task';
$act = !empty($pathPars[2]) ? ucfirst($pathPars[2]) :'all';


try {
    $controllerClassName = $ctrl . 'Controller';
    if(!class_exists($controllerClassName))
    {
        $e = new ModelException('Controller ');
        throw $e;
    } else {
        $controller = new $controllerClassName;
        $method = 'action' . $act;
    }
    if(!method_exists($controller, $method)) {
        throw new ModelException('Method ');
    }

    $controller->$method();
} catch (Exception $e)
    {
        $view = new View();
        $view->error = $e->getMessage();
        $view->display('/errors/not-found.php');
    }





