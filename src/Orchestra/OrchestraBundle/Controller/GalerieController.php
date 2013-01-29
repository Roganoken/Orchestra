<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Galerie;
use Orchestra\OrchestraBundle\Form\GalerieType;

/**
 * Galerie controller.
 *
 */
class GalerieController extends Controller
{
    /**
     * Lists all Galerie entities.
     *
     */
    public function indexAction()
    {
        return $this->render('OrchestraOrchestraBundle:Galerie:index.html.twig');
    }
    
    /**
     * Liste les menus à partir des media entity.
     *
     */
    public function menuGalerieAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('OrchestraOrchestraBundle:Media')->findAll();
        
        return $this->render('OrchestraOrchestraBundle:Galerie:menu.html.twig', array(
            'menus' => $menus,
        ));
    }
    
    /**
     * Liste les 10 dernières images.
     *
     */
    
    public function listeAction($max = 10)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->orderBy('a.created', 'DESC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Galerie:liste.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Liste les 10 dernières images pour l'accueil.
     *
     */
    
    public function accueilListeAction($max = 10)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->orderBy('a.created', 'DESC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Default:accueilListe.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * LISTE TOUTES LES IMAGES PAR CATEGORIE.
     *
     */
    
    public function categorieAction($id)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Media')->find($id);
        
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.media = :media')
          ->setParameter('media', $id)
          ->orderBy('a.created', 'DESC');

        $query = $qb->getQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
                );

        return $this->render('OrchestraOrchestraBundle:Galerie:categorie.html.twig', array(
            'images' => $pagination,
            'entity' => $entity,
        ));
    }
    

    /**
     * LISTE TOUTES LES IMAGES PAR CATEGORIE.
     *
     */
    
    public function maGalerieAction($id)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.user = :user')
          ->setParameter('user', $id)
          ->orderBy('a.created', 'DESC');

        $query = $qb->getQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
                );

        return $this->render('OrchestraOrchestraBundle:Default:magalerie.html.twig', array(
            'images' => $pagination,
        ));
    }
    
    
    /**
     * Finds and displays a Galerie entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Galerie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galerie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Galerie:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Galerie entity.
     *
     */
    public function newAction()
    {
        $entity = new Galerie();
        $form   = $this->createForm(new GalerieType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Galerie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Galerie entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Galerie();
        $form = $this->createForm(new GalerieType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('galerie_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Galerie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Galerie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Galerie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galerie entity.');
        }

        $editForm = $this->createForm(new GalerieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Galerie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Galerie entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Galerie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galerie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GalerieType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('galerie_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Galerie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Galerie entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Galerie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Galerie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('galerie'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
