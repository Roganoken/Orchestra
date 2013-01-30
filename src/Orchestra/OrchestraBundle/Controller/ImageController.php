<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Image;
use Orchestra\OrchestraBundle\Form\ImageType;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    /**
     * Lists all Image entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Image')->findAll();

        return $this->render('OrchestraOrchestraBundle:Image:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Image entity.
     *
     */
    public function showAction($id, $categorie=null)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }
        
        if ($categorie != null){
            
        /* image suivante */
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.id > :id and a.media = :media')
          ->setParameters(array(
              'id' => $id,
              'media' => $categorie,
              ))
          ->setMaxResults(1);
        
        $query = $qb->getQuery();
        $next = $query->getOneOrNullResult();
        
        /* image précédente */
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.id < :id and a.media = :media')
          ->setParameters(array(
              'id' => $id,
              'media' => $categorie,
              ))
          ->setMaxResults(1);

        $query = $qb->getQuery();
        $previous = $query->getOneOrNullResult();
            
        }else{
        /* image suivante */
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.id > :id')
          ->orderBy('a.id', 'ASC')
          ->setParameter('id', $id)
          ->setMaxResults(1);
        
        $query = $qb->getQuery();
        $next = $query->getOneOrNullResult();

        /* image précédente */
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.id < :id')
          ->orderBy('a.id', 'DESC')
          ->setParameter('id', $id)
          ->setMaxResults(1);

        $query = $qb->getQuery();
        $previous = $query->getOneOrNullResult();
        
        }
        
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Image:show.html.twig', array(
            'entity'      => $entity,
            'next'        => $next,
            'previous'    => $previous,
            'categorie'   => $categorie,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Finds and displays a Image entity.
     *
     */
    public function myShowAction($id, $user)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $user = $em->getRepository('OrchestraOrchestraBundle:User')->find($user);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        # RECUPERE LE USERNAME DE SESSION
        $user_id = $user->getId();
        
        /* image suivante */
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.id > :id and a.user = :user_id')
          ->orderBy('a.id', 'ASC')
          ->setParameters(array(
              'id' => $id,
              'user_id' => $user_id,
              ))
          ->setMaxResults(1);
        
        $query = $qb->getQuery();
        $next = $query->getOneOrNullResult();

        /* image précédente */
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Image', 'a')
          ->where('a.id < :id and a.user = :user_id')
          ->orderBy('a.id', 'DESC')
          ->setParameters(array(
              'id' => $id,
              'user_id' => $user_id,
              ))
          ->setMaxResults(1);

        $query = $qb->getQuery();
        $previous = $query->getOneOrNullResult();
        
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Image:show.html.twig', array(
            'entity'      => $entity,
            'next'        => $next,
            'previous'    => $previous,
            'user_id'     => $user_id,
            'delete_form' => $deleteForm->createView(),        
            ));
    }

    /**
     * Displays a form to create a new Image entity.
     *
     */
    public function newAction()
    {
        $entity = new Image();
        $form   = $this->createForm(new ImageType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Image entity.
     *
     */
    public function createAction(Request $request)
    {
        $image  = new Image();
        $form = $this->createForm(new ImageType(), $image);
        $form->bind($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $user = $this->get('security.context')->getToken()->getUser();  
            
            $image->setUser($user);
            $image->setCreated(new \DateTime());
            //$image->setTaille(getimagesize($image->getUrl()));
            $em->persist($image);
            $em->flush();  

            return $this->redirect($this->generateUrl('image_show', array('id' => $image->getId(),'user' => $user->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Image entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
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
               return $this->redirect($this->generateUrl('galerie'), 301);
            }
        }

        $editForm = $this->createForm(new ImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Image entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ImageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entity->setUpdated(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('image_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Image entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Image')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Image entity.');
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
               return $this->redirect($this->generateUrl('galerie'), 301);
            }
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
