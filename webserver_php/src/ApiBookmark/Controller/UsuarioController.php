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
            $obj = $this->getDao()->buscar($id);
            if(isset($obj)){
                $data [] = $obj->toArray();
            }else{
                $data [] = "";
            }
        }

        return $data;
    }

    public function insert($json){
        $usuario = new Usuario();
        $usuario->setRole($json->role);
        $usuario->setStatus($json->status);
        $usuario->setNome($json->nome);
        $usuario->setSobrenome($json->sobrenome);
        $usuario->setEmail($json->email);
        $usuario->setUsername($json->username);
        $usuario->setPassword($json->password);
        $usuario->setCreatedAt(new \DateTime());
        $usuario->setUpdatedAt(new \DateTime());

        $this->getDao()->cadastrar($usuario);
        return ['mensagem' => 'Usuário cadastrado com sucesso!'];
    }

    public function update($json){
        $usuario = $this->getDao()->buscar($json->id);

        if(isset($usuario)){
            $usuario->setNome($json->nome);
            $usuario->setSobrenome($json->sobrenome);
            $usuario->setEmail($json->email);
            $usuario->setRole($json->role);
            $usuario->setUsername($json->username);
            $usuario->setUpdatedAt(new \DateTime());

            $this->getDao()->editar($usuario);
            return ['mensagem' => 'Usuário editado com sucesso!'];
        }else{
            return ['mensagem' => 'Registro não encontrado'];
        }
    }

    public function delete($json){
        $usuario = $this->getDao()->buscar($json->id);

        if(isset($usuario)){
            $this->getDao()->mudarPerfil($usuario);
            return ['mensagem' => 'Usuário excluido com sucesso!'];
        }else{
            return ['mensagem' => 'Registro não encontrado'];
        }
    }

    public function loginCheck($json){
        $username = $json->username;
        $password = $json->password;

        return $this->getDao()->validaUsuario($username, $password);
    }
}