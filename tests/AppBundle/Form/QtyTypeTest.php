<?php
// tests/AppBundle/Form/QtyTypeTest.php

namespace tests\AppBundle\Form;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class QtyTypeTest extends WebTestCase
{
	public function testChooseQty()
	{
		// selectionne 2 billet et s'assure que la redirection menne vers la page reservation

			$client = static::createClient();
            $crawler = $client->request('GET', '/quantite_ticket');
			$form = $crawler->selectButton('Continuer la réservation')->form();
			$form['qty[quantite]']->select('2');
			$crawler = $client->submit($form);
	
	        $this->assertTrue($client->getResponse()->isRedirect('/reservation'),
			    'redirection vers reservation'
			);
	    }

}