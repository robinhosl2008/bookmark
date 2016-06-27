<?php

namespace ApiBookmark\Persistence;

use ApiBookmark\Entity\Perfil;
use ApiBookmark\Persistence\AbstractDAO;

class PerfilDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Perfil');
    }
}