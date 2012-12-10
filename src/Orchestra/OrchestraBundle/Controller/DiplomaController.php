<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Diploma;
use Orchestra\OrchestraBundle\Form\DiplomaType;

/**
 * Diploma controller.
 *
 */
class DiplomaController extends Controller
{
    /**
     * Lists all Diploma entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Diploma')->findAll();

        return $this->render('OrchestraOrchestraBundle:Diploma:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Diploma entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Diploma')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diploma entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Diploma:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Diploma entity.
     *
     */
    public function newAction()
    {
        $entity = new Diploma();
        $form   = $this->createForm(new DiplomaType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Diploma:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Diploma entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Diploma();
        $form = $this->createForm(new DiplomaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diploma_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Diploma:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Diploma entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Diploma')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diploma entity.');
        }

        $editForm = $this->createForm(new DiplomaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Diploma:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Diploma entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Diploma')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diploma entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DiplomaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diploma_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Diploma:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Diploma entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Diploma')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Diploma entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diploma'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
