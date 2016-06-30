<?php

namespace ApiBookmark\Persistence;

class UsuarioDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Usuario');
    }
}