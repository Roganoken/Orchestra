<?php

namespace Orchestra\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Orchestra\OrchestraBundle\Entity\User;
use Orchestra\OrchestraBundle\Form\UserType;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrchestraOrchestraBundle:User')->findAll();

        return $this->render('OrchestraOrchestraBundle:User:index.html.twig', array(
            'entities' => $entities,
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OrchestraOrchestraBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('OrchestraOrchestraBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
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
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new User();
        $form = $this->createForm(new UserType(), $entity);
        $form->bind($request);
        $password = $form['password']->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setPlainPassword($password);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }

        return $this->render('OrchestraOrchestraBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->bind($request);
        $password = $editForm['password']->getData();
        $entity->setPlainPassword($password);
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
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrchestraOrchestraBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
