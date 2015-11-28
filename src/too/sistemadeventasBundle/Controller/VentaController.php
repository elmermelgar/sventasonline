<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use too\sistemadeventasBundle\Entity\Carrito;
use too\sistemadeventasBundle\Entity\Compra;
use too\sistemadeventasBundle\Entity\Venta;
use too\sistemadeventasBundle\Modals\TOOController;

class VentaController extends TOOController
{
    public function ventaAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        $em=$this->getDoctrine()->getManager();
        if($user){
                if($this->validarCaptital($em,$user,$request)){
                    //Regitro las  ventas y descargo de invetario
                    $this->registrarVentas($em,$user,$request);
                    $this->MensajeFlash('exito','Su compra se proceso exitosamente!');
                    return $this->redirect($this->generateUrl('compras'));
                    //return new Response();
                }
                else{
                    $this->MensajeFlash('credencial','Su dinero no alzanza para comprar estos productos!');
                    return $this->redirect($this->generateUrl('carrito'));
                }
        }
        else
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
    }
    public function clienteAction(Request $request){
        $user=$this->enviarSesion($request);
        $em=$this->getDoctrine()->getManager();
        $this->registrarVentas($em,$user,$request);
        //$fecha=new \DateTime("now");
        //$fecha=$fecha->format("Y-m-d");
        $cc=new Carrito();
        return new response("");
    }
    public function comprasAction(Request $request){
        $user=$this->enviarSesion($request);
        $validado=$this->validarUsuario($request);
        if($validado){
            $cliente=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Cliente')->find($request->getSession()->get('login')->getIdCliente());
            $compras=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Venta')->findBy(array('idCliente'=>$cliente));
            return $this->render('toosistemadeventasBundle:Sistema:compras.html.twig',array('user'=>$user,'ventas'=>$compras));
        }
        else
            return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
    }
    public  function vendidosAction(Request $request){
        $user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if($validado){
            $ventas=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Venta')->findAll();
            return $this->render('toosistemadeventasBundle:Admin:ventas.html.twig',array('user'=>$user,'ventas'=>$ventas));
        }
        else
            return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
    }
    public  function devolucionesAction(Request $request){
        $user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if($validado){
            $devoluciones=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Devolucion')->findAll();
            return $this->render('toosistemadeventasBundle:Admin:devoluciones.html.twig',array('user'=>$user,'devoluciones'=>$devoluciones));
        }
        else
            return $this->render('toosistemadeventasBundle:Admin:index.html.twig',array('user'=>$user));
    }
}
