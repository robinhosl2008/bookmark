<?php

// Carrega o autoload.php.
$loader = require __DIR__.'/vendor/autoload.php';

use ApiBookmark\Entity\Perfil;
use ApiBookmark\Entity\Usuario;
use ApiBookmark\Entity\Bookmark;
use ApiBookmark\Persistence\PerfilDAO;
use ApiBookmark\Persistence\UsuarioDAO;
use ApiBookmark\Persistence\BookmarkDAO;
use ApiBookmark\Persistence\AbstractDAO;

$perfilDao = new PerfilDAO();
$app = new \Slim\Slim();

$app->get('/', function(){
    echo json_encode([
        'api' => 'Bookmark',
        'version' => '1.0.0'
    ]);
});

$app->get('/perfil(/(:id))', function($id = null) use ($perfilDao){

    echo json_encode($perfilDao->listar());
});

$app->run();

//$usuarioDao = new UsuarioDAO();
//$perfilDao = new PerfilDAO();
//$perfil = $perfilDao->buscar(3);



//$usuario = new Usuario();
//$usuario->setNoUsuario("Robson Lourenço");
//$usuario->setEmail("robinhosl2008@gmai.com");
//$usuario->setDataCad(new DateTime("now"));
//$usuario->setPerfil(1);
//$usuario->setLogin("robinhosl2008");
//$usuario->setSenha("123456");
//
//$usuarioDao->cadastrar($usuario);
//echo "<pre>";
//print_r($usuario);
//exit;

//$bookmarkDao = new BookmarkDAO();
//
//$bookmark = new Bookmark();
//$bookmark->setUsuario(2);
//$bookmark->setNoBookmark("www.facebook.com.br");
//$bookmark->setDataCad(new DateTime("now"));
//
//$bookmarkDao->cadastrar($bookmark);


//echo "Estamos no index.php";

?>