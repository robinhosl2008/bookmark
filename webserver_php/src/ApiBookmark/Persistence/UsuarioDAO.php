<?php

namespace ApiBookmark\Persistence;

use ApiBookmark\Entity\Usuario;
use ApiBookmark\Persistence\AbstractDAO;
use DateTime;


class UsuarioDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Usuario');
    }

//    public function cadastrar(Usuario $obj) {
//        $perfil = $this->entityManager->find('ApiBookmark\Entity\Perfil', $obj->getPerfil());
//        $obj->setPerfil($perfil);
//        $time = new DateTime("now");
//        $obj->setDataCad($time);
//        parent::cadastrar($obj);
//    }
}