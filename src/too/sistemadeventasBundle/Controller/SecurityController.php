<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;
use too\sistemadeventasBundle\Modals\Login;

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
            //Cerrando Sesion anterior si hay una nueva
            $session=$request->getSession();
            $session->clear();
            //Parametrisacion
            $user=$request->get("_username");
            $pass=$request->get("_password");
            $usuario=$em->getRepository('toosistemadeventasBundle:Usuario')->findOneBy(array('usuario'=>$user,'password'=>$pass));
            if($usuario){
                //Creando la session
                $login=new Login();
                $login->setUsername($user);
                $login->setPassword($pass);
                $session->set('login',$login);
                return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
                //return $this->redirect($this->generateUrl('prueba'));
            }
            else{
                $this->MensajeFlash('Credenciales incorrectas!');
                return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
                //return new Response('Credenciales incorrectas');
            }
        }
        else{
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
    }

    public function logoutAction(Request $request){
        $session=$request->getSession();
        $session->clear();
        return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
    }
    private function MensajeFlash($m){
        $this->get('session')->getFlashBag()->add(
            'mensaje',
            ''.$m
        );
    }
}
