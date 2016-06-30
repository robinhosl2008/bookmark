<?php

namespace ApiBookmark\Persistence;

class BookmarkDAO extends AbstractDAO {
    public function __construct(){
        parent::__construct('ApiBookmark\Entity\Bookmark');
    }
}