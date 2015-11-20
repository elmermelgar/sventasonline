<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Carrito;
use too\sistemadeventasBundle\Entity\Categoria;
use too\sistemadeventasBundle\Entity\Producto;
use too\sistemadeventasBundle\Entity\Usuario;
use too\sistemadeventasBundle\Modals\TOOController;

class CarritoController extends TOOController
{
    public function insertarAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $validado=$this->validarUsuario($request);
        $user=$this->enviarSesion($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            $producto=$em->getRepository('toosistemadeventasBundle:Producto')->find($id);
            $car=new Carrito();
            $car->setIdProduct($producto->getIdProducto());
            $car->setIdUsu($user);
            $car->setProducto($producto->getNombreProd());

            $em->persist($car);
            $em->flush();
            return $this->redirect($this->generateUrl('carrito'));
        }
    }
    public function carritoAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->enviarSesion($request);
        $carrito=$em->getRepository('toosistemadeventasBundle:Carrito')->findAll();
        return $this->render('toosistemadeventasBundle:Sistema:carrito.html.twig',array('user'=>$user, 'carrito'=>$carrito));
    }
    public function editCarritoAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod("POST"))
        {
            $cant=$request->get("cantidad_P");
            $idcar=$request->get("id_car");
            $car=$em->getRepository('toosistemadeventasBundle:Carrito')->find($idcar);
            $car->setCantidad($cant);
            $em->flush();
            return $this->redirect($this->generateUrl('carrito'));
            //return new Response($idcar.'    '.$cant);

        }

    }

}
