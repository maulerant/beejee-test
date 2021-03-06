<?php

namespace BeeJee\Components;

class Model
{
    /** @var null|\PDO  */
    public $ds = null;

    public function __construct()
    {
        $this->ds = DataSource::getInstance();
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return strtolower(get_class($this));
    }
}