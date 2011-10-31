<?php

namespace Ferrandini\UtilsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Ferrandini\UtilsBundle\Lib\Distance\Coordinates;

class DistanceTest extends WebTestCase
{
    /**
     * Test the service method fromAtoB
     */
    public function testFromAToB()
    {
        $client = static::createClient();
        $distance = $client->getContainer()->get('ferrandini_utils.distance');

        $fromAtoB = $distance->fromAtoB(new Coordinates(0, 0), new Coordinates(1, 1));

        $this->assertEquals(157241.8159, $fromAtoB);
    }

    /**
     * Test the service method isPointInsideTheCircle
     */
    public function testIsPointInsideTheCircle()
    {
        $client = static::createClient();
        $distance = $client->getContainer()->get('ferrandini_utils.distance');

        $outside = $distance->isPointInsideTheCircle(
            new Coordinates(0, 0),
            new Coordinates(1, 1),
            1000
        );

        $inside = $distance->isPointInsideTheCircle(
            new Coordinates(0, 0),
            new Coordinates(1, 1),
            200000
        );

        $this->assertEquals(false, $outside);
        $this->assertEquals(true,  $inside);
    }
}
