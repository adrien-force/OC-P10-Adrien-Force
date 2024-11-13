<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ErrorControllerTest extends WebTestCase
{
    public function testAccessDeniedPage()
    {
        $client = static::createClient();
        $client->request('GET', '/access-denied');

        $this->assertResponseStatusCodeSame(200);
        $this->assertStringContainsString('Erreur 403: Accès refusé', $client->getResponse()->getContent());
    }

    public function testErrorPage()
    {
        $client = static::createClient();
        $client->request('GET', '/error/500');

        $this->assertResponseStatusCodeSame(200);
        $this->assertStringContainsString('Erreur 500: Une erreur est survenue', $client->getResponse()->getContent());
    }
}