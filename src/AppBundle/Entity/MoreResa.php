<?php
// src/AppBundle/Entity/MoreResa.php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class MoreResa
{

    protected $resas;

    public function __construct()
    {
        $this->resas = new ArrayCollection();
    }


    public function setResas($resas)
    {
        $this->resas =$resas;
    }

    public function getResas()
    {
        return $this->resas;
    }
}