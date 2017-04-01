<?php
// tests/AppBundle/Form/ResaTypeTest.php

namespace tests\AppBundle\Form;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ResaTypeTest extends WebTestCase
{

	// teste que l'absence de selection de quantité de ticket renvoie sur la page d'erreur si on
	// essaye directement d'arriver sur la page reservation
	public function testResaQtyCheck() 
	{
		ini_set('memory_limit', '1300M');
		$client = static::createClient();
        $crawler = $client->request('GET', '/reservation'); 
        $this->assertContains('failedresa', $client->getResponse()->getContent());
    }

    // teste la présence des champs dans le formulaire pour 1,6 billets
    public function testResaInput()
    {
    		foreach (array(1, 6) as &$value) {
	    		$client = static::createClient();
	            $crawler = $client->request('GET', '/quantite_ticket');
				$form = $crawler->selectButton('Continuer la réservation')->form();
				$form['qty[quantite]']->select((string)$value);
				// permet de passer la redirection
				$client->followRedirects();
				$crawler = $client->submit($form);
				$this->assertCount(4 * $value, $crawler->filter('input[type=text]'));
				$this->assertCount(1 * $value, $crawler->filter('input[type=email]'));
				$this->assertCount(1 * $value, $crawler->filter('input[type=checkbox]'));
				$this->assertCount(1 * $value, $crawler->filter('input[type=button]'));
				$this->assertCount(1, $crawler->filter('input[type=submit]'), $message = "submit");
				$this->assertCount(1, $crawler->filter('input[type=hidden]'), $message = "hidden");
			}
    }
 
}