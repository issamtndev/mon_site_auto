<?php

namespace App\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('HomeBundle:Auto');
        $listauto = $repository->findAll();
       return $this->render('HomeBundle:Default:index.html.twig',array("listauto"=>$listauto));
    }
}
