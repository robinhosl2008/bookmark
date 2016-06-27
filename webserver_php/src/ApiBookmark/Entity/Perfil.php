<?php

namespace ApiBookmark\Entity;

/**
 * Class Perfil
 *
 * @Entity()
 * @Table(name="perfil")
 */
class Perfil extends Entidade {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(type="string", length=255)
     */
    private $noPerfil;

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

    /**
     * @return string
     */
    public function toString(){
        return "[id:"   .$this->id.
        "] [noPerfil:"   .$this->noPerfil."]";
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            'id'         => $this->id,
            'noPerfil'    => $this->noPerfil
        ];
    }
}