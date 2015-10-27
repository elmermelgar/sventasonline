<?php

namespace too\sistemadeventasBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\Type;
use Proxies\__CG__\too\sistemadeventasBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Usuario;

class UsuarioController extends Controller
{
    public function indexAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        if($user){
            return $this->render('toosistemadeventasBundle:Admin:index.html.twig',array('user'=>$user));
        }
        else{
            return $this->render('@toosistemadeventas/Sistema/index.html.twig', array('user'=>$user));
        }

    }

    public function usuariosAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        if($user){
            $usuarios=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>1));
            return $this->render('toosistemadeventasBundle:Admin:crudUsuarios.html.twig',array('user'=>$user,'usuarios'=>$usuarios));
        }
        else{
            return $this->render('@toosistemadeventas/Sistema/index.html.twig', array('user'=>$user));
        }

    }

    public function allAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        if($user){
            $datos= $this->getDoctrine()
                ->getRepository('toosistemadeventasBundle:Usuario')
                ->findAll();
            return $this->render('toosistemadeventasBundle:Admin:allUsuarios.html.twig',array('user'=>$user,'datos'=>$datos));
        }
        else{
            return $this->render('@toosistemadeventas/Sistema/index.html.twig', array('user'=>$user));
        }
    }

    public function adminAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        if($user){
            $admin=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>2));
            return $this->render('toosistemadeventasBundle:Admin:crudAdmin.html.twig',array('user'=>$user,'admin'=>$admin));
        }
        else{
            return $this->render('@toosistemadeventas/Sistema/index.html.twig', array('user'=>$user));
        }

    }

    public function clientesAction(Request $request)
    {
        $user=$this->enviarSesion($request);
        if($user){
            $clientes=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>3));
            $detalle=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Cliente')->findAll();
            return $this->render('toosistemadeventasBundle:Admin:crudClientes.html.twig',array('user'=>$user,'clientes'=>$clientes, 'detalle'=>$detalle));
        }
        else{
            return $this->render('@toosistemadeventas/Sistema/index.html.twig', array('user'=>$user));
        }


    }


    public function nuevoAdminAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $user=$this->enviarSesion($request);
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('usuario'),$request->get('email')))
                {
                    $this->MensajeFlash('Usuario y correo ya existe!');
                    return $this->redirect($this->generateUrl('nuevoAdmin'));
                }
                else
                {
                    $usuario = new Usuario();
                    $usuario->setApellidoUsu($request->get('apellido'));
                    $usuario->setNombreUsu($request->get('nombre'));
                    $usuario->setCorreo($request->get('email'));
                    $usuario->setPassword($request->get('pass'));
                    $usuario->setRol(2);
                    $usuario->setUsuario($request->get('usuario'));

                    $em->persist($usuario);
                    $em->flush();
                    $this->MensajeFlash2('Administrador creado correctamente!');
                }


                return $this->redirect($this->generateUrl('crudAdmin'));

            }
            return $this->render('@toosistemadeventas/Admin/registroAdmin2.html.twig',array('user'=>$user));
        }
    }

    public function nuevoClienteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $user=$this->enviarSesion($request);
        $usu=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>1));
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){

                    $cliente = new Cliente();
                    $cliente->setIdUsuario($request->get('idusuario'));
                    $cliente->setCodigoPostal($request->get('postal'));
                    $cliente->setCuenta($request->get('saldo'));
                    $cliente->setTelefonoCli($request->get('telefono'));
                    $cliente->setPais($request->get('pais'));

                    $em->persist($cliente);
                    $em->flush();
                    $this->MensajeFlash2('Cliente creado correctamente!');



                return $this->redirect($this->generateUrl('crudClientes'));

            }
            return $this->render('toosistemadeventasBundle:Admin:registroCliente.html.twig',array('user'=>$user,'usuario'=>$usu));
        }
    }

    public function editarUsuarioAction($idUsu,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->enviarSesion($request);
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $datos=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Usuario')
            ->find($idUsu);
        if(!$datos)
        {
            throw $this->createNotFoundException('No existe el usuario con el ID'.$idUsu);
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('usuario'),$request->get('email')))
                {
                    $this->MensajeFlash('Usuario y correo ya existe!');
                    return $this->redirect($this->generateUrl('crudUsuarios'));
                }
                else
                {

                    $datos->setApellidoUsu($request->get('apellido'));
                    $datos->setNombreUsu($request->get('nombre'));
                    $datos->setCorreo($request->get('email'));
                    $datos->setPassword($request->get('pass'));
                    $datos->setRol(1);
                    $datos->setUsuario($request->get('usuario'));
                    $em->flush();
                    $this->MensajeFlash2('Usuario actualizado correctamente!');
                }


                return $this->redirect($this->generateUrl('crudUsuarios'));

            }

            return $this->render('toosistemadeventasBundle:Admin:editarRegistroUsu.html.twig',array('user'=>$user,'datos'=>$datos));
        }
    }

    public function editarClienteAction($idUsu,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->enviarSesion($request);
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $datos=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Usuario')
            ->find($idUsu);

        $detalle=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Cliente')
            ->findOneBy(array('idUsuario'=>$idUsu));
        if(!$datos)
        {
            throw $this->createNotFoundException('No existe el usuario con el ID'.$idUsu);
        }
        if(!$detalle)
        {
            throw $this->createNotFoundException('No existe el Cliente con el ID usuario'.$idUsu);
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('usuario'),$request->get('email')))
                {
                    $this->MensajeFlash('Usuario y correo ya existe!');
                    return $this->redirect($this->generateUrl('crudClientes'));
                }
                else
                {

                    $datos->setApellidoUsu($request->get('apellido'));
                    $datos->setNombreUsu($request->get('nombre'));
                    $datos->setCorreo($request->get('email'));
                    $datos->setPassword($request->get('pass'));
                    $datos->setRol(3);
                    $datos->setUsuario($request->get('usuario'));
                    $detalle->setCodigoPostal($request->get('postal'));
                    $detalle->setCuenta($request->get('saldo'));
                    $detalle->setTelefonoCli($request->get('telefono'));
                    $detalle->setPais($request->get('pais'));
                    $em->flush();
                    $this->MensajeFlash2('Cliente actualizado correctamente!');
                }


                return $this->redirect($this->generateUrl('crudClientes'));

            }

            return $this->render('toosistemadeventasBundle:Admin:editarCliente.html.twig',array('user'=>$user,'datos'=>$datos, 'detalle'=>$detalle));
        }
    }

    public function editarAdminAction($idUsu, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $user=$this->enviarSesion($request);
        if(!$user){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        $datos=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Usuario')
            ->find($idUsu);
        if(!$datos)
        {
            throw $this->createNotFoundException('No existe el usuario con el ID'.$idUsu);
        }
        else{
            if($request->isMethod("POST")){

                if($this->loginAction($request->get('usuario'),$request->get('email')))
                {
                    $this->MensajeFlash('Usuario y correo ya existe!');
                    return $this->redirect($this->generateUrl('nuevoAdmin'));
                }
                else
                {

                    $datos->setApellidoUsu($request->get('apellido'));
                    $datos->setNombreUsu($request->get('nombre'));
                    $datos->setCorreo($request->get('email'));
                    $datos->setPassword($request->get('pass'));
                    $datos->setRol(2);
                    $datos->setUsuario($request->get('usuario'));

                    //$em->persist($usuario);
                   // $em->refresh($usuario);
                    $em->flush();
                    $this->MensajeFlash2('Administrador actualizado correctamente!');
                }


                return $this->redirect($this->generateUrl('crudAdmin'));

            }

            return $this->render('toosistemadeventasBundle:Admin:editarRegistro.html.twig',array('user'=>$user,'datos'=>$datos));
        }

    }
    public function deleteUsuarioAction($idUsu,Request $request)
    {
        $user=$this->enviarSesion($request);
        $em=$this->getDoctrine()->getManager();
        $usuario=$em->getRepository('toosistemadeventasBundle:Usuario')->find($idUsu);
        if(!$usuario){
            throw $this->createNotFoundException('No existe el usuario con el ID'.$idUsu);
        }
        $em->remove($usuario);
        $em->flush();
        $this->MensajeFlash2('Usuario eliminado correctamente!');
        $usuarios=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>1));
        return $this->render('toosistemadeventasBundle:Admin:crudUsuarios.html.twig',array('user'=>$user,'usuarios'=>$usuarios));
    }
    public function deleteAdminAction($idUsu,Request $request)
    {
        $user=$this->enviarSesion($request);
        $em=$this->getDoctrine()->getManager();
        $usuario=$em->getRepository('toosistemadeventasBundle:Usuario')->find($idUsu);
        if(!$usuario){
            throw $this->createNotFoundException('No existe el usuario con el ID'.$idUsu);
        }
        $em->remove($usuario);
        $em->flush();
        $this->MensajeFlash2('Administrador borrado correctamente!');
        $admin=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Usuario')->findBy(array('rol'=>2));
        return $this->render('toosistemadeventasBundle:Admin:crudAdmin.html.twig',array('user'=>$user,'admin'=>$admin));
    }

    private function enviarSesion($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            return $login->getUsername();
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
}
