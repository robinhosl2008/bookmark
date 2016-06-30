<?php

// Carrega o autoload.php.
$loader = require __DIR__.'/vendor/autoload.php';

use ApiBookmark\Controller\PerfilController;
use ApiBookmark\Controller\BookmarkController;
use ApiBookmark\Controller\UsuarioController;

$perfilCtrl = new PerfilController();
$bootmarkCtrl = new BookmarkController();
$usuarioCtrl = new UsuarioController();

$app = new \Slim\Slim();

$app->get('/', function(){
    echo json_encode([
        'api' => 'Bookmark',
        'version' => '1.0.0'
    ]);
});

// Sessão que cuida da entidade Perfil.
$app->get('/perfil(/(:id))', function($id = null) use ($perfilCtrl){
    echo json_encode($perfilCtrl->get($id));
});

$app->post('/perfil(/)', function() use ($perfilCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($perfilCtrl->insert($json));
});

$app->put('/perfil(/)', function() use ($perfilCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($perfilCtrl->update($json));
});

$app->delete('/perfil(/)', function() use ($perfilCtrl){
    $app = \Slim\Slim::getInstance();
    $json = json_decode($app->request()->getBody());
    echo json_encode($perfilCtrl->delete($json));
});
// Fim da sessão.

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
// Fim da sessão.

// Sessão que cuida da entidade Bookmark.
$app->get('/bookmark(/(:id))', function($id = null) use ($bootmarkCtrl){ //echo $id; exit;
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
// Fim da sessão.



$app->run();

?>