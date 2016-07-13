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
    public $createdAt;

    /**
     * @DateTime
     * @Column(type="datetime")
     */
    public $updatedAt;

    function __construct($id = "", $noBookmark = "", $usuario = "", $createdAt = "", $updatedAt = "")
    {
        $this->id = $id;
        $this->noBookmark = $noBookmark;
        $this->usuario = $usuario;
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
    public function getNoBookmark()
    {
        return $this->noBookmark;
    }

    /**
     * @param $noBookmark
     */
    public function setNoBookmark($noBookmark)
    {
        $this->noBookmark = $noBookmark;
    }

    /**
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
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
        return "[id:"   .$this->id.
        "] [noBookmark:".$this->noBookmark.
        "] [usuario:"   .$this->usuario.
        "] [createdAt:"   .$this->createdAt.
        "] [updatedAt:"   .$this->updatedAt."]";
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            'id'         => $this->id,
            'noBookmark' => $this->noBookmark,
            'usuario'    => $this->usuario,
            'createdAt'    => $this->createdAt,
            'updatedAt'    => $this->updatedAt
        ];
    }
}












