<?php

namespace ApiBookmark\Entity;

/**
 * Class Usuario
 *
 * @Entity()
 * @Table(name="usuario")
 */
class Usuario extends Entidade {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ManyToOne(targetEntity="Perfil")
     * @JoinColumn(name="perfil", referencedColumnName="id")
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
     * @DateTime
     * @Column(type="datetime")
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
        return "[id:"       .$this->id.
             "] [noUsuario:".$this->noUsuario.
             "] [email:"    .$this->email.
             "] [perfil:"   .$this->perfil.
             "] [login:"    .$this->login.
             "] [dataCad"   .$this->dataCad."]";
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            'id'        => $this->id,
            'noUsuario' => $this->noBookmark,
            'email'     => $this->dataCad,
            'perfil'    => $this->dataCad,
            'login'     => $this->dataCad,
            'dataCad'   => $this->dataCad
        ];
    }
}