<?php

namespace ApiBookmark\Persistence;

use ApiBookmark\Entity\Bookmark;
use ApiBookmark\Persistence\AbstractDAO;

class BookmarkDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Bookmark');
    }

    public function cadastrar(Bookmark $obj) {
        $usuario = $this->entityManager->find('ApiBookmark\Entity\Usuario', $obj->getUsuario());
        $obj->setUsuario($usuario);
        parent::cadastrar($obj);
    }
}