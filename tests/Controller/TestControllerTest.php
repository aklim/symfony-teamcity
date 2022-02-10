<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello TestController');
    }
    
    public function testAnother(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/test');
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello TestController');
    }
}
