<?php

namespace Adoptify\Entities;

use Cake\ORM\Entity;

class Post extends Entity
{
    public $created;
    public $updated;
    public $valid_until;

    public function newDates()
    {
        $this->created = date('Y-m-d H:i:s');
        $this->updated = date('Y-m-d H:i:s');
        $this->extend();
    }

    public function extend()
    {
        $this->valid_until = date('Y-m-d H:i:s', strtotime("+14 days"));
    }
}