<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\News;
use Orchestra\OrchestraBundle\Form\NewsType;
use Orchestra\OrchestraBundle\Form\CommentaireType;
use Orchestra\OrchestraBundle\Entity\Commentaire;

/**
 * News controller.
 *
 */
class NewsController extends Controller
{
    /**
     * Lists all News entities.
     *
     */
    public function indexAction()
    {
        return $this->render('OrchestraOrchestraBundle:News:index.html.twig');
    }

    /**
     * LISTE LES 10 DERNIERES ACTUALITES.
     *
     */
    
    public function listeAction($max = 10)
    {
        
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:News', 'a')
          ->orderBy('a.created', 'DESC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:News:liste.html.twig', array(
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
        
        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM OrchestraOrchestraBundle:News a";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            2/*limit per page*/
                );

        return $this->render('OrchestraOrchestraBundle:News:historique.html.twig', array(
            'historiques' => $pagination,
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:News')->find($id);
        
        $commentaire = new Commentaire();
        $form = $this->createForm(new CommentaireType(), $commentaire);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:News:show.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),          
            
            ));
    }

    /**
     * Displays a form to create a new News entity.
     *
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createForm(new NewsType(), $entity);

        return $this->render('OrchestraOrchestraBundle:News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new News entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new News();
        $form = $this->createForm(new NewsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // CREATEUR DU MODULE
            $user_id = $this->get('security.context')->getToken()->getUser();
            
            $entity->setCreated(new \Datetime());
            $entity->setUser($user_id);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('news_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUser()->getId();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getUser()->getId();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('news'), 301);
            }
        }


        $editForm = $this->createForm(new NewsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing News entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NewsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            $entity->setUpdated(new \Datetime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('news_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:News')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find News entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('news'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Displays a form to create a new Commentaire entity.
     *
     */
    public function addCommentaireAction()
    {
        $entity = new Commentaire();
        $form   = $this->createForm(new CommentaireType(), $entity);

        return $this->render('OrchestraOrchestraBundle:News:addCommentaire.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Commentaire entity.
     *
     */
    public function createCommentaireAction(Request $request, $id)
    {
        $commentaire  = new Commentaire();
        
        $form = $this->createForm(new CommentaireType(), $commentaire);
        $form->bind($request);

        $user = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('OrchestraOrchestraBundle:News')->find($id);

        if (!$news) {
                throw $this->createNotFoundException('Unable to find News entity.');
        }
        
        if ($form->isValid()) {
            
            $commentaire->setUser($user);
            $commentaire->setCreated(new \Datetime());
            $commentaire->setUpdated(new \Datetime());
            
            $em->persist($commentaire);
            $em->flush();
                
            $news->addCommentaire($commentaire);
            $em->flush();

            return $this->redirect($this->generateUrl('news_show', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:News:addCommentaire.html.twig', array(
            'entity' => $commentaire,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Deletes a News entity.
     *
     */
    public function deleteCommentaireAction($actualite, $id)
    {
            $em = $this->getDoctrine()->getManager();
            
            $commentaire = $em->getRepository('OrchestraOrchestraBundle:Commentaire')->find($id);
            $news = $em->getRepository('OrchestraOrchestraBundle:News')->find($actualite);
            $user_session = $this->get('security.context')->getToken()->getUser();

            if (!$commentaire) {
                throw $this->createNotFoundException('Unable to find Commentaire entity.');
            }

            if (!$news) {
                throw $this->createNotFoundException('Unable to find News entity.');
            }
            
            $user = $commentaire->getUser();
            
            if($user == $user_session){
                
            $news->removeCommentaire($commentaire);
            $em->flush();

            $em->remove($commentaire);
            $em->flush();
            
            }
            
        return $this->redirect($this->generateUrl('news_show', array('id' => $actualite)));
    }
}
