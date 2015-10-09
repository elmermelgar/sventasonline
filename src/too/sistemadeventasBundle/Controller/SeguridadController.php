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
        if($request->isMethod("POST")){

            $usuario=new Usuario();
            $usuario->setApellidoUsu($request->get('apellido'));
            $usuario->setNombreUsu($request->get('nombre'));
            $usuario->setCorreo($request->get('email'));
            $usuario->setPassword($request->get('pass'));
            $usuario->setRol(1);
            $usuario->setUsuario($request->get('usuario'));

            $em->persist($usuario);
            $em->flush();

            return $this->redirect($this->generateUrl('prueva'));
        }

        return $this->render('@toosistemadeventas/Sistema/registro.html.twig');
    }
}
