<?php

//    echo "Hello World!";

// Carrega o autoload.php.
$loader = require __DIR__.'/vendor/autoload.php';
use ApiBookmark\Entity\Usuario;

$usuario = new Usuario();
$usuario->setNoUsuario('Robson Lourenço');
$usuario->setEmail('robinhosl2008@gmail.com');

$usuario_json = json_encode($usuario);
$usuario_objeto = json_decode($usuario_json);

echo "<pre>";
print_r($usuario_json);
echo "<br />";
echo "<br />";
print_r($usuario_objeto->noUsuario);
echo "<br />";
print_r($usuario_objeto->email);

?>