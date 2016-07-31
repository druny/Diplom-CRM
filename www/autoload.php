<?php


spl_autoload_register(function ($class) {
    if (file_exists(__DIR__ . '/controllers/' . $class . '.php')){
        require  __DIR__ . '/controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $class . '.php')) {
        require __DIR__ . '/models/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/views/' . $class . '.php')) {
        require __DIR__ . '/views/' . $class . '.php';
    }elseif (file_exists(__DIR__ . '/classes/' . $class . '.php')) {
        require __DIR__ . '/classes/' . $class . '.php';

    } else {
        require __DIR__ . '/../vendor/autoload.php';
        $classParts = explode('\\', $class);
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR , $classParts) . '.php';
        if (file_exists($path)) {
            require $path;
        }

    }
});

/*function __autoload($class)
{

    if (file_exists(__DIR__ . '/controllers/' . $class . '.php')){
        require  __DIR__ . '/controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $class . '.php')) {
        require __DIR__ . '/models/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/views/' . $class . '.php')) {
        require __DIR__ . '/views/' . $class . '.php';
    }elseif (file_exists(__DIR__ . '/classes/' . $class . '.php')) {
        require __DIR__ . '/classes/' . $class . '.php';
    } else {
        require __DIR__ . '/../vendor/autoload.php';
        $classParts = explode('\\', $class);
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR , $classParts) . '.php';
        if (file_exists($path)) {
            require $path;
        }

    }

} */