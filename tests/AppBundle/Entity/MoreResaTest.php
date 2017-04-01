<?php

namespace tests\AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
// Entity
use AppBundle\Entity\MoreResa;
use AppBundle\Entity\Resa;


class MoreResaTest extends TestCase
{
	// test l'ajout et la suppréssion d'entité resa via l'entité moreResa
	public function testaddRemove()
	{
		$resa = new Resa();

		$resa->setNom('Martin');
		$resa->setPrenom('Julien');
		$resa->setEmail('julien.martin@phpunit.fr');
		$resa->setPays('FR');
		$resa->setDateNaissance('03/03/1980');
		$resa->setJourVisite('30/03/2017');
		$resa->setTypebillets('Journée');
		$resa->setTarifReduit(false);
		$resa->setPrixTicket(16);
		$resa->setResaNumber();

		$moreResa = new MoreResa();
		$moreResa->addResa($resa);
		$resas = $moreResa->getResas()->first();
		
		$this->assertEquals('Martin', $resas->getNom());
		$this->assertEquals('Julien', $resas->getPrenom());
		$this->assertEquals('julien.martin@phpunit.fr', $resas->getEmail());
		$this->assertEquals('FR', $resas->getPays());
		$this->assertEquals('03/03/1980', $resas->getDateNaissance());
		$this->assertEquals('30/03/2017', $resas->getJourVisite());
		$this->assertEquals('Journée', $resas->getTypebillets());
		$this->assertFalse($resas->getTarifReduit());
		$this->assertEquals(16, $resas->getPrixTicket());
        $this->assertNotNull($resas->getResaNumber());

		$moreResa->removeResa($resa);
		$this->assertEmpty($moreResa->getResas()->first());

		$moreResa->setPrixTotal(30);
		$this->assertEquals(30, $moreResa->getPrixTotal());
	}
}