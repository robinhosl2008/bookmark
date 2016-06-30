<?php

namespace ApiBookmark\Controller;

use ApiBookmark\Entity\Perfil;
use ApiBookmark\Persistence\PerfilDAO;

class PerfilController {

    private $dao;

    public function __construct(){
        $this->setDao(new PerfilDAO());
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
            $perfis = $this->getDao()->listar();

            foreach($perfis as $perfil){
                $data[] = $perfil->toArray();
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
        $perfil = new Perfil($json->id, $json->noPerfil); // print_r($perfil); exit;
        $this->getDao()->cadastrar($perfil);
        return ['mensagem' => 'Perfil cadastrado com sucesso!'];
    }

    public function update($json){
        $perfil = $this->getDao()->buscar($json->id);
        $perfil->setNoPerfil($json->noPerfil);
        $this->getDao()->editar($perfil);
        return ['mensagem' => 'Perfil editado com sucesso!'];
    }

    public function delete($json){
        $perfil = $this->getDao()->buscar($json->id);
        $this->getDao()->deletar($perfil);
        return ['mensagem' => 'Perfil excluido com sucesso!'];
    }
}



















