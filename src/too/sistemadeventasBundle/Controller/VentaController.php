<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
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
                    $this->registrarVentas($em,$user);
                    return $this->redirect($this->generateUrl('catalogo'));
                }
                else
                    return new Response('Te falta $$');
        }
        else
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
    }
    private function registrarVentas($em,$user){
        $pCarrito=$em->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu'=>$user));
        //Recorro cada item del carrito del cliente
        foreach($pCarrito as $pcar){
            //Creo los obejetos de tipo venta
            $prodV=new Venta();
            $prodV->setIdCliente($em->getRepository('toosistemadeventasBundle:Cliente')->find(2));
            $prodV->setIdProducto($em->getRepository('toosistemadeventasBundle:Producto')->find($pcar->getIdProduct()));
            $prodV->setTotal($pcar->getTotal());
            $prodV->setCantidad($pcar->getCantidad());
            $prodV->setFechaVen(new \DateTime("now"));
            //Obtengo el objeto de inventario que descargo del inventario
            $inv=$em->getRepository('toosistemadeventasBundle:Inventario')->findOneBy(array('idProducto'=>$prodV->getIdProducto()));
            $inv->setCantidadDisponible($inv->getCantidadDisponible()-$pcar->getCantidad());
            //Persisto las ventas
            $em->persist($prodV);
            //remuevo del carrito los prod q ya registre en la venta
            $em->remove($pcar);
            //Guardo los cambios en inventario
            $em->flush();
        }
    }
    public  function  validarCaptital($em,$user,$request){
        $tot=$em->getRepository('toosistemadeventasBundle:Carrito')->getTotal($user);
        $us=$em->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        //Obtengo el cliente
        //$cliente=$em->getRepository('toosistemadeventasBundle:Cliente')->findOneBy(array('idUsuario'=>$id->getIdUsuario()));
        if($us->getSaldo()>$tot[1])
        {
                $us->setSaldo($us->getSaldo()-$tot[1]);
                $em->flush();
                return true;
        }
        else
            return false;
    }
}
