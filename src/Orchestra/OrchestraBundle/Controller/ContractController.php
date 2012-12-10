<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Contract;
use Orchestra\OrchestraBundle\Form\ContractType;

/**
 * Contract controller.
 *
 */
class ContractController extends Controller
{
    /**
     * Lists all Contract entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Contract')->findAll();

        return $this->render('OrchestraOrchestraBundle:Contract:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Contract entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Contract:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Contract entity.
     *
     */
    public function newAction()
    {
        $entity = new Contract();
        $form   = $this->createForm(new ContractType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Contract:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Contract entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Contract();
        $form = $this->createForm(new ContractType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contract_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Contract:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contract entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $editForm = $this->createForm(new ContractType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Contract:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Contract entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ContractType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contract_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Contract:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contract entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Contract')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contract entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contract'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
