<?php

namespace GSoares\CweTop25\Entity;

trait IdTrait
{

    /**
     * @var int
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function changeId($id)
    {
        $this->id = $id;
    }
}
