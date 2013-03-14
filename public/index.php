<?php
require '../vendor/autoload.php';

// init app
$app = new \SlimController\Slim(array(
    'templates.path' => '../src/Demo/Views',
    'controller.class_prefix' => '\\Demo\\Controller',
    'controller.method_suffix' => 'Action',
    'controller.template_suffix' => 'twig',
));
$app->add(new \Slim\Middleware\SessionCookie(array(
        'expires' => '20 minutes',
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => false,
        'name' => 'slim_session',
        'secret' => 'Eiweequu6eiH6vahChohpaey5soh6euC',
        'cipher' => MCRYPT_RIJNDAEL_256,
        'cipher_mode' => MCRYPT_MODE_CBC
    )));

// Prepare view
\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../cache'),
    'auto_reload' => true,
    'strict_variables' => true,
    'autoescape' => true
);
$app->view(new \Slim\Extras\Views\Twig());

// Define routes
$app->addRoutes(
    array(
        '/' => 'Home:index',
        '/add' => array('Home:add', 'post'),
    )
);

// Run app
$app->run();
