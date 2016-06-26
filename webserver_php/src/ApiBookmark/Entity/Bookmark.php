<?php

namespace ApiBookmark\Entity;

/**
 * Class Bookmark
 *
 * @Entity()
 * @Table(name="bookmark")
 */
class Bookmark {

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
     * @ManyToOne(targetEntity="Usuario")
     * @JoinColumn(name="usuario", referencedColumnName="id")
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
}