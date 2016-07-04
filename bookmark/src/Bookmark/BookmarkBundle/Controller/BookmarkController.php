<?php

namespace Bookmark\BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

/**
 * Class BookmarkController
 * @package Bookmark\BookmarkBundle\Controller
 * @Route("/bookmark")
 */
class BookmarkController extends Controller
{
    private $uri = "";
    private $client = "";

    public function __construct(){
        $this->uri = "http://localhost:8000/bookmark";
        $this->client = new Client();
    }

    /**
     * @Route("/listar")
     */
    public function listarAction()
    {
        // Retorna a listagem de bookmarks da API.
        $result = $this->client->get($this->uri);

        // Converte o json em objeto.
        $bookmarks = json_decode($result->getBody()->__toString());

        return $this->render('BookmarkBundle:Bookmark:listar.html.twig', ['bookmarks' => $bookmarks]);
    }

    /**
     * @Route("/cadastrar")
     */
    public function cadastrarAction(Request $request)
    {
        if($_POST){
            $noBookmark = $request->get('noBookmark');

            $result = $this->client->request('POST', $this->uri, [
                'json' => [
                    'id'         => '',
                    'noBookmark' => $noBookmark,
                    'usuario'    => '',
                    'dataCad'    => ''
                ]
            ]);

            return $this->redirect('/bookmark/listar');
        }else{
            return $this->render('BookmarkBundle:Bookmark:cadastrar.html.twig', array());
        }
    }

    /**
     * @Route("/editar/{id}")
     */
    public function editarAction(Request $request)
    {
        if($_POST){
            // Recupera os dados via post.
            $id = $request->get('id');
            $noBookmark = $request->get('noBookmark');

            // Faz a requisição
            $result = $this->client->request('PUT', $this->uri, [
                'json' => [
                    'id'         => $id,
                    'noBookmark' => $noBookmark,
                    'usuario'    => '',
                    'dataCad'    => ''
                ]
            ]);

            return $this->redirect('/bookmark/listar');
        }else {
            // Pega o ID na URL.
            $id = $request->get('id');

            // Manda a requisição e atribui o resultado a uma variável.
            $result = $this->client->request('get', $this->uri.'/'.$id, array());

            // Converte a string json em array.
            $arrayBookmark = json_decode($result->getBody()->__toString());

            // Pega o objeto dentro do array.
            $bookmark = $arrayBookmark[0];

            return $this->render('BookmarkBundle:Bookmark:editar.html.twig', ['bookmark' => $bookmark]);
        }
    }

    /**
     * @Route("/deletar/{id}")
     */
    public function deletarAction(Request $request)
    {
        $id = $request->get('id');
        $this->client->request('DELETE', $this->uri, ['json' => ['id' => $id]]);

        return $this->redirect('/bookmark/listar');
    }

    /**
     * @Route("/buscar")
     */
    public function buscarAction()
    {
        return $this->render('BookmarkBundle:Bookmark:buscar.html.twig', array(
            // ...
        ));
    }

}
