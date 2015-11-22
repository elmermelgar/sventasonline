<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Producto;
use too\sistemadeventasBundle\Modals\TOOController;

class DefaultController extends TOOController
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
        $datos= $this->getDoctrine()->getRepository('toosistemadeventasBundle:Producto')->findBy(array('estado'=>1));
        return $this->render('toosistemadeventasBundle:Sistema:catalogo.html.twig',array('user'=>$user, 'datos'=>$datos));

    }


}
