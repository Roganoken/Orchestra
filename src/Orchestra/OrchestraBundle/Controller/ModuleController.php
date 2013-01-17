<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\Module;
use Orchestra\OrchestraBundle\Form\ModuleType;

/**
 * Module controller.
 *
 */
class ModuleController extends Controller
{
    /**
     * Lists all Module entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:Module')->findAll();

        return $this->render('OrchestraOrchestraBundle:Module:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    
    public function nextAction($max = 3)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('OrchestraOrchestraBundle:Module', 'a')
          ->orderBy('a.date', 'DESC')
          ->setMaxResults($max);

        $query = $qb->getQuery();
        $tutorats = $query->getResult();

        return $this->render('OrchestraOrchestraBundle:Module:next.html.twig', array(
            'tutorats' => $tutorats,
        ));
    }

    /**
     * Finds and displays a Module entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('Or,chestraOrchestraBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Module:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Module entity.
     *
     */
    public function newAction()
    {
        $entity = new Module();
        $form   = $this->createForm(new ModuleType(), $entity);

        return $this->render('OrchestraOrchestraBundle:Module:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Module entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Module();
        $form = $this->createForm(new ModuleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // CREATEUR DU MODULE
            $user_id = $this->get('security.context')->getToken()->getUser();
            
            $entity->setModuleUser($user_id);
            $entity->setCreated(new \Datetime());
            $entity->setUpdated(new \Datetime());
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('module_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:Module:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Module entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUser()->getId();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getModuleUser()->getId();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('module'), 301);
            }
        }

        $editForm = $this->createForm(new ModuleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:Module:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Module entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ModuleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            $entity->setUpdated(new \Datetime());
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('module_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:Module:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Module entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:Module')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Module entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('module'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
