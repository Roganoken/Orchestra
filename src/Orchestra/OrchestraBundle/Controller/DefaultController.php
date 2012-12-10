<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OrchestraOrchestraBundle:Default:index.html.twig', array('name' => $name));
    }
}
