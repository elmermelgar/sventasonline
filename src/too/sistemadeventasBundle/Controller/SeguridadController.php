<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Usuario;

class SeguridadController extends Controller
{
    public function registroAction(Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        //Obtener la sesion
        $user=$this->enviarSesion($request);
        if($user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('usuario'),$request->get('email')))
                {
                    $this->MensajeFlash('Usuario/Correo Duplicado');
                    return $this->redirect($this->generateUrl('toosistemadeventas_registro'));
                }
                else
                {
                    $usuario = new Usuario();
                    $usuario->setApellidoUsu($request->get('apellido'));
                    $usuario->setNombreUsu($request->get('nombre'));
                    $usuario->setCorreo($request->get('email'));
                    $usuario->setPassword($request->get('pass'));
                    $usuario->setRol(1);
                    $usuario->setUsuario($request->get('usuario'));

                    $em->persist($usuario);
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
            }
            return $this->render('@toosistemadeventas/Sistema/registro.html.twig',array('user'=>$user));
        }
    }
    public function ferAction(Request $request){

            if($request->isMethod("POST"))
            {
                if ($_FILES["archivo"]["error"] > 0)

                {
                    return new Response('Error de Archivo');
                }//Validando subida

                else

                {
                    move_uploaded_file($_FILES["archivo"]['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/sventas/web/images/".$_FILES["archivo"]['name']);
                    $nombreArchivo = $_FILES["archivo"]['name'];
                    return new Response('Archivo '.$nombreArchivo);
                }
            }
            else
                return $this->render('toosistemadeventasBundle::file.html.twig',array('user'=>''));

    }
    private function loginAction($user,$email){
        $em=$this->getDoctrine()->getManager();
        $encontrado=$em->getRepository('toosistemadeventasBundle:Usuario')->findOneBy(array('usuario'=>$user,'correo'=>$email));
        return $encontrado;
    }
    private function MensajeFlash($m){
        $this->get('session')->getFlashBag()->add(
            'credencial',
            ''.$m
        );
    }
    private function enviarSesion($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            return $login->getUsername();
        }
    }
}
