<?php

namespace App\Tests;

 use Liip\TestFixturesBundle\Test\FixturesTrait;
 use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FragmentControllerTest extends WebTestCase
{
    use FixturesTrait;

    public function testGetEntity()
    {
        $fixtures = array(
            'App\DataFixtures\FragmentFixtures',
        );
        $this->loadFixtures($fixtures);
        $client = static::createClient();

        $uuid = '76d3cee3-e3f5-4149-8db6-5dc1d3b58dc4';
        $client->request('GET', '/fragments/' . $uuid);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('Alpha', $content['code']);
        $this->assertEquals('Exemple de contenu de fragment prédéfini!', $content['content']);

        $this->assertTrue(true);
    }

    public function testGetCollection()
    {
        $this->assertTrue(true);
    }

    public function testCreateEntity()
    {
        $this->assertTrue(true);
    }

    public function updateEntity()
    {
        $this->assertTrue(true);
    }

    public function deleteEntity()
    {
        $this->assertTrue(true);
    }
}
