<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $usuario->setSaldo($usuario->getSaldo()+$venta->getTotal());
        $inv->setCantidadDisponible($inv->getCantidadDisponible()+$venta->getCantidad());
        $em->remove($venta);
        $em->flush();

        return $this->redirect($this->generateUrl('compras'));
    }
}
