<?php

namespace too\sistemadeventasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FerController extends Controller
{
    public function indexAction()
    {
        return $this->render('@toosistemadeventas/Sistema/registro.html.twig');
    }
}
