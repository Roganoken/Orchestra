<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Auteur;
use Orchestra\OrchestraBundle\Form\AuteurType;

/**
 * Auteur controller.
 *
 */
class AuteurController extends Controller
{
    /**
     * Lists all Auteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Auteur')->findAll();

        return $this->render('OrchestraOrchestraBundle:Auteur:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Auteur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Auteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Auteur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Auteur entity.
     *
     */
    public function newAction()
    {
        $entity = new Auteur();
        $form   = $this->createForm(new AuteurType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Auteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Auteur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Auteur();
        $form = $this->createForm(new AuteurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auteur_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Auteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Auteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Auteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auteur entity.');
        }

        $editForm = $this->createForm(new AuteurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Auteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Auteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Auteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AuteurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auteur_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Auteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Auteur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Auteur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Auteur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('auteur'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
