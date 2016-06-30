<?php

namespace ApiBookmark\Controller;

use ApiBookmark\Entity\Bookmark;
use ApiBookmark\Persistence\BookmarkDAO;

class BookmarkController {

    private $dao;

    public function __construct(){
        $this->setDao(new BookmarkDAO());
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
            $bookmarks = $this->getDao()->listar();

            foreach($bookmarks as $bookmark){
                $data[] = $bookmark->toArray();
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
        $bookmark = new Bookmark();
        $bookmark->setNoBookmark($json->noBookmark);
        $bookmark->setUsuario($json->usuario);
        $bookmark->setDataCad(new \DateTime());

        $this->getDao()->cadastrar($bookmark);
        return ['mensagem' => 'Bookmark cadastrado com sucesso!'];
    }

    public function update($json){
        $bookmark = $this->getDao()->buscar($json->id);

        if(isset($bookmark)){
            $bookmark->setNoBookmark($json->noBookmark);
            $bookmark->setUsuario($json->usuario);

            $this->getDao()->editar($bookmark);
            return ['mensagem' => 'Bookmark editado com sucesso!'];
        }else{
            return ['mensagem' => 'Registro não encontrado'];
        }

    }

    public function delete($json){
        $bookmark = $this->getDao()->buscar($json->id);

        if(isset($bookmark)){
            $this->getDao()->deletar($bookmark);
            return ['mensagem' => 'Bookmark excluido com sucesso!'];
        }else{
            return ['mensagem' => 'Registro não encontrado'];
        }
    }
}