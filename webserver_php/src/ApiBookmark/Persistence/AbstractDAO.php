<?php
/**
 * Created by PhpStorm.
 * User: robson
 * Date: 26/06/16
 * Time: 13:06
 */

namespace ApiBookmark\Persistence;

use ApiBookmark\Service\Connection;
use ApiBookmark\Entity\Bookmark;
use ApiBookmark\Entity\Perfil;
use ApiBookmark\Entity\Usuario;

class AbstractDAO {

    private $entityPath;
    public $entityManager;

    // Construtor para pegar o gerenciador de entidades.
    public function __construct($entityPath) {
        $this->entityPath = $entityPath;
        $this->entityManager = $this->createEntityManager();
    }

    public function createEntityManager() {
        $conn = new Connection();
        return $conn->getConnection();
    }

    public function listar() {
        $perfis = $this->entityManager->getRepository($this->entityPath)->findAll();
        return $perfis;
    }

    public function cadastrar($obj) {
        $this->entityManager->persist($obj);
        $this->entityManager->flush();
    }

    public function editar($obj) { // echo "<pre>"; print_r($obj); exit;
        $this->entityManager->merge($obj);
        $this->entityManager->flush();
    }

    public function deletar($obj) {
        $this->entityManager->remove($obj);
        $this->entityManager->flush();
    }

    public function buscar($id) {
        $obj = $this->entityManager->find($this->entityPath, $id);
        return $obj;
    }
}