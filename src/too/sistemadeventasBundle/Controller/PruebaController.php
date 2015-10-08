<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use too\sistemadeventasBundle\Entity\Asignatura;
use too\sistemadeventasBundle\Entity\Categoria;
use too\sistemadeventasBundle\Entity\Evaluacion;
use too\sistemadeventasBundle\Entity\Usuario;
use too\sistemadeventasBundle\Entity\usuarios;

class PruebaController extends Controller
{

    public function pruebaAction()
    {
        /*$em=$this->getDoctrine()->getEntityManager();
        $asig=new Asignatura();
        $asig->setNombre('ANF115');
        $asig->setIdEvaluacionRealizada($em->getRepository('toosistemadeventasBundle:Evaluacion')->find(1));

        $em->persist($asig);
        $em->flush();*/
        return new Response('Insertado');
    }
    public function  prueba2Action(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){

            $prueba=new Evaluacion();

            $prueba->setNota($request->get("nota"));
            $prueba->setPorcentaje($request->get("porcentaje"));

            $em->persist($prueba);
            $em->flush();

            return $this->redirect($this->generateUrl('prueba'));
        }

        return $this->render('@toosistemadeventas/Formulario/form.html.twig');

    }
}
