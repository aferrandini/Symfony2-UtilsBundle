<?php

namespace Ferrandini\UtilsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Ferrandini\UtilsBundle\Lib\Distance\Coordinates;

class DistanceTest extends WebTestCase
{
    /**
     * @todo Write tests
     */
    public function testService()
    {
        $client = static::createClient();
        $distance = $client->getContainer()->get('ferrandini_utils.distance');

        $fromAtoB = $distance->fromAtoB(new Coordinates(0, 0), new Coordinates(1, 1));

        $this->assertEquals(157241.8159, $fromAtoB);
    }

}
