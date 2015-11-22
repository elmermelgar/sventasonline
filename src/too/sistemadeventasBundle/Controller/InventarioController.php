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
    public function agregarInventarioAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $validado=$this->validarAcceso($request);
        $user=$this->enviarSesion($request);
        $datos=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Producto')
            ->find($id);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){
                //Verificar error de archivo


                if($em->getRepository('toosistemadeventasBundle:Producto')->findOneBy(array('idProducto'=>$id)))
                {
                    $inv=new Inventario();

                    $inv->setIdProducto($request->get('idProd'));
                    //$inv->setNombreproducto($request->get('nomProd'));
                    $inv->setCantidadDisponible($request->get('disponible'));
                    $inv->setCantidadInicial($request->get('minimo'));

                    $em->persist($inv);
                    $em->flush();

                    $this->MensajeFlash('exito', 'Inventario Creado Correctamente!');

                    return $this->redirect($this->generateUrl('inventario'));


                }
                else {
                    $this->MensajeFlash('credencial','El Producto ya ha sido registrado!');
                    return $this->redirect($this->generateUrl('inicioAdmin'));
                }

            }
            return $this->render('toosistemadeventasBundle:Admin:nuevoInventario.html.twig',array('user'=>$user,'datos'=>$datos));
        }
    }
}
