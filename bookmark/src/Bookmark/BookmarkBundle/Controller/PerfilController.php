<?php

namespace Bookmark\BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;


/**
 * Class PerfilController
 * @package Bookmark\BookmarkBundle\Controller
 * @Route("/perfil")
 */
class PerfilController extends Controller
{
    /**
     * @Route("/listar")
     */
    public function listarAction()
    {
        $client = new Client();
        $result = $client->get('http://localhost:8000/perfil');
        $perfis = json_decode($result->getBody()->__toString());

        return $this->render('BookmarkBundle:Perfil:listar.html.twig', array('perfis' => $perfis));
    }

    /**
     * @Route("/cadastrar")
     */
    public function cadastrarAction(Request $request)
    {
        if($_POST){
            $noPerfil = $request->get('noPerfil');

            $client = new Client();
            $client->request('POST', 'http://localhost:8000/perfil', array('json' => ['id' => '', 'noPerfil' => $noPerfil]));

            return $this->redirect('/perfil/listar');
        }
            return $this->render('BookmarkBundle:Perfil:cadastrar.html.twig', array());
    }

    /**
     * @Route("/editar/{id}")
     */
    public function editarAction(Request $request)
    {
        if($_POST){
            $dados = ['json' => ['id' => $request->get('id'), 'noPerfil' => $request->get('noPerfil')]];

            $client = new Client();
            $result = $client->request('PUT', 'http://localhost:8000/perfil', $dados);

            return $this->redirect('/perfil/listar');
        }else {
            $id = $request->get('id');

            // Instancia o cliente Guzzle.
            $client = new Client();

            // Envia a requisição para a API e atribui o resultado a uma variável.
            $result = $client->request('GET', "http://localhost:8000/perfil/$id", array());

            // Converte o Json vindo da API em array.
            $arrayPerfil = json_decode($result->getBody()->__toString());

            // Pega o objeto dentro do array.
            $perfil = $arrayPerfil[0];

            //echo "<pre>"; var_dump($perfil); exit;

            return $this->render('BookmarkBundle:Perfil:editar.html.twig', ['perfil' => $perfil]);
        }
    }

    /**
     * @Route("/deletar/{id}")
     */
    public function deletarAction(Request $request)
    {
        $id = $request->get('id');

        $client = new Client();
        $result = $client->request('DELETE', 'http://localhost:8000/perfil', ['json' => ['id' => $id]]);

        return $this->redirect('/perfil/listar');
    }

    /**
     * @Route("/buscar")
     */
    public function buscarAction()
    {
        return $this->render('BookmarkBundle:Perfil:buscar.html.twig', array(
            // ...
        ));
    }

}
