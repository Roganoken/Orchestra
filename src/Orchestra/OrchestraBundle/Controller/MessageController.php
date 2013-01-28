<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Message;
use Orchestra\OrchestraBundle\Form\MessageType;
use Orchestra\OrchestraBundle\Form\ReplyType;

/**
 * Message controller.
 *
 */
class MessageController extends Controller
{
    /**
     * Lists all Message entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
            
        // CREATEUR DU MESSAGE
        $user_id = $this->get('security.context')->getToken()->getUser()->getId();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Message', 'a')
          ->where('a.toPersonneId = :id')
          ->setParameter('id', $user_id)
          ->orderBy('a.created', 'DESC');

        $query = $qb->getQuery();

        $paginator = $this->get('knp_paginator');
        $historiques = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
                );

        return $this->render('OrchestraOrchestraBundle:Message:index.html.twig', array(
            'entities' => $historiques,
        ));
    }
    
    
    public function newMessageAction()
    {
        $em = $this->getDoctrine()->getManager();
            
        // CREATEUR DU MESSAGE
        $user_id = $this->get('security.context')->getToken()->getUser()->getId();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Message', 'a')
          ->where('a.toPersonneId = :id and a.isRead = :false')
          ->setParameter('id', $user_id)
          ->setParameter('false', false)
          ->orderBy('a.created', 'DESC');

        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Default:newMessage.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Message entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }
            
        // CREATEUR DU MESSAGE
        $user = $this->get('security.context')->getToken()->getUser();
        $to = $entity->gettoPersonneId();
        
        if ($user == $to){
        
        $entity->setisRead(true);
            
         $em->persist($entity);    
        $em->flush();

        return $this->render('OrchestraOrchestraBundle:Message:show.html.twig', array(
            'entity'      => $entity       
            ));
        
        }else{
            
            return $this->redirect($this->generateUrl('message'));
        }
    }

    /**
     * Displays a form to create a new Message entity.
     *
     */
    public function newAction()
    {
        $entity = new Message();
        $form   = $this->createForm(new MessageType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Message:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Message entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Message();
        $form = $this->createForm(new MessageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // CREATEUR DU MESSAGE
            $user = $this->get('security.context')->getToken()->getUser();
                
            $entity->setFromPersonneId($user);
            $entity->setCreated(new \Datetime());
            $entity->setisRead(false);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('message_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Message:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Message entity.
     *
     */
    public function newReplyAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Message();
        $form   = $this->createForm(new ReplyType(), $entity);

        $dest = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

        if (!$dest) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return $this->render('OrchestraOrchestraBundle:Message:newReply.html.twig', array(
            'entity' => $entity,
            'dest'     => $dest,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Message entity.
     *
     */
    public function createReplyAction(Request $request, $id)
    {
        $entity  = new Message();
        $form = $this->createForm(new ReplyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();

            $dest = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

            if (!$dest) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }
            
            // CREATEUR DU MESSAGE
            $user = $this->get('security.context')->getToken()->getUser();
                
            $entity->setToPersonneId($dest);
            $entity->setFromPersonneId($user);
            $entity->setCreated(new \Datetime());
            $entity->setisRead(false);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('message_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Message:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Deletes a Message entity.
     *
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Message')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Message entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('message'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
     * 
     */
}
