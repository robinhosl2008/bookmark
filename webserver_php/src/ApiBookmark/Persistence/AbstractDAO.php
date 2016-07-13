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

    public function editar($obj) {
        $this->entityManager->merge($obj);
        $this->entityManager->flush();
    }

    public function deletar($obj) {
        $this->entityManager->remove($obj);
        $this->entityManager->flush();
    }

    public function mudarPerfil($obj) {
        if($obj->status == '1'){
            $obj->status = 0;
        }else{
            $obj->status = 1;
        }

        //$this->entityManager->remove($obj);
        $this->entityManager->merge($obj);
        $this->entityManager->flush();
    }

    public function buscar($id) {
        $obj = $this->entityManager->find($this->entityPath, $id);
        return $obj;
    }

    public function listarById($id){
        $obj = $this->entityManager->getRepository($this->entityPath)->findBy(
            array('usuario' => $id)
        );
        return $obj;
    }

    public function validaUsuario($username, $password){ //echo $this->entityPath; exit;
        $usuario = $this->entityManager
            ->getRepository($this->entityPath)
            ->findOneBy(array(
                'username' => $username,
                'password' => $password
            ));

        if(!empty($usuario)){
            if($usuario->status == 1) {
                return $usuario;
            }else{
                return ['tipoMensagem' => 'warning', 'mensagem' => 'Este usuário foi desativado, entre em contato com o administrador do site!'];
            }
        }else{
            return ['tipoMensagem' => 'warning', 'mensagem' => 'Username ou password incorretos, tente novamente!'];
        }
    }
}