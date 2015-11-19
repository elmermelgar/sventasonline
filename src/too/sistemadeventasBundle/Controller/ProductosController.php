<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Producto;
use too\sistemadeventasBundle\Modals\TOOController;

class ProductosController extends TOOController
{
    public function productosAction( Request $request)
    {
        $user=$this->enviarSesion($request);
        $validado=$this->validarAcceso($request);
        if($validado){
            $productos=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Producto')->findAll();
            $total_count=$this->getTotalProductos();
           // die(" ".$total_count);
            $page=$request->get('page');
            $porpagina=2;
            $totalPaginas=ceil($total_count/$porpagina);
            if(!is_numeric($page)){
                $page=1;
            }else{
                $page=floor($page);
            }
            if($total_count<=$porpagina){
                $page=1;
            }
            if(($page*$porpagina)>$total_count){
                $page=$totalPaginas;
            }
            $offset=0;
            if($page>1){
                $offset=$porpagina*($page-1);
            }
            $em=$this->getDoctrine()
                        ->getManager()
                        ->createQueryBuilder('toosistemadeventasBundle:Producto')
                        ->select('c')
                        ->from('toosistemadeventasBundle:Producto','c')
                        ->setFirstResult($offset)
                        ->setMaxResults($porpagina);
            $ems=$em->getQuery();
            $datos=$ems->getArrayResult();

            return $this->render('toosistemadeventasBundle:Admin:productos.html.twig',array('user'=>$user,'productos'=>$productos, 'datos'=>$datos, 'porpagina'=>$porpagina, 'totalPaginas'=>$totalPaginas, 'total_count'=>$total_count, 'page'=>$page));
        }
        else
            return $this->render('toosistemadeventasBundle:Sistema:index.html.twig',array('user'=>$user));
    }
    public function getTotalProductos(){
        $datos=$this->getDoctrine()
                                ->getManager()
                                ->createQueryBuilder('toosistemadeventasBundle:Producto')
                                ->select('Count(c)')
                                ->from('toosistemadeventasBundle:Producto','c')
                                ->getQuery()
                                ->getSingleScalarResult();
        return $datos;
    }

    public function nuevoProductoAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $validado=$this->validarAcceso($request);
        $user=$this->enviarSesion($request);
        $categorias=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Categoria')->findAll();
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){
                //Verificar error de archivo
                if ($_FILES["archivo"]["error"] > 0)
                    return new Response('Error en subida de Imagen');
                else {

                    if($this->infoTipoImagen('archivo')[0]=='image')
                    {
                        $nombreProducto=$request->get('nombreProd');

                        if($em->getRepository('toosistemadeventasBundle:Producto')->findOneBy(array('nombreProd'=>$nombreProducto)))
                        {
                            $this->MensajeFlash('credencial','El Producto ya ha sido registrado!');
                            return $this->redirect($this->generateUrl('productos'));
                        }
                        else {

                            $nombreImagen=$nombreProducto.$this->infoTipoImagen('archivo')[1];
                            $prod=new Producto();

                            $prod->setNombreProd($nombreProducto);
                            //Asumo q la categoria ya esxiste quizas mediante un combo
                            $prod->setIdCategoria($em->getRepository('toosistemadeventasBundle:Categoria')->find($request->get('categorias')));
                            $prod->setDescripcionProd($request->get('descripcion'));
                            $prod->setPrecioUnitario($request->get('precio'));
                            $prod->setImagen("images/".$nombreImagen);
                            $prod->setEstado(1);
                            //Persistiendo Nvo Producto
                            $em->persist($prod);
                            $em->flush();
                            //Subiendo la Imagen
                            $this->subirImagen('archivo',$nombreImagen);
                            $this->MensajeFlash('exito', 'Producto creado correctamente!');

                            return $this->redirect($this->generateUrl('productos'));
                        }

                    }
                    else
                        $this->MensajeFlash('credencial', 'El Archivo no es una imagen. Intente de nuevo!');
                }
            }
            return $this->render('toosistemadeventasBundle:Admin:nuevoProducto.html.twig',array('user'=>$user,'categorias'=>$categorias));
        }
    }

    public function editarProductoAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $validado=$this->validarAcceso($request);
        $user=$this->enviarSesion($request);
        $datos=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Producto')
            ->find($id);
        $categorias=$this->getDoctrine()->getRepository('toosistemadeventasBundle:Categoria')->findAll();
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{
            if($request->isMethod("POST")){
                //Verificar error de archivo
                if ($_FILES["archivo"]["error"] > 0)
                    return new Response('Error en subida de Imagen');
                else {

                    if($this->infoTipoImagen('archivo')[0]=='image')
                    {
                        $nombreProducto=$request->get('nombreProd');

                        if($em->getRepository('toosistemadeventasBundle:Producto')->findOneBy(array('nombreProd'=>$nombreProducto)))
                        {
                            $this->MensajeFlash('credencial','El Producto ya ha sido registrado!');
                            return $this->redirect($this->generateUrl('productos'));
                        }
                        else {

                            $nombreImagen=$nombreProducto.$this->infoTipoImagen('archivo')[1];

                            $datos->setNombreProd($nombreProducto);
                            //Asumo q la categoria ya esxiste quizas mediante un combo
                            $datos->setIdCategoria($em->getRepository('toosistemadeventasBundle:Categoria')->find($request->get('categorias')));
                            $datos->setDescripcionProd($request->get('descripcion'));
                            $datos->setPrecioUnitario($request->get('precio'));
                            $datos->setImagen("images/".$nombreImagen);
                            $datos->setEstado(1);

                            $em->flush();
                            //Subiendo la Imagen
                            $this->subirImagen('archivo',$nombreImagen);
                            $this->MensajeFlash('exito', 'Producto Actualizado correctamente!');

                            return $this->redirect($this->generateUrl('productos'));
                        }

                    }
                    else
                        $this->MensajeFlash('credencial', 'El Archivo no es una imagen. Intente de nuevo!');
                }
            }
            return $this->render('toosistemadeventasBundle:Admin:editarProducto.html.twig',array('user'=>$user,'categorias'=>$categorias,'datos'=>$datos));
        }
    }
    public function bajarProductoAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        //Obtener la sesion
        $validado=$this->validarAcceso($request);
        $user=$this->enviarSesion($request);
        $datos=$this->getDoctrine()
            ->getRepository('toosistemadeventasBundle:Producto')
            ->find($id);
        if(!$validado){
            return $this->redirect($this->generateUrl('toosistemadeventas_inicio'));
        }
        else{


                            $datos->setEstado(2);

                            $em->flush();
                             $this->MensajeFlash('exito', 'Producto bajado correctamente!');
                            return $this->redirect($this->generateUrl('productos'));

        }
    }

}
