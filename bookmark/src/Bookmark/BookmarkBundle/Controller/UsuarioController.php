<?php

namespace Bookmark\BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

/**
 * Class UsuarioController
 * @package Bookmark\BookmarkBundle\Controller
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    private $uri = '';

    public function __construct(){
        $this->uri = 'http://localhost:8000/usuario';
    }

    /**
     * @Route("/listar")
     */
    public function listarAction()
    {
        $client = new Client();
        $result = $client->get($this->uri);
        $usuarios = json_decode($result->getBody()->__toString());

        $client = new Client();
        $result = $client->request('GET', 'http://localhost:8000/perfil');
        $perfis = json_decode($result->getBody()->__toString());


        return $this->render('BookmarkBundle:Usuario:listar.html.twig', array('usuarios' => $usuarios, 'perfis' => $perfis));
    }

    /**
     * @Route("/cadastrar")
     */
    public function cadastrarAction(Request $request)
    {
        if($_POST){
            $noUsuario = $request->get('noUsuario');
            $email     = $request->get('email');
            $perfil    = $request->get('perfil');
            $username  = $request->get('login');
            $senha     = $request->get('senha');

            $client = new Client();
            $result = $client->request('POST', $this->uri , [
                'json' => [
                    'id' => '',
                    'noUsuario' => $noUsuario,
                    'email' => $email,
                    'perfil' => $perfil,
                    'login' => $username,
                    'senha' => $senha,
                    'dataCad' => '',
                ]
            ]);

            return $this->redirect('/usuario/listar');
        }else{
            $client = new Client();
            $result = $client->request('GET', 'http://localhost:8000/perfil');
            $perfis = json_decode($result->getBody()->__toString());

            return $this->render('BookmarkBundle:Usuario:cadastrar.html.twig', ['perfis' => $perfis]);
        }
    }

    /**
     * @Route("/editar/{id}")
     */
    public function editarAction(Request $request)
    {
        if($_POST){
            $id        = $request->get('id');
            $noUsuario = $request->get('noUsuario');
            $email     = $request->get('email');
            $perfil    = $request->get('perfil');

            $client = new Client();
            $result = $client->request('PUT', $this->uri , ['json' => ['id' => $id, 'noUsuario' => $noUsuario, 'email' => $email, 'perfil' => $perfil]]);

            return $this->redirect('/usuario/listar');
        }else {
            $id = $request->get('id');

            // Instancia o cliente Guzzle.
            $client = new Client();

            // Envia a requisição para a API e atribui o resultado a uma variável.
            $result = $client->request('GET', "http://localhost:8000/usuario/$id", array());

            // Converte o Json vindo da API em array.
            $arrayUsuario = json_decode($result->getBody()->__toString());

            // Pega o objeto dentro do array.
            $usuario = $arrayUsuario[0];

            $client = new Client();
            $result = $client->request('GET', 'http://localhost:8000/perfil');
            $perfis = json_decode($result->getBody()->__toString());

            return $this->render('BookmarkBundle:Usuario:editar.html.twig', ['usuario' => $usuario, 'perfis' => $perfis]);
        }
    }

    /**
     * @Route("/deletar/{id}")
     */
    public function deletarAction(Request $request)
    {
        $id = $request->get('id');

        $client = new Client();
        $result = $client->request('DELETE', $this->uri, ['json' => ['id' => $request->get('id')]]);

        return $this->redirect('/usuario/listar');
    }

    /**
     * @Route("/buscar")
     */
    public function buscarAction()
    {
        return $this->render('BookmarkBundle:Usuario:buscar.html.twig', array(
            // ...
        ));
    }

}
