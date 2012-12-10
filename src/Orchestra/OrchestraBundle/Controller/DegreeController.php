<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Degree;
use Orchestra\OrchestraBundle\Form\DegreeType;

/**
 * Degree controller.
 *
 */
class DegreeController extends Controller
{
    /**
     * Lists all Degree entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Degree')->findAll();

        return $this->render('OrchestraOrchestraBundle:Degree:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Degree entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Degree')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Degree entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Degree:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Degree entity.
     *
     */
    public function newAction()
    {
        $entity = new Degree();
        $form   = $this->createForm(new DegreeType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Degree:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Degree entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Degree();
        $form = $this->createForm(new DegreeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('degree_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Degree:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Degree entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Degree')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Degree entity.');
        }

        $editForm = $this->createForm(new DegreeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Degree:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Degree entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Degree')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Degree entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DegreeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('degree_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Degree:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Degree entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Degree')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Degree entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('degree'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
