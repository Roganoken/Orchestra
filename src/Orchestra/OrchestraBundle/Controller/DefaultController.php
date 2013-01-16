<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrchestraOrchestraBundle:Default:index.html.twig');
    }
    
    
    public function profilAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        return $this->render('OrchestraOrchestraBundle:Default:profil.html.twig', array(
            'entity'      => $entity));
    }
    
    
}
