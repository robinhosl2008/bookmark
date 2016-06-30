<?php

namespace ApiBookmark\Entity;

/**
 * Class Bookmark
 *
 * @Entity()
 * @Table(name="bookmark")
 */
class Bookmark extends Entidade {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @Column(type="string", length=255)
     */
    public $noBookmark;

    /**
     * @Column(type="integer")
     */
    public $usuario;

    /**
     * @DateTime
     * @Column(type="datetime")
     */
    public $dataCad;

    function __construct($id = "", $noBookmark = "", $usuario = "", $dataCad = "")
    {
        $this->id = $id;
        $this->noBookmark = $noBookmark;
        $this->usuario = $usuario;
        $this->dataCad = $dataCad;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNoBookmark()
    {
        return $this->noBookmark;
    }

    /**
     * @param mixed $noBookmark
     */
    public function setNoBookmark($noBookmark)
    {
        $this->noBookmark = $noBookmark;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return \DateTime
     */
    public function getDataCad()
    {
        return $this->dataCad;
    }

    /**
     * @param \DateTime $dataCad
     */
    public function setDataCad($dataCad)
    {
        $this->dataCad = $dataCad;
    }

    /**
     * @return string
     */
    public function toString(){
        return "[id:"   .$this->id.
        "] [noBookmark:".$this->noBookmark.
        "] [usuario:"   .$this->usuario.
        "] [dataCad:"   .$this->dataCad."]";
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            'id'         => $this->id,
            'noBookmark' => $this->noBookmark,
            'usuario'    => $this->usuario,
            'dataCad'    => $this->dataCad
        ];
    }
}












