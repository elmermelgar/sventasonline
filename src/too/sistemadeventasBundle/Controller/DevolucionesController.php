<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Devolucion;
use too\sistemadeventasBundle\Modals\TOOController;

class DevolucionesController extends TOOController
{
    public function devolucionAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();

        //$cliente=$em->getRepository('toosistemadeventasBundle:Cliente')->find($request->getSession()->get('login')->getIdCliente());
        $usuario=$em->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $venta=$em->getRepository('toosistemadeventasBundle:Venta')->find($id);
        $inv=$em->getRepository('toosistemadeventasBundle:Inventario')->findOneBy(array('idProducto'=>$venta->getIdProducto()->getIdProducto()));
        $devolucion=new Devolucion();
        //Devuelvo el monto de la compra al cliente
        $usuario->setSaldo($usuario->getSaldo()+$venta->getTotal()*1.13);
        //Actualizo el inventario
        $inv->setCantidadDisponible($inv->getCantidadDisponible()+$venta->getCantidad());
        //Actualizo lo venta a devurlta
        $venta->setDevuelto(1);
        //Guarda la venta en Devoluciones
        $devolucion->setIdVenta($venta);
        $devolucion->setFechaDev(new \DateTime('now'));
        $em->persist($devolucion);
        $em->flush();
        return $this->redirect($this->generateUrl('compras'));
    }
}
