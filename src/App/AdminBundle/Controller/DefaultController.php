<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*exemple 1 git*/
        /*exemple 2 git*/
        return $this->render('AdminBundle:Default:index.html.twig');
    }
}
