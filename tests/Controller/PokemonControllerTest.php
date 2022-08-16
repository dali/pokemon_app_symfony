<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PokemonControllerTest extends WebTestCase
{
    public function testPokemonPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pokemon');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
       
    }


    public function testHelloPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pokemon');
        $this->assertSelectorTextContains('h1', 'Welocome to pokemon page');
    }
}
