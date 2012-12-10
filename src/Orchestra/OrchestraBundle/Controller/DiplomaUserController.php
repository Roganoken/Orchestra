<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\DiplomaUser;
use Orchestra\OrchestraBundle\Form\DiplomaUserType;

/**
 * DiplomaUser controller.
 *
 */
class DiplomaUserController extends Controller
{
    /**
     * Lists all DiplomaUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:DiplomaUser')->findAll();

        return $this->render('OrchestraOrchestraBundle:DiplomaUser:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a DiplomaUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:DiplomaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiplomaUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:DiplomaUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new DiplomaUser entity.
     *
     */
    public function newAction()
    {
        $entity = new DiplomaUser();
        $form   = $this->createForm(new DiplomaUserType(), $entity);

        return $this->render('OrchestraOrchestraBundle:DiplomaUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new DiplomaUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new DiplomaUser();
        $form = $this->createForm(new DiplomaUserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diploma_user_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:DiplomaUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DiplomaUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:DiplomaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiplomaUser entity.');
        }

        $editForm = $this->createForm(new DiplomaUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:DiplomaUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing DiplomaUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:DiplomaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiplomaUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DiplomaUserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diploma_user_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:DiplomaUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DiplomaUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:DiplomaUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DiplomaUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diploma_user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
