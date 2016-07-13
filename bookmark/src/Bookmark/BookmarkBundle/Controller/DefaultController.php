<?php

namespace Bookmark\BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Security;
use GuzzleHttp\Client;

/**
 * Class DefaultController
 * @package Bookmark\BookmarkBundle\Controller
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("")
     */
    public function indexAction()
    {
        if(empty($_SESSION['usuarioID'])){
            return $this->redirect('login');
        }else{
            $session = $this->protegePagina();
        }

        return $this->render('BookmarkBundle:Default:index.html.twig', [
            'sessionId' => $session['sessionId'],
            'sessionRole' => $session['sessionRole'],
            'sessionNome' => $session['sessionNome'],
            'sessionSobrenome' => $session['sessionSobrenome'],
        ]);
    }

    /**
     * @Route("login", name="login")
     */
    public function loginAction()
    {

        if(!empty($_SESSION['sessionRole'])) {
            $session = $this->protegePagina();
        }else{
            $session = [
                'sessionId' => '',
                'sessionRole' => ''
            ];
        }

        return $this->render('BookmarkBundle:Default:login.html.twig', [
            'tipoMensagem' => '',
            'mensagem' => '',
            'sessionId' => $session['sessionId'],
            'sessionRole' => $session['sessionRole'],
        ]);
    }

    /**
     * @Route("login-check")
     */
    public function loginCheckAction(Request $request)
    {
        if($_POST) {
            $username = $request->get('username');
            $password = md5($request->get('password'));

            $client = new Client();
            $result = $client->request('POST', 'http://localhost:8000/usuario/login-check', [
                'json' => [
                    'username' => $username,
                    'password' => $password
                ]
            ]);

            $usuario = json_decode($result->getBody()->__toString());

            if (!array_key_exists('tipoMensagem', $usuario) && !array_key_exists('mensagem', $usuario)) {

                if(isset($_SESSION)) {
                    session_destroy();
                }

                session_start();
                $_SESSION['usuarioID'] = $usuario->id;
                $_SESSION['usuarioNome'] = $usuario->nome;
                $_SESSION['usuarioSobrenome'] = $usuario->sobrenome;
                $_SESSION['usuarioLogin'] = $usuario->username;
                $_SESSION['usuarioSenha'] = $usuario->password;
                $_SESSION['usuarioRole'] = $usuario->role;

                //echo $_SESSION['usuarioID']; echo "<br />";
                //echo $_SESSION['usuarioNome']; echo "<br />";
                //echo $_SESSION['usuarioSobrenome']; echo "<br />";
                //echo $_SESSION['usuarioLogin']; echo "<br />";
                //echo $_SESSION['usuarioSenha']; echo "<br />";
                //echo $_SESSION['usuarioRole']; echo "<br />";
                //exit;

                return $this->redirect('/');
            } else {
                $session = [
                    'sessionId' => '',
                    'sessionRole' => ''
                ];

                return $this->render('BookmarkBundle:Default:login.html.twig', [
                    'tipoMensagem' => $usuario->tipoMensagem,
                    'mensagem' => $usuario->mensagem,
                    'sessionId' => '',
                    'sessionId' => $session['sessionId'],
                    'sessionRole' => $session['sessionRole'],
                ]);
            }
        }
    }

    public function validaUsuario($username = null, $password = null) {

        // Instancia um novo client do Guzzle
        $client = new Client();

        // Envia a requisição para a API juntamente com o login e senha do usuário
        $result = $client->request('POST', 'http://localhost:8000/usuario/login-check', [
            'json' => [
                'username' => $username,
                'password' => $password
            ]
        ]);

        // Atribui o resultado a uma variável
        $usuario = json_decode($result->getBody()->__toString());

        // Verifica se a variável não está vazia.
        if (isset($usuario)) {
            $_SESSION['usuarioID'] = $usuario->id;
            $_SESSION['usuarioNome'] = $usuario->nome;
            $_SESSION['usuarioSobrenome'] = $usuario->sobrenome;
            $_SESSION['usuarioLogin'] = $usuario->username;
            $_SESSION['usuarioSenha'] = $usuario->password;
            $_SESSION['usuarioRole'] = $usuario->role;

            return $this->redirect('/');
        } else {
            return $this->render('BookmarkBundle:Default:login.html.twig', array());
        }
    }

    public function protegePagina() {
        //if (empty($_SESSION['usuarioID']) OR empty($_SESSION['usuarioNome'])) {
        if (!array_key_exists('usuarioID' ,$_SESSION) AND !array_key_exists('usuarioNome' ,$_SESSION)) {

            // Não há usuário logado, manda pra página de login
            return $this->render('BookmarkBundle:Default:login.html.twig', array());
        } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {

            // Verifica se os dados salvos na sessão batem com os dados do banco de dados
            if (!$this->validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {

                // Os dados não batem, manda pra tela de login
                return $this->render('BookmarkBundle:Default:login.html.twig', array());
            }
        }

        $client = new Client();
        $result = $client->request('GET','http://localhost:8000/usuario/'.$_SESSION['usuarioID']);
        $usuario = json_decode($result->getBody()->__toString());

        $_SESSION['usuarioNome'] = $usuario[0]->nome;
        $_SESSION['usuarioSobrenome'] = $usuario[0]->sobrenome;

        return ['sessionId' => $_SESSION['usuarioID'], 'sessionRole' => $_SESSION['usuarioRole'],
            'sessionNome' => $_SESSION['usuarioNome'], 'sessionSobrenome' => $_SESSION['usuarioSobrenome']];
    }

    /**
     * @Route("sair")
     */
    public function sair() {

        // Remove as variáveis da sessão (caso elas existam)
        session_destroy();
        return $this->redirect('login');
    }
}
