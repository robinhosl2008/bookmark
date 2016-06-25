<?php

namespace ApiBookmark\Entity;

/**
 * Class Usuario
 *
 * @Entity()
 * @Table(name="usuario")
 */
class Usuario {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @Column(type="integer")
     */
    public $perfil;

    /**
     * @Column(type="string", length=255)
     */
    public $noUsuario;

    /**
     * @Column(type="string", length=255)
     */
    public $email;

    /**
     * @Column(type="string", length=255)
     */
    public $login;

    /**
     * @Column(type="string", length=255)
     */
    public $senha;

    /**
     * @Column(type="date")
     */
    public $dataCad;

    function __construct($id = "", $perfil = "", $noUsuario = "", $email = "", $login = "", $senha = "", $dataCad = "")
    {
        $this->id = $id;
        $this->perfil = $perfil;
        $this->noUsuario = $noUsuario;
        $this->email = $email;
        $this->login = $login;
        $this->senha = $senha;
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
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @param mixed $perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }

    /**
     * @return mixed
     */
    public function getNoUsuario()
    {
        return $this->noUsuario;
    }

    /**
     * @param mixed $noUsuario
     */
    public function setNoUsuario($noUsuario)
    {
        $this->noUsuario = $noUsuario;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getDataCad()
    {
        return $this->dataCad;
    }

    /**
     * @param mixed $dataCad
     */
    public function setDataCad($dataCad)
    {
        $this->dataCad = $dataCad;
    }

//    public function __construct(){
//        $this->idUsuario = $array
//    }


}