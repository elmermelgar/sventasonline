<?php
/**
 * Created by PhpStorm.
 * User: Fernando Bolaños
 * Date: 25/10/2015
 * Time: 09:07 AM
 */

namespace too\sistemadeventasBundle\Modals;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use too\sistemadeventasBundle\Entity\Venta;

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
        move_uploaded_file($_FILES["".$archivo]['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/sventas/web/images/".$nombreImagen);
    }
    //Validacion de Registro o duplicado
    protected function validarRegistro($user,$email){
        $em=$this->getDoctrine()->getManager();
        //Nuevo metodo  DQL =D
        $encontrado=$em->getRepository('toosistemadeventasBundle:Usuario')->validarUser($user,$email);
        //$encontrado=$em->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('usuario' => $user));
        return $encontrado;
    }
    //Registrar las ventas
    protected function registrarVentas($em,$user,$request){
        //Actualizando Saldo
        $this->actualizarSaldo($em,$user,$request);
        //obteniendo el clinte q solicita la compra
        $idCliente=$em->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        $cl=$em->getRepository('toosistemadeventasBundle:Cliente')->findOneBy(array('idUsuario'=>$idCliente));
        //Recorriendo los prod del carrito
        $pCarrito=$em->getRepository('toosistemadeventasBundle:Carrito')->findBy(array('idUsu'=>$user));
        //Recorro cada item del carrito del cliente
        foreach($pCarrito as $pcar){
            //Creo los objetos de tipo venta
            $prodV=new Venta();
            $prodV->setIdCliente($em->getRepository('toosistemadeventasBundle:Cliente')->find($cl));
            $prodV->setIdProducto($em->getRepository('toosistemadeventasBundle:Producto')->find($pcar->getIdProduct()));
            $prodV->setTotal($pcar->getTotal());
            $prodV->setCantidad($pcar->getCantidad());
            $prodV->setFechaVen(new \DateTime("now"));
            //Obtengo el objeto de inventario que descargo del inventario
            $inv=$em->getRepository('toosistemadeventasBundle:Inventario')->findOneBy(array('idProducto'=>$prodV->getIdProducto()));
            $inv->setCantidadDisponible($inv->getCantidadDisponible()-$pcar->getCantidad());
            //Persisto las ventas
            $em->persist($prodV);
            //remuevo del carrito los prod q ya registre en la venta
            $em->remove($pcar);
            //Guardo los cambios en inventario
            $em->flush();
        }
    }
    //Validar Capital
    protected  function  validarCaptital($em,$user,$request){
        $tot=$em->getRepository('toosistemadeventasBundle:Carrito')->getTotal($user);
        $tot[1]=$tot[1]*1.13;
        $us=$em->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        //Obtengo el cliente
        if($us->getSaldo()>$tot[1])
        {
            return true;
        }
        else
            return false;
    }
    //Validar Capital
    protected  function  actualizarSaldo($em,$user,$request){
        $tot=$em->getRepository('toosistemadeventasBundle:Carrito')->getTotal($user);
        $tot[1]=$tot[1]*1.13;
        $us=$em->getRepository('toosistemadeventasBundle:Usuario')->find($request->getSession()->get('login')->getId());
        //Obtengo el cliente
        if($us->getSaldo()>$tot[1])
        {
            //Descuento la venta del saldo del cliente
            $us->setSaldo($us->getSaldo()-$tot[1]);
            $em->flush();
            return true;
        }
        else
            return false;
    }
}