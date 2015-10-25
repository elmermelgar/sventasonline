<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Categoria;
use too\sistemadeventasBundle\Entity\Producto;
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

                if($this->validarUsuario($request->get('usuario'),$request->get('email')))
                {
                    //Nuevo Mensaje Flash
                    $this->MensajeFlash('credencial','Usuario/Correo ya existen!');
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
                    $this->MensajeFlash('exito','Usuario creado correctamente!');
                }


                return $this->redirect($this->generateUrl('toosistemadeventas_registro'));

            }
            return $this->render('@toosistemadeventas/Sistema/registro.html.twig',array('user'=>$user));
        }
    }
    public function registroProductoAction(Request $request){
            $em=$this->getDoctrine()->getManager();
            //Verificar envio del Formulario
            if($request->isMethod("POST"))
            {
                //Verificacion de errores en archivo
                if ($_FILES["archivo"]["error"] > 0)
                    return new Response('Error en subida de Imagen');
                else
                {
                    //Verificar que el archivo sea una imagen
                    if($this->infoTipoImagen('archivo')[0]=='image')
                    {
                        //Aqui susistuyan por el nombre q se va en post
                        $nombreProducto='Microondas';
                        //validando que no se repita el producto
                        if($em->getRepository('toosistemadeventasBundle:Producto')->findOneBy(array('nombreProd'=>$nombreProducto)))
                            return new Response('Producto ya ha sido registrado!!');
                        else{
                            $nombreImagen=$nombreProducto.$this->infoTipoImagen('archivo')[1];
                            $prod=new Producto();

                            $prod->setNombreProd($nombreProducto);
                            //Asumo q la categoria ya esxiste quizas mediante un combo
                            $prod->setIdCategoria($em->getRepository('toosistemadeventasBundle:Categoria')->find(1));
                            $prod->setDescripcionProd('Microonda LG');
                            $prod->setCantidadProd(5);
                            $prod->setPrecioUnitario(200);
                            $prod->setImagen($nombreImagen);
                            $prod->setEstado(1);
                            //Persistiendo Nvo Producto
                            $em->persist($prod);
                            $em->flush();
                            //Subiendo la Imagen
                            $this->subirImagen($nombreImagen);
                            return new Response('Archivo '.$nombreImagen);
                        }
                    }
                    else
                        return new Response('Archivo no es una imagen. Intente Nuevamente!!');
                }
            }
            else
                return $this->render('toosistemadeventasBundle::file.html.twig',array('user'=>''));
    }

    private function validarUsuario($user,$email){
        $em=$this->getDoctrine()->getManager();
        //Nuevo metodo  =D
        $encontrado=$em->getRepository('toosistemadeventasBundle:Usuario')->validarUser($user,$email);
        return $encontrado;
    }
    private function MensajeFlash($nombre,$mensaje){
        $this->get('session')->getFlashBag()->add(
            ''.$nombre,
            ''.$mensaje
        );
    }
    private function enviarSesion($request){
        $session=$request->getSession();
        if($session->has('login')){
            $login=$session->get('login');
            return $login->getUsername();
        }
    }
    private function infoTipoImagen($archivo){
        $tipo=explode('/', $_FILES["".$archivo]["type"]);
        $tipo[1]='.'.$tipo[1];
        return $tipo;
    }
    private function subirImagen($nombreImagen){
        move_uploaded_file($_FILES["archivo"]['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/sventas/web/images/".$nombreImagen);
    }
}
