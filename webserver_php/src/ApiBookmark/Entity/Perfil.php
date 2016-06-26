<?php

namespace ApiBookmark\Entity;

/**
 * Class Perfil
 *
 * @Entity()
 * @Table(name="perfil")
 */
class Perfil {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @Column(type="string", length=255)
     */
    public $noPerfil;

    public function __construct($id = "", $noPerfil = "")
    {
        $this->id = $id;
        $this->noPerfil = $noPerfil;
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
    public function getNoPerfil()
    {
        return $this->noPerfil;
    }

    /**
     * @param mixed $noPerfil
     */
    public function setNoPerfil($noPerfil)
    {
        $this->noPerfil = $noPerfil;
    }
}