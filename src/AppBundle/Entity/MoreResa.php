<?php
// src/AppBundle/Entity/MoreResa.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 */
class MoreResa
{

    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */  
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Resa", cascade={"persist"})
     */
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

    /**
     * Add resa
     *
     * @param \AppBundle\Entity\Resa $resa
     *
     * @return MoreResa
     */
    public function addResa(\AppBundle\Entity\Resa $resa)
    {
        $this->resas[] = $resa;

        return $this;
    }

    /**
     * Remove resa
     *
     * @param \AppBundle\Entity\Resa $resa
     */
    public function removeResa(\AppBundle\Entity\Resa $resa)
    {
        $this->resas->removeElement($resa);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
