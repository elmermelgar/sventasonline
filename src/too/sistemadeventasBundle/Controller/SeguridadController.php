<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Categoria;
use too\sistemadeventasBundle\Entity\Cliente;
use too\sistemadeventasBundle\Entity\Producto;
use too\sistemadeventasBundle\Entity\Usuario;
use too\sistemadeventasBundle\Modals\TOOController;

class SeguridadController extends TOOController
{
    public function registroAction(Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        //Obtener la sesion
        $user=$this->validarAcceso($request);
        if($user){
                return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){
                //Validando que sea un nuevo usuario
                if($this->validarRegistro($request->get('usuario'),$request->get('email')))
                {
                    //Nuevo Mensaje Flash
                    $this->MensajeFlash('credencial','Usuario/Correo ya existen!');
                    return $this->redirect($this->generateUrl('toosistemadeventas_registro'));
                }
                else
                {
                    //creacion de Usuario
                    $usuario = new Usuario();
                    $usuario->setApellidoUsu($request->get('apellido'));
                    $usuario->setNombreUsu($request->get('nombre'));
                    $usuario->setCorreo($request->get('email'));
                    $usuario->setPassword($request->get('pass'));
                    $usuario->setRol(1);
                    $usuario->setSaldo(0);
                    $usuario->setUsuario($request->get('usuario'));
                    //creacion de cliente
                    $cliente=new Cliente();
                    $cliente->setIdUsuario($usuario->getIdUsuario());
                    $cliente->setCuenta(0);

                    $em->persist($usuario);
                    $em->persist($cliente);
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

        $validado=$this->validarAcceso($request);
        $user=$this->enviarSesion($request);
        $categorias=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Categoria')->findAll();
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
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
                        $nombreProducto='Elmer';
                        //validando que no se repita el producto
                        if($em->getRepository('toosistemadeventasBundle:Producto')->findOneBy(array('nombreProd'=>$nombreProducto)))
                            return new Response('Producto ya ha sido registrado!!');
                        else{
                            $nombreImagen=$nombreProducto.$this->infoTipoImagen('archivo')[1];
                            $prod=new Producto();

                            $prod->setNombreProd($nombreProducto);
                            //Asumo q la categoria ya esxiste quizas mediante un combo
                            $prod->setIdCategoria($em->getRepository('toosistemadeventasBundle:Categoria')->find(1));
                            $prod->setDescripcionProd('Mi comida');
                            $prod->setCantidadProd(5);
                            $prod->setPrecioUnitario(200);
                            $prod->setImagen("images/".$nombreImagen);
                            $prod->setEstado(1);
                            //Persistiendo Nvo Producto
                            $em->persist($prod);
                            $em->flush();
                            //Subiendo la Imagen
                            $this->subirImagen('archivo',$nombreImagen);
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
    }

}
