<?php

namespace ApiBookmark\Persistence;

use ApiBookmark\Entity\Bookmark;
use ApiBookmark\Service\Connection;

class BookmarkDAO {

    private $entityPath = 'ApiBookmark/Entity/Bookmark';
    private $em;

    // Construtor para pegar o gerenciador de entidades.
    public function __construct(){
        $this->em = $this->createEntityManager();
    }

    public function createEntityManager(){
        $conn = new Connection();
        return $conn->getConnection();
    }

    public function listar(){

    }

    public function cadastrar(){

    }

    public function editar(){

    }

    public function deletar(){

    }

    public function buscar(){

    }

}