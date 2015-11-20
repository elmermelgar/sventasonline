<?php

namespace too\sistemadeventasBundle\Controller;
use too\sistemadeventasBundle\Modals\TOOController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Categoria;

class CategoriaController extends TOOController
{
    public function crudCatAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $em=$this->getDoctrine()->getManager();
        $cat=$em->getRepository('toosistemadeventasBundle:Categoria')->findAll();
        return $this->render('toosistemadeventasBundle:Categoria:crudCategoria.html.twig', array('cat' => $cat, 'user' =>$user));
    }

    public function editarCatAction($idCat, Request $request)
    {
        $validado=$this->validarAcceso($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $user=$this->enviarSesion($request);
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $datos=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Categoria')->find($idCat);
        if(!$datos)
        {
            throw $this->createNotFoundException('No existe la categoria con el ID'.$idCat);
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('nombre')))
                {
                    $this->MensajeFlash('fracaso','Nombre de la categoria ya existe');
                    /*return $this->redirect($this->generateUrl('nuevoCat'));*/
                }
                else
                {
                    $datos->setNombreCat($request->get('nombre'));
                    $datos->setDescripcionCat($request->get('descripcion'));

                    //$em->persist($usuario);
                    // $em->refresh($usuario);
                    $em->flush();
                    $this->MensajeFlash('exito','Categoria actualizada correctamente!');
                }
                return $this->redirect($this->generateUrl('crudCat'));
            }
            return $this->render('toosistemadeventasBundle:Categoria:editarCategoria.html.twig',array('user'=>$user,'datos'=>$datos));
        }

    }

    public  function deleteCatAction($idCat, Request $request)
    {
        $validado=$this->validarAcceso($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $em=$this->getDoctrine()->getManager();
        $cat=$em->getRepository('toosistemadeventasBundle:Categoria')->find($idCat);
        if(!$cat){
            throw $this->createNotFoundException('No existe el usuario con el ID'.$idCat);
        }
        $em->remove($cat);
        $em->flush();
        $this->MensajeFlash('exito','Eliminado correctamente');
        $cate=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Categoria')->findBy(array());
        return $this->render('toosistemadeventasBundle:Categoria:crudCategoria.html.twig', array('cat' => $cate, 'user' =>''));
    }

    public function nuevaCatAction(Request $request)
    {
        $validado=$this->validarAcceso($request);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $user=$this->enviarSesion($request);
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('nombre')))
                {
                    $this->MensajeFlash('fracaso','Nombre de categoria ya existe!');
                    return $this->redirect($this->generateUrl('nuevaCat'));
                }
                else
                {
                    $cat = new Categoria();
                    $cat->setNombreCat($request->get('nombre'));
                    $cat->setDescripcionCat($request->get('descripcion'));
                    $em->persist($cat);
                    $em->flush();
                    $this->MensajeFlash('exito','Categoria creada correctamente!');
                }
               return $this->redirect($this->generateUrl('crudCat'));
            }
            return $this->render('@toosistemadeventas/Categoria/nuevaCategoria.html.twig',array('user'=>$user));
        }
    }

    private function loginAction($user){
        $em=$this->getDoctrine()->getManager();
        $encontrado=$em->getRepository('toosistemadeventasBundle:Categoria')->findOneBy(array('nombreCat'=>$user));
        return $encontrado;
    }

}
