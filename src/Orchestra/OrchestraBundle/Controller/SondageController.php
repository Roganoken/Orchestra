<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Sondage;
use Orchestra\OrchestraBundle\Form\SondageType;

/**
 * Sondage controller.
 *
 */
class SondageController extends Controller
{
    /**
     * Lists all Sondage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Sondage')->findAll();

        return $this->render('OrchestraOrchestraBundle:Sondage:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Sondage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Sondage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sondage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Sondage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Sondage entity.
     *
     */
    public function newAction()
    {
        $entity = new Sondage();
        $form   = $this->createForm(new SondageType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Sondage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Sondage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Sondage();
        $form = $this->createForm(new SondageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sondage_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Sondage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Sondage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Sondage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sondage entity.');
        }

        $editForm = $this->createForm(new SondageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Sondage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Sondage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Sondage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sondage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SondageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sondage_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Sondage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sondage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Sondage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sondage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sondage'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
