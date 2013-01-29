<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Livre;
use Orchestra\OrchestraBundle\Form\LivreType;

/**
 * Livre controller.
 *
 */
class LivreController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('OrchestraOrchestraBundle:Livre:index.html.twig');
    }
    
    /**
     * Lists all Livre entities.
     *
     */
    
    public function listeAction($max = 8)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Livre', 'a')
          ->orderBy('a.created', 'ASC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Livre:liste.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Liste les menus à partir des genres.
     *
     */
    
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('OrchestraOrchestraBundle:Genre')->findAll();
        
        return $this->render('OrchestraOrchestraBundle:Livre:menu.html.twig', array(
            'menus' => $menus,
        ));
    }

    /**
     * LISTE TOUS LES LIVRES PAR GENRE.
     *
     */
    
    public function genreAction($id)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Genre')->find($id);
        
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Livre', 'a')
          ->where('a.genre = :genre')
          ->setParameter('genre', $id)
          ->orderBy('a.created', 'DESC');

        $query = $qb->getQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            16/*limit per page*/
                );

        return $this->render('OrchestraOrchestraBundle:Livre:categorie.html.twig', array(
            'livres' => $pagination,
            'entity' => $entity,
        ));
    }
    
    /**
     * dernier livre ajouté.
     *
     */
    
    public function lastEntryAction($max = 1) 
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Livre', 'a')
          ->orderBy('a.created', 'DESC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $entity = $query->getSingleResult();

        return $this->render('OrchestraOrchestraBundle:Livre:lastEntry.html.twig', array(
            'entity' => $entity,
        ));
    }
    
    /**
     * 4 derniers livres ajoutés.
     *
     */
    
    public function lastEntriesAction($max = 4) 
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Livre', 'a')
          ->orderBy('a.created', 'DESC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Livre:lastEntries.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Livre entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Livre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Livre:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Livre entity.
     *
     */
    public function newAction()
    {
        $entity = new Livre();
        $form   = $this->createForm(new LivreType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Livre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Livre entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Livre();
        $form = $this->createForm(new LivreType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            
            $entity->setCreated(new \Datetime());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('livre_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Livre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Livre entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Livre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livre entity.');
        }

        $editForm = $this->createForm(new LivreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Livre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Livre entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Livre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LivreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            $entity->setUpdated(new \Datetime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('livre_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Livre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Livre entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Livre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Livre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('livre'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
