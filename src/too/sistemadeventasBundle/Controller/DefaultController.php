<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('toosistemadeventasBundle:Default:index.html.twig', array('name' => $name));
    }

    public function inicioAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
    }

    public function promocionesAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        return $this->render('toosistemadeventasBundle:Sistema:promociones.html.twig',array('user'=>$user));
    }

    public function catalogoAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        return $this->render('toosistemadeventasBundle:Sistema:catalogo.html.twig',array('user'=>$user));
    }
    private function enviarSesion($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            return $login->getUsername();
        }
    }
}
