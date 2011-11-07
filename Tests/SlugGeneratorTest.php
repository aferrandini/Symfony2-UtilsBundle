<?php

namespace Ferrandini\UtilsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SlugGeneratorTest extends WebTestCase
{
    /**
     * Test the service method Generator
     */
    public function testGenerator()
    {
        $client = static::createClient();
        $slugger = $client->getContainer()->get('ferrandini_utils.slugger');

        $slug = $slugger->generate("Nuevos Sistemas Tecnológicos S.L.");

        $this->assertEquals("nuevos-sistemas-tecnolgicos-sl", $slug);
    }

    /**
     * Test the service method Generator with length
     */
    public function testGeneratorWithLength()
    {
        $client = static::createClient();
        $slugger = $client->getContainer()->get('ferrandini_utils.slugger');

        $slug = $slugger->generate("Nuevos Sistemas Tecnológicos S.L.", 10);

        $this->assertEquals("nuevos-sis", $slug);
    }

}
