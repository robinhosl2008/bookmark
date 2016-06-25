<?php
// bootstrap.php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Criando uma simples configuração do Doctrine ORM para o Annotation.
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/ApiBookmark/Entity"), $isDevMode);
// ou, se preferir, para yaml ou XML.
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/src/ApiBookmark/Entity"), $isDevMode);
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/src/ApiBookmark/Entity"), $isDevMode);

$conn = array(
    'dbname'   => 'db_bookmark',
    'user'     => 'root',
    'password' => 'root',
    'host'     => 'localhost',
    'driver'   => 'pdo_mysql'
);

// Obtendo o EntityManager.
$entityManager = EntityManager::create($conn, $config);


?>