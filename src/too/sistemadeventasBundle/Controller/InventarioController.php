<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use too\sistemadeventasBundle\Entity\Inventario;
use too\sistemadeventasBundle\Entity\Producto;
use too\sistemadeventasBundle\Modals\TOOController;

class InventarioController extends TOOController
{

    public function inventarioAction( Request $request)
    {
        $user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if($validado){
            $inventario=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Inventario')->findAll();
            return $this->render('toosistemadeventasBundle:Admin:inventario.html.twig',array('user'=>$user,'inventario'=>$inventario));
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
                if($em->getRepository('toosistemadeventasBundle:Producto')->findOneBy(array('idProducto'=>$id)))
                {
                    $consulta=$em->getRepository('toosistemadeventasBundle:Inventario')->findOneBy(array('idProducto'=>$datos->getIdProducto()));
                    //$prod=$em->getRepository('toosistemadeventasBundle:Producto')->find($consulta->getIdProducto()->getIdProducto());
                   if(($request->get('disponible'))>=$consulta->getCantidadInicial()){

                       $inicial=($consulta->getCantidadDisponible())*($consulta->getCostoPromedio());
                       $prueba=($inicial)/($consulta->getCostoPromedio());
                       $cargar=$request->get('disponible');
                       $disp=($prueba+$cargar);
                       $nueva=($request->get('disponible'))*($request->get('costo'));
                       $final=($inicial+$nueva)/($disp);

                       $inv=$consulta;
                       //$inv->setNombreproducto($request->get('nomProd'));
                       $inv->setCantidadDisponible($disp);
                       $inv->setCostoPromedio($final);
                       //$prod->setCantidadProd($disp);
                       $em->flush();

                       $this->MensajeFlash('exito', 'Inventario Actualizado Correctamente!');

                       return $this->redirect($this->generateUrl('inventario'));
                   }
                    else{

                        $this->MensajeFlash('credencial', 'No puede introducir cantidades menores al valor minimo del inventario');
                        return $this->render('toosistemadeventasBundle:Admin:nuevoInventario.html.twig',array('user'=>$user,'datos'=>$datos));
                    }



                }
                else {
                    $this->MensajeFlash('credencial','El Producto ya ha sido actualizado!');
                    return $this->redirect($this->generateUrl('inicioAdmin'));
                }

            }
            return $this->render('toosistemadeventasBundle:Admin:nuevoInventario.html.twig',array('user'=>$user,'datos'=>$datos));
        }
    }
    public function verificarAction($id, Request $request)
    {
        //$user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if($validado){
            $inventario=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Inventario')->find($id);
            if($inventario->getCantidadDisponible()<= $inventario->getCantidadInicial()){
                $this->MensajeFlash('notificacionfall','El inventario de este producto ha llegado a su limite!');
            }
            else{
                $this->MensajeFlash('notificacion', $inventario->getCantidadDisponible());
            }
            return $this->redirect($this->generateUrl('inventario'));
        }
        else
            return $this->redirect($this->generateUrl('inicioAdmin'));
    }

}
