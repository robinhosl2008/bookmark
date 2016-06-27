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
            $bookmark = $this->getDao()->buscar($id);
            if(isset($obj)){
                $data [] = $bookmark->toArray();
            }else{
                $data [] = "";
            }
        }

        return $data;
    }

    public function insert($json){
        $bookmark = new Bookmark($json->id, $json->usuario, $json->noBookmark, $json->dataCad);
        $this->getDao()->cadastrar($bookmark);
        return ['mensagem' => 'Bookmark cadastrado com sucesso!'];
    }

    public function update($json){
        $bookmark = new Bookmark($json->id, $json->usuario, $json->noBookmark, $json->dataCad);
        $this->getDao()->editar($bookmark);
        return ['mensagem' => 'Bookmark editado com sucesso!'];
    }

    public function delete($json){
        $usuario = $this->getDao()->buscar($json->id);
        $this->getDao()->deletar($usuario);
        return ['mensagem' => 'Bookmark excluido com sucesso!'];
    }
}