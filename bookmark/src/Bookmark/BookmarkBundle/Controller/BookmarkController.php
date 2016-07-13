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
    public $defaultCtrl = '';

    public function __construct(){
        $this->uri = "http://localhost:8000/bookmark";
        $this->client = new Client();
        $this->defaultCtrl = new DefaultController();
    }

    /**
     * @Route("/listar")
     */
    public function listarAction()
    {
        if(empty($_SESSION['usuarioID'])){
            return $this->redirect('/');
        }else{
            $session = $this->defaultCtrl->protegePagina();
        }

        if($_SESSION['usuarioRole'] == 'ROLE_ADMIN') {
            // Retorna a listagem de bookmarks da API.
            $result = $this->client->get($this->uri);
        }else{
            $result = $this->client->get($this->uri."/buscar/".$_SESSION['usuarioID']);
        }

        // Converte o json em objeto.
        $bookmarks = json_decode($result->getBody()->__toString());
        //echo "<pre>"; print_r($bookmarks[0]->usuario); exit;
        //echo "<pre>"; print_r($session['sessionId']); exit;
        return $this->render('BookmarkBundle:Bookmark:listar.html.twig', [
            'sessionId' => $session['sessionId'],
            'sessionRole' => $session['sessionRole'],
            'sessionNome' => $session['sessionNome'],
            'sessionSobrenome' => $session['sessionSobrenome'],
            'bookmarks' => $bookmarks
        ]);
    }

    /**
     * @Route("/cadastrar")
     */
    public function cadastrarAction(Request $request)
    {
        if(empty($_SESSION['usuarioID'])){
            return $this->redirect('/');
        }else{
            $session = $this->defaultCtrl->protegePagina();
        }

        if($_POST){
            $noBookmark = $request->get('noBookmark');

            $result = $this->client->request('POST', $this->uri, [
                'json' => [
                    'id'         => '',
                    'noBookmark' => $noBookmark,
                    'usuario'    => $_SESSION['usuarioID'],
                    'createdAt'    => '',
                    'updatedAt'    => ''
                ]
            ]);

            if($session['sessionRole'] == 'ROLE_ADMIN') {
                return $this->redirect('/usuario/listar');
            }elseif($session['sessionRole'] == 'ROLE_USER'){
                return $this->redirect('/bookmark/listar');
            }
        }else{
            return $this->render('BookmarkBundle:Bookmark:cadastrar.html.twig', [
                'sessionId' => $session['sessionId'],
                'sessionRole' => $session['sessionRole'],
                'sessionNome' => $session['sessionNome'],
                'sessionSobrenome' => $session['sessionSobrenome'],
            ]);
        }
    }

    /**
     * @Route("/editar/{id}")
     */
    public function editarAction(Request $request)
    {
        if(empty($_SESSION['usuarioID'])){
            return $this->redirect('/');
        }else{
            $session = $this->defaultCtrl->protegePagina();
        }

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
            $result = $this->client->request('GET', $this->uri.'/'.$id, array());

            // Converte a string json em array.
            $arrayBookmark = json_decode($result->getBody()->__toString());

            // Pega o objeto dentro do array.
            $bookmark = $arrayBookmark[0];

            return $this->render('BookmarkBundle:Bookmark:editar.html.twig', [
                'sessionId' => $session['sessionId'],
                'sessionRole' => $session['sessionRole'],
                'sessionNome' => $session['sessionNome'],
                'sessionSobrenome' => $session['sessionSobrenome'],
                'bookmark' => $bookmark
            ]);
        }
    }

    /**
     * @Route("/deletar/{id}")
     */
    public function deletarAction(Request $request)
    {
        if(empty($_SESSION['usuarioID'])){
            return $this->redirect('/');
        }

        $id = $request->get('id');
        $this->client->request('DELETE', $this->uri, ['json' => ['id' => $id]]);

        return $this->redirect('/bookmark/listar');
    }

    /**
     * @Route("/buscar/{id}")
     */
    public function buscarAction(Request $request)
    {
        if(empty($_SESSION['usuarioID'])){
            return $this->redirect('/');
        }else{
            $session = $this->defaultCtrl->protegePagina();
        }

        $id = $request->get('id');

        $result = $this->client->request('GET', $this->uri.'/buscar/'.$id);

        $bookmarks = json_decode($result->getBody()->__toString());

        return $this->render('BookmarkBundle:Bookmark:listar.html.twig', [
            'sessionId' => $session['sessionId'],
            'sessionRole' => $session['sessionRole'],
            'sessionNome' => $session['sessionNome'],
            'sessionSobrenome' => $session['sessionSobrenome'],
            'bookmarks' => $bookmarks
        ]);
    }

}
