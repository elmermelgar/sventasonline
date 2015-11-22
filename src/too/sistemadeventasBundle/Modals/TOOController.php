<?php
/**
 * Created by PhpStorm.
 * User: Fernando Bolaños
 * Date: 25/10/2015
 * Time: 09:07 AM
 */

namespace too\sistemadeventasBundle\Modals;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TOOController extends Controller
{
    //Para envio de mensajes Flash
    protected function MensajeFlash($nombre,$mensaje){
        $this->get('session')->getFlashBag()->add(
            ''.$nombre,
            ''.$mensaje
        );
    }
    //Para envio de Sesiones
    protected function enviarSesion($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            return $login->getUsername();
        }
    }
    //Validar Acceso
    protected function validarAcceso($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            if($login->getRol()==2)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    protected function validarUsuario($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            if($login->getRol()==1)
                return true;
            else
                return false;
        }
        else
            return false;
    }
    //Para determinar el tipo de archivo subido
    protected function infoTipoImagen($archivo){
        $tipo=explode('/', $_FILES["".$archivo]["type"]);
        $tipo[1]='.'.$tipo[1];
        return $tipo;
    }
    //Para subir la imagen al servidor
    protected function subirImagen($archivo,$nombreImagen){
        move_uploaded_file($_FILES["".$archivo]['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/svenweb/images/".$nombreImagen);
    }
    //Validacion de Registro o duplicado
    protected function validarRegistro($user,$email){
        $em=$this->getDoctrine()->getManager();
        //Nuevo metodo  DQL =D
        $encontrado=$em->getRepository('toosistemadeventasBundle:Usuario')->validarUser($user,$email);
        //$encontrado=$em->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('usuario' => $user));
        return $encontrado;
    }
}