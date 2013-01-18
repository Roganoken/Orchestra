<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\User;
use Orchestra\OrchestraBundle\Form\UserType;
use Orchestra\OrchestraBundle\Form\UserSearchType;
use Orchestra\OrchestraBundle\Form\AvatarType;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        
        $form = $this->container->get('form.factory')->create(new UserSearchType());
        
        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM OrchestraOrchestraBundle:User a";
        $query = $em->createQuery($dql);
        
        $dql2 = "SELECT COUNT(a) FROM OrchestraOrchestraBundle:User a";
        $query2 = $em->createQuery($dql2);
        $count = $query2->getSingleScalarResult();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            4/*limit per page*/
                );
        return $this->render('OrchestraOrchestraBundle:User:index.html.twig', array(
            'entities' => $pagination,
            'total' => $count,
            'form' => $form->createView()
        ));
        
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $address = $entity->getAddress();
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'address'     => $address,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
    /* TEST FORMULAIRE LDAP */
    
    public function ldapAction(Request $request)
    {
        
        $message = '';
        
        # CONSTRUCTION DU FORMULAIRE #
        
        $user = new User();
        
        $formBuilder = $this->createFormBuilder($user);
        
        $formBuilder
                ->add('username', 'text', array('label' => 'Identifiant : '))
                ->add('password', 'password', array('label' => 'Mot de passe : '));
        
        $form = $formBuilder->getForm();
        
        $request = $this->get('request');
        
        if ($request->getMethod()=='POST'){
            
           $form->bindRequest($request);
            
           # ON VERIFIE SI LES DONNEES DU FORMULAIRE SONT BONNES #
           
           if ($form->isValid()){    
           
           # ON RECUPERE LES CHAMPS USERNAME et PASSWORD DU FORMULAIRE  
               
           $username = $form['username']->getData();
           $password = $form['password']->getData();
           
           # ON VERIFIE SI LE PSEUDONYME EXISTE DEJA
           $repository = $this->getDoctrine()->getRepository('OrchestraOrchestraBundle:User');
           $username_bdd = $repository->findBy(array('username' => $user->getUsername()));
           
           if ($username_bdd == true){
               
                $this->get('session')->getFlashBag()->add('notice', $username.' est déjà pris !');
                
           }else{
               
               # SINON ON VERIFIE SUR LDAP 
               
               # ON DECLARE LES VARIABLES DE CONNECTION AU SERVEUR LDAP
               $server = "192.168.10.3";
               $port = "389";
               $dn = "uid=".$username.",ou=People,dc=estei";
               $suffix="ou=People,dc=estei";
               $ds=  ldap_connect($server);
                   
               # ON SE CONNECTE AU SERVEUR LDAP
               if ($ds) {

                 # ON TEST L'AUTHENTIFICATION
                 
                    if (ldap_bind($ds)) {

                        # ON TEST SI LE LOGIN EXISTE SUR LDAP
                        $value = $username;
                        $attr = "uid";
                        $g=@ldap_compare($ds, $dn, $attr, $value);
                        
                        if ($g === -1) {
                            
                            # IL N'EXISTE PAS, ON PEUT PROPOSER UNE INSCRIPTION
                            $message = 'inscription';

                        }elseif ($g === true) {
                            
                                    # SI IL EXISTE, ON TESTE L'AUTENTIFICATION AVEC MDP

                                    if($r=@ldap_bind($ds,$dn,$password)) {

                                    # ON FILTRE LES CHAMPS A RECUPERER
                                    $filtre = array("gecos","mail","sn","givenName","gidNumber", "uidnumber", "uid");

                                    $result = ldap_search($ds, $dn,"(uid=*)",$filtre) or die("Error in query");
                                    $data = ldap_get_entries($ds, $result);

                                    // LOGIN   
                                    $uid=$data[0]['uid'][0];

                                    // PRENOM
                                    $givenname=$data[0]['givenname'][0];

                                    // UID NUMBER
                                    $uidnbr=$data[0]['uidnumber'][0]; 

                                    // NOM
                                    $sn=$data[0]['sn'][0];

                                    // NOM prenom
                                    $gecos=$data[0]['gecos'][0];

                                    // EMAIL
                                    if (isset($data[0]['mail'][0])){
                                    $mail=$data[0]['mail'][0];
                                    }else{
                                    $mail="$username@estei.fr";
                                    }

                                    // GID NUMBER
                                    $gidNumber=$data[0]['gidnumber'][0];

                                    // ON CHERCHE LE NOM DU GROUPE PAR RAPPORT AU GID
                                    $resgroup=ldap_search($ds,"ou=Groups,dc=estei","(gidNumber=$gidNumber)",array("cn"));
                                    $group=ldap_get_entries($ds,$resgroup);

                                    // GROUPE = CLASSE
                                    $namedGroup=$group[0]['cn'][0];

                                    # ON DEFINIE LES ATTRIBUTS DE LA CLASSE USER
                                    $user->setFirstname($givenname);
                                    $user->setLastname($sn);
                                    $user->setLdap($gecos);
                                    $user->setClasse($namedGroup);
                                    $user->setEmail($mail);
                                    $user->setPlainPassword($password);
                                    $user->setEnabled(true);
                                    $user->setCreated(new \Datetime());

                                    # ON PERSISTE L'UTILISATEUR EN BDD

                                    $em = $this->getDoctrine()->getManager();
                                    $em->persist($user);
                                    $em->flush();
                                    
                                    $message = 'ajout_reussi';

                                    }else{
                                        # BON UTILISATEUR MAIS MAUVAIS MDP
                                        echo "authentification ldap echouee : mauvais mdp";
                                    }
                        }elseif ($g === false) {
                            # LE LOGIN N'EXISTE PAS, ON PEUT PROPOSER UNE INSCRIPTION
                            $message = 'inscription';
                        }
                        
                # ON FERME LA CONNEXION LDAP
                ldap_close($ds);

                     }

                } else {

                // CONNEXION AU SERVEUR LDAP ECHOUEE
                    $this->get('session')->getFlashBag()->add('notice', 'Impossible de se connecter au serveur LDAP');
                
                }  
               
           }
           }
            
        }
        
        return $this->render('OrchestraOrchestraBundle:User:ldap.html.twig', 
                array(
                    'form' => $form->createView(),
                    'message' => $message,
            ));
        
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUsername();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getUsername();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('OrchestraOrchestraBundle_profil', array('id' => $id)));
            }
        }
        
        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUsername();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getUsername();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('annuaire'), 301);
            }
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->bind($request);
        
        $entity->setUpdated(new \Datetime());

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('OrchestraOrchestraBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction($id)
    {
    
    /*
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
        
        */
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_welcome'));
    }
    
    public function rechercherAction()
    {
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest())
        {
            $motcle = '';
            $motcle = $request->request->get('motcle');

            $em = $this->container->get('doctrine')->getEntityManager();
            
            if($motcle != '')
            {
                   $qb = $em->createQueryBuilder();

                   $qb->select('a')
                      ->from('OrchestraOrchestraBundle:User', 'a')
                      ->where("LOWER(a.firstname) LIKE :motcle OR LOWER(a.lastname) LIKE :motcle")
                      ->orderBy('a.firstname', 'ASC')
                      ->setParameter('motcle', strtolower($motcle).'%');

                   $query = $qb->getQuery(); 
                   
                   $paginator = $this->get('knp_paginator');
                   $pagination = $paginator->paginate(
                        $query,
                        $this->get('request')->query->get('page', 1)/*page number*/,
                        10/*limit per page*/
                    );
                   
            }
            else {
                return $this->indexAction();
            }

            return $this->container->get('templating')->renderResponse('OrchestraOrchestraBundle:User:liste.html.twig', array(
                'entities' => $pagination
                ));
            
      }
      else {
            return $this->indexAction();
      }
        
        
    }
    
    
    
    /**
     * Gestion des avatars.
     *
     */
    public function avatarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        # RECUPERE LE USERNAME DE SESSION
        $username_session = $this->get('security.context')->getToken()->getUsername();
        
        # RECUPERE LE USERNAME DE L'ENTITE
        $username_entity = $entity->getUsername();
        
        # RECUPERE LE ROLE DE L'ENTITE
        $role_session = $this->get('security.context')->isGranted('ROLE_ADMIN');
        
        # SI LES USERNAME SONT DIFFERENT, ON VERIFIE SI ROLE_ADMIN
        if (($username_session != $username_entity)) {
            # SI PAS ADMIN
            if ($role_session == false){
               # ON REDIRIGE VERS LA PAGE "USER"
               return $this->redirect($this->generateUrl('annuaire'), 301);
            }
        }
        
        $form = $this->createForm(new AvatarType(), $entity);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                
                $entity->uploadProfilePicture();
                
                $em->persist($entity);
                $em->flush();

                $this->redirect($this->generateUrl('user_show', array('id' => $id)));
            }
        }
            
        return $this->render('OrchestraOrchestraBundle:User:avatar.html.twig', 
                array (
                    'entity' => $entity, 
                    'form' => $form->createView()
                    )
                );
        
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    
    
}
