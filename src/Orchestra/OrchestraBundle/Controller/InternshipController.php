<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Internship;
use Orchestra\OrchestraBundle\Form\InternshipType;

/**
 * Internship controller.
 *
 */
class InternshipController extends Controller
{
    /**
     * Lists all Internship entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Internship')->findAll();

        return $this->render('OrchestraOrchestraBundle:Internship:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Internship entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Internship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Internship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Internship:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Internship entity.
     *
     */
    public function newAction()
    {
        $entity = new Internship();
        $form   = $this->createForm(new InternshipType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Internship:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Internship entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Internship();
        $form = $this->createForm(new InternshipType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('internship_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Internship:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Internship entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Internship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Internship entity.');
        }

        $editForm = $this->createForm(new InternshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Internship:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Internship entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Internship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Internship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InternshipType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('internship_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Internship:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Internship entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Internship')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Internship entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('internship'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
