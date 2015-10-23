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
                    $this->MensajeFlash('Usuario y correo ya existe!');
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
                    $this->MensajeFlash2('Usuario creado correctamente!');
                }


                return $this->redirect($this->generateUrl('toosistemadeventas_registro'));

            }
            return $this->render('@toosistemadeventas/Sistema/registro.html.twig',array('user'=>$user));
        }
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
    private function MensajeFlash2($m){
        $this->get('session')->getFlashBag()->add(
            'exito',
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
