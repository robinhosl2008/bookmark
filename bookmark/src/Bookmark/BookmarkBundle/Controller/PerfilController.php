<?php

namespace Bookmark\BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        // Inicia o Curl.
        $ch = curl_init();

        // Informa a URL e outras informações ao Curl.
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8001/perfil");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $perfis = json_decode($result);

        return $this->render('BookmarkBundle:Perfil:listar.html.twig', array('perfis' => $perfis));
    }

    /**
     * @Route("/cadastrar")
     */
    public function cadastrarAction(Request $request)
    {
        $array = "";

        if($request->get("noPerfil") != ""){
            $noPerfil = $request->get("noPerfil");

            $array = [
                "id" => "",
                "noPerfil" => $noPerfil,
            ];

            $json = json_encode($array);

            // Inicia o Curl.
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "http://localhost:8001/perfil");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

            $mensagem = curl_exec($ch);

            curl_close($ch);

            return $this->redirect('/perfil/listar');
        }




            return $this->render('BookmarkBundle:Perfil:cadastar.html.twig', array());
    }

    /**
     * @Route("/editar")
     */
    public function editarAction()
    {
        return $this->render('BookmarkBundle:Perfil:editar.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deletar")
     */
    public function deletarAction()
    {
        return $this->render('BookmarkBundle:Perfil:deletar.html.twig', array(
            // ...
        ));
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
