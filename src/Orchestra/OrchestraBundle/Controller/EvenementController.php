<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Evenement;
use Orchestra\OrchestraBundle\Form\EvenementType;

/**
 * Evenement controller.
 *
 */
class EvenementController extends Controller
{
    /**
     * Lists all Evenement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $qb = $em->createQueryBuilder();

        $qb->select('a')
           ->from('OrchestraOrchestraBundle:Evenement', 'a')
           ->orderBy('a.created', 'DESC')
          ->setMaxResults(5);

        $query = $qb->getQuery(); 
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Evenement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * LISTE TOUS LES TUTORATS.
     *
     */
    
    public function historiqueAction()
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Evenement', 'a')
          ->orderBy('a.created', 'DESC');

        $query = $qb->getQuery();

        $paginator = $this->get('knp_paginator');
        $historiques = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            3/*limit per page*/
                );

        return $this->render('OrchestraOrchestraBundle:Evenement:page_historique.html.twig', array(
            'historiques' => $historiques,
        ));
    }

    /**
     * Finds and displays a Evenement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Evenement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evenement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Evenement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Finds and displays a Evenement entity.
     *
     */
    public function miniListeAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $em = $this->get('doctrine.orm.entity_manager');
        
        $qb = $em->createQueryBuilder();

        $qb->select('a')
           ->from('OrchestraOrchestraBundle:Evenement', 'a')
           ->orderBy('a.created', 'DESC')
          ->setMaxResults(4);

        $query = $qb->getQuery(); 
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Evenement:miniListe.html.twig', array(
            'entities'      => $entities
            ));
    }

    /**
     * Displays a form to create a new Evenement entity.
     *
     */
    public function newAction()
    {
        $entity = new Evenement();
        $form   = $this->createForm(new EvenementType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Evenement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Evenement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Evenement();
        $form = $this->createForm(new EvenementType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // CREATEUR DU MODULE
            $user_id = $this->get('security.context')->getToken()->getUser();
            
            $entity->setUser($user_id);
            $entity->setCreated(new \Datetime());
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evenement_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Evenement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Evenement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Evenement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evenement entity.');
        }

        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUser();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getUser();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('evenement'), 301);
            }
        }

        $editForm = $this->createForm(new EvenementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Evenement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Evenement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Evenement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evenement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EvenementType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entity->setUpdated(new \Datetime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evenement_show', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Evenement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Evenement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Evenement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evenement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evenement'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
