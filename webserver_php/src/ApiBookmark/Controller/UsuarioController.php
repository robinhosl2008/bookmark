<?php

namespace ApiBookmark\Controller;

use ApiBookmark\Entity\Usuario;
use ApiBookmark\Persistence\UsuarioDAO;

class UsuarioController {

    private $dao;

    public function __construct(){
        $this->setDao(new UsuarioDAO());
    }

    public function getDao(){
        return $this->dao;
    }

    public function setDao($dao){
        $this->dao = $dao;
    }

    public function get($id = null){
        $data = [];
        if($id == null){
            $usuarios = $this->getDao()->listar();

            foreach($usuarios as $usuario){
                $data[] = $usuario->toArray();
            }
        }else{
            $usuario = $this->getDao()->buscar($id);
            if(isset($obj)){
                $data [] = $usuario->toArray();
            }else{
                $data [] = "";
            }
        }

        return $data;
    }

    public function insert($json){
        $usuario = new Usuario($json->id, $json->perfil, $json->noUsuario, $json->email, $json->login, $json->senha, $json->dataCad);
        $this->getDao()->cadastrar($usuario);
        return ['mensagem' => 'Usuário cadastrado com sucesso!'];
    }

    public function update($json){
        $usuario = new Usuario($json->id, $json->perfil, $json->noUsuario, $json->email, $json->login, $json->senha, $json->dataCad);
        $this->getDao()->editar($usuario);
        return ['mensagem' => 'Usuário editado com sucesso!'];
    }

    public function delete($json){
        $usuario = $this->getDao()->buscar($json->id);
        $this->getDao()->deletar($usuario);
        return ['mensagem' => 'Usuário excluido com sucesso!'];
    }
}