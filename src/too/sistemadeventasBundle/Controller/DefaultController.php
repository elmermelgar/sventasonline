<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('toosistemadeventasBundle:Default:index.html.twig', array('name' => $name));
    }

    public function inicioAction()
    {
        return $this->render('toosistemadeventasBundle:Sistema:index.html.twig');
    }

    public function promocionesAction()
    {
        return $this->render('toosistemadeventasBundle:Sistema:promociones.html.twig');
    }

    public function registroAction()
    {
        return $this->render('toosistemadeventasBundle:Sistema:registro.html.twig');
    }
}
