<?php

namespace tests\AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
// Entity
use AppBundle\Entity\Resa;


class ResaTest extends TestCase
{
	// test l'hydratation de l'entité resa
	public function testHydratation()
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
		
		$this->assertEquals('Martin', $resa->getNom());
		$this->assertEquals('Julien', $resa->getPrenom());
		$this->assertEquals('julien.martin@phpunit.fr', $resa->getEmail());
		$this->assertEquals('FR', $resa->getPays());
		$this->assertEquals('03/03/1980', $resa->getDateNaissance());
		$this->assertEquals('30/03/2017', $resa->getJourVisite());
		$this->assertEquals('Journée', $resa->getTypebillets());
		$this->assertFalse($resa->getTarifReduit());
		$this->assertEquals(16, $resa->getPrixTicket());
        $this->assertNotNull($resa->getResaNumber());
	}
}