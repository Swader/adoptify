<?php


namespace Adoptify\Entities;

use Cake\ORM\TableRegistry;
use Psecio\Gatekeeper\UserModel;

/**
 * Class User
 * @package Adoptify\Entities
 *
 */
class User
{
    /** @var UserModel */
    protected $model;

    /** @var \Cake\ORM\Table */
    protected $postsTable;

    /** @var string */
    protected static $draftsFolder;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    /**
     * Forwards the call to a method to the underlying model
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return $this->model->$name(...$arguments);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->model->$name;
    }

    /**
     * @param string $name
     * @param $value
     * @return $this
     */
    public function __set(string $name, $value)
    {
        $this->model->$name = $value;
        return $this;
    }
}