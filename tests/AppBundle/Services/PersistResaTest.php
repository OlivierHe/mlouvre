<?php

namespace tests\AppBundle\Service;

use AppBundle\Services\PersistResa;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersistResaTest extends KernelTestCase {

    protected $persistresa;
    protected $dateToday;

    protected function setUp()
    {
        self::bootKernel();
        $this->persistresa = static::$kernel->getContainer()->get('app.persistresa');
        $this->dateToday = new \DateTime("now");

    }

    // test le calcul de prix en fonction de l'age
    // reflection d'une fonction private
    public function testgetPriceByAge()
    {
        $tarifReduit = false;
        $birthDate = new \DateTime('1980-05-09');
        $obj = $this->persistresa;
        // date par default de 12 à 59 ans
        $result = $this->invokeMethod($obj, 'getPrice', array($birthDate,$tarifReduit));
        $this->assertEquals(16, $result);
        // tarif réduit
        $tarifReduit = true;
        $rTarifReduit = $this->invokeMethod($obj, 'getPrice', array($birthDate,$tarifReduit));
        $this->assertEquals(10, $rTarifReduit);
        // moins de 4 ans
        $tarifReduit = false;
        $birthDate = new \DateTime('2015-05-09');
        $rMoinsDe4 = $this->invokeMethod($obj, 'getPrice', array($birthDate,$tarifReduit));
        $this->assertEquals(0, $rMoinsDe4);
        // moins de 12 ans
        $birthDate = new \DateTime('2006-05-09');
        $rMoinsDe12 = $this->invokeMethod($obj, 'getPrice', array($birthDate,$tarifReduit));
        $this->assertEquals(8, $rMoinsDe12);
        // plus de 60 ans
        $birthDate = new \DateTime('1946-05-09');
        $rPlus60ans = $this->invokeMethod($obj, 'getPrice', array($birthDate,$tarifReduit));
        $this->assertEquals(12, $rPlus60ans);
    }

     /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
 
}