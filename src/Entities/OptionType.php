<?php

namespace Opteck\Entities;

use Opteck\Entity;

class OptionType extends Entity
{
    /**
     * Returns Market ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns market name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;
}
