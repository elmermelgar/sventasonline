<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/app/{c}", name="homepage")
     */
    public function indexAction($c)
    {
        return $this->render('AppBundle::prueba2.html.twig',array('cosa'=> $c));
    }

}
