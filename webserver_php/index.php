<?php

// Carrega o autoload.php.
$loader = require __DIR__.'/vendor/autoload.php';

use ApiBookmark\Controller\BookmarkController;
use ApiBookmark\Controller\UsuarioController;

$bootmarkCtrl = new BookmarkController();
$usuarioCtrl = new UsuarioController();

$app = new \Slim\Slim();

$app->get('/', function(){
    echo json_encode([
        'api' => 'Bookmark',
        'version' => '1.0.0'
    ]);
});

// Sessão que cuida da entidade Usuario.
$app->get('/usuario(/(:id))', function($id = null) use ($usuarioCtrl){
    echo json_encode($usuarioCtrl->get($id));
});

$app->post('/usuario(/)', function() use ($usuarioCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($usuarioCtrl->insert($json));
});

$app->put('/usuario(/)', function() use ($usuarioCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($usuarioCtrl->update($json));
});

$app->delete('/usuario(/)', function() use ($usuarioCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($usuarioCtrl->delete($json));
});

$app->post('/usuario/login-check', function() use ($usuarioCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody()); //print_r($json); exit;
    echo json_encode($usuarioCtrl->loginCheck($json));
});
// Fim da sessão.

// Sessão que cuida da entidade Bookmark.
$app->get('/bookmark(/(:id))', function($id = null) use ($bootmarkCtrl){
    echo json_encode($bootmarkCtrl->get($id));
});

$app->post('/bookmark(/)', function() use ($bootmarkCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($bootmarkCtrl->insert($json));
});

$app->put('/bookmark(/)', function() use ($bootmarkCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($bootmarkCtrl->update($json));
});

$app->delete('/bookmark(/)', function() use ($bootmarkCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($bootmarkCtrl->delete($json));
});

$app->get('/bookmark/buscar/:id', function($id = null) use ($bootmarkCtrl){
    echo json_encode($bootmarkCtrl->buscar($id));
});

// Fim da sessão.



$app->run();

?>