<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductosController extends Controller
{
    public function productosAction( Request $request)
    {
        $user=$this->enviarSesion($request);
        return $this->render('toosistemadeventasBundle:Admin:productos.html.twig',array('user'=>$user));
    }

    private function enviarSesion($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            return $login->getUsername();
        }
    }
}
