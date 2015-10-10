<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        /*$session = $request->getSession();

        if($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)){
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);

        }else{
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }
        return $this->render('toosistemadeventasBundle:Default:index.html.twig',
            array('last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
                  'error'         => $error));*/
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $user=$request->get("_username");
            $pass=$request->get("_password");
            $usuario=$em->getRepository('toosistemadeventasBundle:Usuario')->findOneBy(array('usuario'=>$user,'password'=>$pass));
            if($usuario){
                //return $this->redirect($this->generateUrl('toosistemadeventas_inicio',array('log' =>$usuario)));
                return new Response('Eres Bienvenido '.$user);
            }
            else{
                return new Response('No entre :/ ');
            }
        }
    }
}
