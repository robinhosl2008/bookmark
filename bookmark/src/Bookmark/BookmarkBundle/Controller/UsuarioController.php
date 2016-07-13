<?php

namespace Bookmark\BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bookmark\BookmarkBundle\Controller\DefaultController;
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
    public $defaultCtrl = '';

    public function __construct(){
        $this->uri = 'http://localhost:8000/usuario';
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

        $client = new Client();
        $result = $client->get($this->uri);
        $usuarios = json_decode($result->getBody()->__toString());

        return $this->render('BookmarkBundle:Usuario:listar.html.twig', [
            'sessionId' => $session['sessionId'],
            'sessionRole' => $session['sessionRole'],
            'sessionNome' => $session['sessionNome'],
            'sessionSobrenome' => $session['sessionSobrenome'],
            'usuarios' => $usuarios
        ]);
    }

    /**
     * @Route("/cadastrar")
     */
    public function cadastrarAction(Request $request)
    {
        //if(empty($_SESSION['usuarioID'])){
        //return $this->redirect('/');
        //}else{
        //$session = $this->defaultCtrl->protegePagina();
        //}

        if($_POST){
            $role = $request->get('role');
            $status = 1;
            $nome = $request->get('nome');
            $sobrenome = $request->get('sobrenome');
            $email     = $request->get('email');
            $username    = $request->get('username');
            $password  = md5($request->get('password'));

            $client = new Client();
            $result = $client->request('POST', $this->uri , [
                'json' => [
                    'id' => '',
                     'role' => $role,
                    'status' => $status,
                     'nome' => $nome,
                     'sobrenome' => $sobrenome,
                     'email' => $email,
                     'username' => $username,
                     'password' => $password,
                    'createdAt' => '',
                    'updatedAt' => '',
                ]
            ]);

            return $this->redirect('/login');
        }else{

            return $this->render('BookmarkBundle:Usuario:cadastrar.html.twig', [
                'sessionId' => '',
                'sessionRole' => ''
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
            $id = $request->get('id');
            if($session['sessionId'] == $id) {
                $nome = $request->get('nome');
                $sobrenome = $request->get('sobrenome');
                $email = $request->get('email');
                $role = $request->get('role');
                $username = $request->get('username');
            }else{
                $client = new Client();
                $result = $client->request('GET', $this->uri.'/'.$id);
                $usuario = json_decode($result->getBody()->__toString());

                $nome = $usuario[0]->nome;
                $sobrenome = $usuario[0]->sobrenome;
                $email = $usuario[0]->email;
                $role = $request->get('role');
                $username = $usuario[0]->username;
            }

            $client = new Client();
            $result = $client->request('PUT', $this->uri , [
                'json' => [
                    'id' => $id,
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'email' => $email,
                    'role' => $role,
                    'username' => $username
                ]
            ]);

            if($session['sessionRole'] == 'ROLE_ADMIN') {
                return $this->redirect('/usuario/listar');
            }else{
                return $this->redirect('/bookmark/listar');
            }
        }else {
            $id = $request->get('id');

            // Instancia o cliente Guzzle.
            $client = new Client();

            // Envia a requisição para a API e atribui o resultado a uma variável.
            $result = $client->get("http://localhost:8000/usuario/$id");

            // Converte o Json vindo da API em array.
            $arrayUsuario = json_decode($result->getBody()->__toString());

            // Pega o objeto dentro do array.
            $usuario = $arrayUsuario[0];
            $usuario->createdAt = date('d/m/y H:i:s', strtotime($arrayUsuario[0]->createdAt->date));
            $usuario->updatedAt = date('d/m/y H:i:s', strtotime($arrayUsuario[0]->updatedAt->date));

            return $this->render('BookmarkBundle:Usuario:editar.html.twig', [
                'sessionId' => $session['sessionId'],
                'sessionRole' => $session['sessionRole'],
                'sessionNome' => $session['sessionNome'],
                'sessionSobrenome' => $session['sessionSobrenome'],
                'usuario' => $usuario,
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

        $client = new Client();
        $result = $client->request('DELETE', $this->uri, ['json' => ['id' => $id]]);

        return $this->redirect('/usuario/listar');
    }

    public function validaUsuario($username, $password)
    {
        $client = new Client();
        $result = $client->request('POST', 'http://localhost:8000/usuario/check-login', [
            'json' => [
                'id'       => "",
                'role'       => "",
                'status'       => "",
                'nome'       => "",
                'sobrenome'       => "",
                'email'       => "",
                'username' => $username,
                'password' => $password,
                'createdAt' => "",
                'updatedAt' => "",
            ]
        ]);

        return json_decode($result->getBody()->__toArray());
    }
}
