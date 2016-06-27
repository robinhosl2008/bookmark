<?php
/**
 * Created by PhpStorm.
 * User: robson
 * Date: 25/06/16
 * Time: 19:16
 */

namespace ApiBookmark\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Connection {

    public function getConnection(){
        $path = array(
            'ApiBookmark\Entity'
        );

        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

        $connectionOptions = array(
            'dbname' => 'db_bookmark',
            'user' => 'root',
            'password' => 'root',
            'host' => '127.0.0.1',
            'driver' => 'pdo_mysql',
        );

        return EntityManager::create($connectionOptions, $config);
    }
}