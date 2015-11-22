<?php

namespace too\sistemadeventasBundle\Controller;

use Buzz\Message\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use too\sistemadeventasBundle\Modals\TOOController;

class ReporteController extends TOOController
{
    public function pdfAction(Request $request){
        $user=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $hora=date("Y-m-d",time());
        $car=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu'=>$this->enviarSesion($request)));
        $total=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Carrito')->getTotal($request->getSession()->get('login')->getUsername());
        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoporniveles.pdf');
        return $pdfGenerator->displayForView('toosistemadeventasBundle::pdf.html.twig',array('car'=>$car,'total'=>$total[1],'hora'=>$hora,'user'=>$user));
        //return $this->render('toosistemadeventasBundle::pdf.html.twig',array('car'=>$car,'total'=>$total[1],'hora'=>$hora,'user'=>$user));
    }
    public function facturaAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $user=$this->enviarSesion($request);
        if($this->validarCaptital($em,$user,$request)){
            $hora=date("Y-m-d",time());
            $car=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu'=>$this->enviarSesion($request)));
            $total=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Carrito')->getTotal($request->getSession()->get('login')->getUsername());
            return $this->render('toosistemadeventasBundle:Sistema:factura.html.twig',array('car'=>$car,'total'=>$total[1],'hora'=>$hora, 'user'=>$user));
        }
        else{
            $this->MensajeFlash('credencial','Su dinero no alzanza para comprar estos productos!');
            return $this->redirect($this->generateUrl('carrito'));
        }
    }
}
