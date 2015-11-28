<?php

namespace too\sistemadeventasBundle\Controller;

use Buzz\Message\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use too\sistemadeventasBundle\Modals\TOOController;
use too\sistemadeventasBundle\Entity\Inventario;

class ReporteController extends TOOController
{
    public function pdfAction(Request $request){
        $user=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $hora=date("Y-m-d",time());
        $car=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu'=>$this->enviarSesion($request)));
        $total=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Carrito')->getTotal($request->getSession()->get('login')->getUsername());
        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('factura-compra.pdf');
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
    public function reportesAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->enviarSesion($request);
        if($this->validarCaptital($em,$user,$request)) {
            return $this->render('toosistemadeventasBundle:Admin:reportes.html.twig', array('user'=>$user));
        }
    }
    public function reportesClientesAction(Request $request)
    {
        $user=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $usuarios=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>1));
        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoporniveles.pdf');

        return $pdfGenerator->displayForView('toosistemadeventasBundle:Admin:reporteClientes.html.twig',array('usuarios'=>$usuarios,'user'=>$user));
    }
    public function reporteExistenciasAction(Request $request)
    {
        $user=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $existencias=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Inventario')->findAll();

        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoporniveles.pdf');

        return $pdfGenerator->displayForView('toosistemadeventasBundle:Admin:reporteExistencias.html.twig',array('existencias'=>$existencias,'user'=>$user));
    }
    public  function reporteVentasAction(Request $request){
        $user=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $ventas=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Venta')->findAll();

        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoporniveles.pdf');

        return $pdfGenerator->displayForView('toosistemadeventasBundle:Admin:reporteVentas.html.twig',array('ventas'=>$ventas,'user'=>$user));
    }
}
