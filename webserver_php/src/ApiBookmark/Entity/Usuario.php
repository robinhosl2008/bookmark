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
     * @Column(type="string", columnDefinition="ENUM('ROLE_ADMIN', 'ROLE_USER')", length=100)
     */
    public $role;

    /**
     * @Column(type="boolean")
     */
    public $status;

    /**
     * @Column(type="string", length=100)
     */
    public $nome;

    /**
     * @Column(type="string", length=100)
     */
    public $sobrenome;

    /**
     * @Column(type="string", length=100)
     */
    public $email;

    /**
     * @Column(type="string", length=100)
     */
    public $username;

    /**
     * @Column(type="string", length=100)
     */
    public $password;

    /**
     * @DateTime
     * @Column(type="datetime")
     */
    public $createdAt;

    /**
     * @DateTime
     * @Column(type="datetime")
     */
    public $updatedAt;

    function __construct(
        $id = "",
        $role = "",
        $status = "",
        $nome = "",
        $sobrenome = "",
        $email = "",
        $username = "",
        $password = "",
        $createdAt = "",
        $updatedAt = "")
    {
        $this->id = $id;
        $this->role = $role;
        $this->status = $status;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @param $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function toString(){
        return "[id:"       .$this->id.
             "] [role:"     .$this->role.
             "] [status:"   .$this->status.
             "] [nome:"     .$this->nome.
             "] [sobrenome:".$this->sobrenome.
             "] [email:"    .$this->email.
             "] [username:" .$this->username.
             "] [password:" .$this->password.
             "] [createdAt" .$this->createdAt.
             "] [updatedAt" .$this->updatedAt."]";
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            'id'        => $this->id,
            'role'      => $this->role,
            'status'    => $this->status,
            'nome'      => $this->nome,
            'sobrenome' => $this->sobrenome,
            'email'     => $this->email,
            'username'  => $this->username,
            'password'  => $this->password,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}