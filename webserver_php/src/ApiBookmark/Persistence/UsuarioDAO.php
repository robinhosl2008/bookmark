<?php

namespace ApiBookmark\Persistence;

use ApiBookmark\Entity\Usuario;
use ApiBookmark\Persistence\AbstractDAO;

class UsuarioDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Usuario');
    }

    public function cadastrar(Usuario $obj) {
        $perfil = $this->entityManager->find('ApiBookmark\Entity\Perfil', $obj->getPerfil());
        $obj->setPerfil($perfil);
        parent::cadastrar($obj);
    }
}