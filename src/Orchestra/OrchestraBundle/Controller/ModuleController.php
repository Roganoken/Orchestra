<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Module;
use Orchestra\OrchestraBundle\Form\ModuleType;
use Orchestra\OrchestraBundle\Form\InscriptionType;

/**
 * Module controller.
 *
 */
class ModuleController extends Controller
{
    /**
     * Lists all Module entities.
     *
     */
    public function indexAction()
    {
        return $this->render('OrchestraOrchestraBundle:Module:index.html.twig'
        );
    }

    /**
     * LISTE TOUS LES TUTORATS.
     *
     */
    
    public function historiqueAction()
    {
        $em = $this->getDoctrine()->getManager();

        $historiques = $em->getRepository('OrchestraOrchestraBundle:Module')->findAll();

        return $this->render('OrchestraOrchestraBundle:Module:historique.html.twig', array(
            'historiques' => $historiques,
        ));
    }

    /**
     * LISTE TOUS LES TUTORATS A VENIR.
     *
     */
    
    public function listeAction()
    {
        
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Module', 'a')
          ->where('a.date >= :today')
          ->setParameter('today', new \DateTime())
          ->orderBy('a.date', 'DESC');

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Module:liste.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * AFFICHE LES 3 DERNIERS TUTORATS.
     *
     */
    
    public function nextAction($max = 3)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Module', 'a')
          ->where('a.date >= :today')
          ->setParameter('today', new \DateTime())
          ->orderBy('a.date', 'ASC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $tutorats = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Module:next.html.twig', array(
            'tutorats' => $tutorats,
        ));
    }

    /**
     * TUTORAT DU JOUR.
     *
     */
    
    public function jourAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Module', 'a')
          ->where('a.date >= :today and a.date <= :tomorrow')
          ->setParameter('today', new \DateTime('today'))
          ->setParameter('tomorrow', new \DateTime('tomorrow'))
          ->orderBy('a.date', 'ASC');

        $query = $qb->getQuery();
        $tutorat_jours = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Module:jour.html.twig', array(
            'tutorat_jours' => $tutorat_jours,
        ));
    }

    /**
     * Finds and displays a Module entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Module:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        
            ));
    }

    /**
     * Displays a form to create a new Module entity.
     *
     */
    public function newAction()
    {
        $entity = new Module();
        $form   = $this->createForm(new ModuleType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Module:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Module entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Module();
        $form = $this->createForm(new ModuleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // CREATEUR DU MODULE
            $user_id = $this->get('security.context')->getToken()->getUser();
            
            $entity->setModuleUser($user_id);
            $entity->setCreated(new \Datetime());
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('module_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Module:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Module entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUser()->getId();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getModuleUser()->getId();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('module'), 301);
            }
        }

        $editForm = $this->createForm(new ModuleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Module:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Module entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ModuleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            $entity->setUpdated(new \Datetime());
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('module_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Module:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * S'inscrire à un module.
     *
     */
    public function inscriptionAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();

            $module = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);
                
            $user = $this->get('security.context')->getToken()->getUser();

            if (!$module) {
                throw $this->createNotFoundException('Unable to find Module entity.');
            }
                
                $module->addUser($user);
                $em->flush();
                
                $user->addModule($module);
                $em->flush();
                
                return $this->redirect($this->generateUrl('module_show', array('id' => $id)));
                
    }

    /**
     * Se désinscrire à un module.
     *
     */
    public function desinscriptionAction($id)
    {
            $em = $this->getDoctrine()->getManager();

            $module = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);
                
            $user = $this->get('security.context')->getToken()->getUser();

            if (!$module) {
                throw $this->createNotFoundException('Unable to find Module entity.');
            }
            
            if ($module->getUser($user) == true){
                
                $module->removeUser($user);
                $em->persist($module);
                $em->flush();
                
                $user->removeModule($module);
                $em->persist($user);
                $em->flush();
               
            }
                return $this->redirect($this->generateUrl('module_show', array('id' => $id)));
                
    }

    /**
     * Deletes a Module entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Module entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('module'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
