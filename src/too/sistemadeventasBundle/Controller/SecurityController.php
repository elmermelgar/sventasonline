<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use too\sistemadeventasBundle\Modals\Login;
use too\sistemadeventasBundle\Modals\TOOController;

class SecurityController extends TOOController
{
    public function loginAction(Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();

        if($request->isMethod("POST")){
            //Cerrando Sesion anterior si hay una nueva
            $session=$request->getSession();
            $session->clear();
            //Parametrizacion
            $user=$request->get("_username");
            $pass=$request->get("_password");
            $usuario=$em->getRepository('toosistemadeventasBundle:Usuario')->findOneBy(array('usuario'=>$user,'password'=>$pass));
            if($usuario){
                //Creando la session
                $login=new Login();
                $login->setUsername($user);
                $login->setPassword($pass);

                $session->set('login',$login);
                $session->set('usuario', $usuario->getUsuario());

                if($usuario->getRol()==2){
                    return $this->render('toosistemadeventasBundle:Admin:index.html.twig',array('user'=>$user));
                }
                else{
                    return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
                }

                //return $this->redirect($this->generateUrl('prueba'));
            }
            else{
                $this->MensajeFlash('mensaje','Credenciales incorrectas!');
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
}
