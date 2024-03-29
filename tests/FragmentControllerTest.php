<?php

namespace App\Tests;

 use App\Entity\Fragment;
 use Liip\TestFixturesBundle\Test\FixturesTrait;
 use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FragmentControllerTest extends WebTestCase
{
    use FixturesTrait;

    public function testGetEntity()
    {
        // prepare fixtures
        $fixtures = array(
            'App\DataFixtures\FragmentFixtures',
        );
        $this->loadFixtures($fixtures);

        // prepare HTTP request to send
        $client = static::createClient();
        $uuid = '76d3cee3-e3f5-4149-8db6-5dc1d3b58dc4';
        $client->request('GET', '/fragments/' . $uuid);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // check response
        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('Alpha', $content['code']);
        $this->assertEquals('Exemple de contenu de fragment prédéfini!', $content['content']);

        $this->assertTrue(true);
    }

    public function testGetCollection()
    {
        // prepare fixtures
        $fixtures = array(
            'App\DataFixtures\FragmentFixtures',
        );
        $this->loadFixtures($fixtures);

        $this->assertTrue(true);
    }

    public function testCreateEntity()
    {
        // prepare fixtures
        $fixtures = array(
            'App\DataFixtures\FragmentFixtures',
        );
        $this->loadFixtures($fixtures);

        // prepare HTTP request to send
        $data = '{"content": "Exemple de contenu rempli par post"}';
        $client = static::createClient();
        $client->request('POST', '/fragments', [], [], [], $data);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // check response
        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertContains('FRAG_', $content['code']);
        $this->assertEquals('Exemple de contenu rempli par post', $content['content']);
    }

    public function updateEntity()
    {
        // prepare fixtures
        $fixtures = array(
            'App\DataFixtures\FragmentFixtures',
        );
        $this->loadFixtures($fixtures);

        //todo : finish test
    }

    public function testDeleteEntity()
    {
        // prepare fixtures
        $fixtures = array(
            'App\DataFixtures\FragmentFixtures',
        );
        $this->loadFixtures($fixtures);

        // initial context
        static::bootKernel();
        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $fragments = $em->getRepository(Fragment::class)->findAll();
        $this->assertCount(11, $fragments);

        // prepare HTTP request to send
        $data = '{"uuid": "76d3cee3-e3f5-4149-8db6-5dc1d3b58dc4"}';
        $client = static::createClient();
        $client->request('DELETE', '/fragments', [], [], [], $data);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $fragments = $em->getRepository(Fragment::class)->findAll();
        $this->assertCount(10, $fragments);

    }
}
