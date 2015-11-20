<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use too\sistemadeventasBundle\Entity\Inventario;
use too\sistemadeventasBundle\Modals\TOOController;

class InventarioController extends TOOController
{
    public function inventarioAction( Request $request)
    {
        $user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if($validado){
            $productos=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Producto')->findAll();
            return $this->render('toosistemadeventasBundle:Admin:inventario.html.twig',array('user'=>$user,'productos'=>$productos));
        }
        else
            return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
    }
    public function agregarInventarioAction(Request $request)
    {
       $em=$this->getDoctrine()->getManager();
        if($request->isMethod("POST"))
        {
            $inv=new Inventario();
            $inv->setIdProducto(2);
            $inv->setCantidadDisponible($inv->getCantidadDisponible()+5);
            $em->flush();


        }
        return $this->render('@toosistemadeventas/cargar.html.twig');

    }
}
