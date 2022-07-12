<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpaControllerTest extends WebTestCase
{
    public function testWebSiteIsUp(): void
    {
        $client = static::createClient();
        $client->request('Get', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'Welcome!');
    }
	
	public function testSpaApiIsUp(): void
	{
		$client = static::createClient();
		$client->request('POST', '/spa_api');
		$this->assertResponseIsSuccessful();
	}
}
