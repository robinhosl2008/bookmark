<?php

namespace ApiBookmark\Persistence;

class PerfilDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Perfil');
    }
}