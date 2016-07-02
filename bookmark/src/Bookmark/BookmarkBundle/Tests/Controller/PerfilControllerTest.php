<?php

namespace Bookmark\BookmarkBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PerfilControllerTest extends WebTestCase
{
    public function testListar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listar');
    }

    public function testCadastar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cadastar');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editar');
    }

    public function testDeletar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deletar');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/buscar');
    }

}
