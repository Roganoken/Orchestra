<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\SocialNetworkUser;
use Orchestra\OrchestraBundle\Form\SocialNetworkUserType;

/**
 * SocialNetworkUser controller.
 *
 */
class SocialNetworkUserController extends Controller
{
    /**
     * Lists all SocialNetworkUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:SocialNetworkUser')->findAll();

        return $this->render('OrchestraOrchestraBundle:SocialNetworkUser:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a SocialNetworkUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:SocialNetworkUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialNetworkUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:SocialNetworkUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new SocialNetworkUser entity.
     *
     */
    public function newAction()
    {
        $entity = new SocialNetworkUser();
        $form   = $this->createForm(new SocialNetworkUserType(), $entity);

        return $this->render('OrchestraOrchestraBundle:SocialNetworkUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new SocialNetworkUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new SocialNetworkUser();
        $form = $this->createForm(new SocialNetworkUserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('social_network_user_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:SocialNetworkUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SocialNetworkUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:SocialNetworkUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialNetworkUser entity.');
        }

        $editForm = $this->createForm(new SocialNetworkUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:SocialNetworkUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing SocialNetworkUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:SocialNetworkUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialNetworkUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SocialNetworkUserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('social_network_user_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:SocialNetworkUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SocialNetworkUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:SocialNetworkUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SocialNetworkUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('social_network_user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
