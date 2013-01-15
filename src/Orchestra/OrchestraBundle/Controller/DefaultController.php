<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrchestraOrchestraBundle:Default:index.html.twig');
    }
    
    
    public function profilAction()
    {
        return $this->render('OrchestraOrchestraBundle:Default:profil.html.twig');
    }
    
    
}
