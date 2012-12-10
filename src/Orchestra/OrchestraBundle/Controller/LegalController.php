<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Legal;
use Orchestra\OrchestraBundle\Form\LegalType;

/**
 * Legal controller.
 *
 */
class LegalController extends Controller
{
    /**
     * Lists all Legal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Legal')->findAll();

        return $this->render('OrchestraOrchestraBundle:Legal:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Legal entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Legal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Legal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Legal:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Legal entity.
     *
     */
    public function newAction()
    {
        $entity = new Legal();
        $form   = $this->createForm(new LegalType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Legal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Legal entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Legal();
        $form = $this->createForm(new LegalType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('legal_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Legal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Legal entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Legal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Legal entity.');
        }

        $editForm = $this->createForm(new LegalType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Legal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Legal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Legal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Legal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LegalType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('legal_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Legal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Legal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Legal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Legal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('legal'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
