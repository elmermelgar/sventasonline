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
    public function carritoAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $validado=$this->validarUsuario($request);
        $sum=$em->getRepository('toosistemadeventasBundle:Carrito')->getTotal($this->enviarSesion($request));
        $user=$this->enviarSesion($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else {
            $carrito = $em->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu' => $this->enviarSesion($request)));
            return $this->render('toosistemadeventasBundle:Sistema:carrito.html.twig',array('user'=>$user, 'carrito'=>$carrito,'total'=>$sum[1]));
        }

    }
    public function insertarAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $validado=$this->validarUsuario($request);
        $user=$this->enviarSesion($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            $idcar=$em->getRepository('toosistemadeventasBundle:Carrito')->findOneBy(array('idProduct'=>$id,'idUsu'=>$user));
            if($idcar)
            {
                $idcar->setCantidad($idcar->getCantidad()+1);
                $idcar->setTotal($idcar->getCantidad()*$idcar->getPrecio());
                $em->flush();
                return $this->redirect($this->generateUrl('carrito'));
            }
            else{
                $producto=$em->getRepository('toosistemadeventasBundle:Producto')->find($id);
                $car=new Carrito();
                $car->setIdProduct($producto->getIdProducto());
                $car->setIdUsu($user);
                $car->setProducto($producto->getNombreProd());
                $car->setPrecio($producto->getPrecioUnitario());
                $car->setCantidad(1);
                $car->setTotal($producto->getPrecioUnitario());

                $em->persist($car);
                $em->flush();
                return $this->redirect($this->generateUrl('carrito'));
            }
        }
    }
    public function editCarritoAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod("POST"))
        {
            $cant=$request->get("cantidad_P");
            $idcar=$request->get("id_car");
            $car=$em->getRepository('toosistemadeventasBundle:Carrito')->find($idcar);
            $car->setCantidad($cant);
            $car->setTotal($car->getPrecio()*$cant);
            $em->flush();
            return $this->redirect($this->generateUrl('carrito'));
        }

    }
    public function deleteCarritoAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $validado=$this->validarUsuario($request);
        $user=$this->enviarSesion($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else {
            $producto=$em->getRepository('toosistemadeventasBundle:Carrito')->find($id);
            if(!$producto){
                throw $this->createNotFoundException('No existe el productoo con el ID'.$id);
            }
            $em->remove($producto);
            $em->flush();
            $carrito = $em->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu' => $this->enviarSesion($request)));
            return $this->redirect($this->generateUrl('carrito'));
            // return $this->render('toosistemadeventasBundle:Sistema:carrito.html.twig', array('user' => $user, 'carrito' => $carrito));
        }
    }

}
