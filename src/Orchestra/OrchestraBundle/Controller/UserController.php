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
        
        $user = new User();
        
        $formBuilder = $this->createFormBuilder($user);
        
        $formBuilder
                ->add('username', 'text')
                ->add('password', 'password');
        
        $form = $formBuilder->getForm();
        
        $request = $this->get('request');
        
        if ($request->getMethod()=='POST'){
            
           $form->bindRequest($request);
            
           if ($form->isValid()){
                
           $username = $form['username']->getData();
           var_dump($username);
           $password = $form['password']->getData();
           var_dump($password);
           
           var_dump($user->getUsername());
              
           $repository = $this->getDoctrine()->getRepository('OrchestraOrchestraBundle:User');
           $username_bdd = $repository->findBy(array('username' => $user->getUsername()));
           
           if ($username_bdd == true){
               
               echo "le compte existe deja";
               
           }else{
               
               echo "vérifions dans ldap";
               
               $server = "192.168.10.3";
               $port = "389";
               $dn = "uid=".$username.",ou=People,dc=estei";
               $suffix="ou=People,dc=estei";
               $ds=  ldap_connect($server);
                   
                   // ON SE CONNECTE AU SERVEUR LDAP
if ($ds) {

echo "ds ok ";

 //Authentification
    if (ldap_bind($ds)) {

        // Préparation des données
        $value = $username;
        $attr = "uid";

        // Comparaison des valeurs
        $g=@ldap_compare($ds, $dn, $attr, $value);
        var_dump($g);
        
         if ($g === -1) {
            echo "LOGIN PAS OK = UTILISATEUR INEXISTANT, PROPOSER INSCRIPTION ? ";
            
        } elseif ($g === true) {
        
            echo "LOGIN OK ";
            
                    // ON TESTE L'AUTENTIFICATION AU SERVEUR LDAP
                    if($r=@ldap_bind($ds,$dn,$password)) {
                    
                    echo "authent ok ";
                    
                    // ON FILTRE LES CHAMPS A RECUPERER
                    $filtre = array("gecos","mail","sn","givenName","gidNumber", "uidnumber", "uid");
                    
                    $result = ldap_search($ds, $dn,"(uid=*)",$filtre) or die("Error in query");
                    $data = ldap_get_entries($ds, $result);
                    
                    // LOGIN   
                    $uid=$data[0]['uid'][0];
                    var_dump($uid);
                    
                    // PRENOM
                    $givenname=$data[0]['givenname'][0];
                    var_dump($givenname);
                    $user->setFirstname($givenname);
                    
                    // UID NUMBER
                    $uidnbr=$data[0]['uidnumber'][0]; 
                    var_dump($uidnbr); 
                    
                    // NOM
                    $sn=$data[0]['sn'][0];
                    var_dump($sn);
                    $user->setLastname($sn);
                    
                    // NOM prenom
                    $gecos=$data[0]['gecos'][0];
                    var_dump($gecos);
                    $user->setLdap($gecos);
                    
                     // EMAIL - SI EXISTENT, SINON LOGIN + @ESTE.FR
                    //if (isset($data[0]['mail'][0])){
                    $mail=$data[0]['mail'][0];
                    var_dump($mail);
                    $user->setEmail($mail);
                    //}else{
                    //$mail="$login@estei.fr";
                    //var_dump($mail);
                    //}
                    
                    // GID NUMBER
                    $gidNumber=$data[0]['gidnumber'][0];
                    var_dump($gidNumber);
                    
                    
                    $resgroup=ldap_search($ds,"ou=Groups,dc=estei","(gidNumber=$gidNumber)",array("cn"));
                    $group=ldap_get_entries($ds,$resgroup);
                    
                    // GROUPE = CLASSE
                    $namedGroup=$group[0]['cn'][0];
                    var_dump($namedGroup);
                    
                    $user->setPlainPassword($password);
                    
                    // INSCRIPTION EN BDD
                    
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    
                    echo "utilisateur ajoute";
                   
                   
               }else{
                   echo "authentification ldap echouee : mauvais mdp";
               }
        } elseif ($g === false) {
            echo "LOGIN PAS OK = UTILISATEUR INEXISTANT, PROPOSER INSCRIPTION ? ";
        }
// ON FERME LA CONNEXION LDAP
ldap_close($ds);
        
        }

} else {

// CONNEXION AU SERVEUR LDAP ECHOUEE
echo "Impossible de se connecter au serveur LDAP";
}  
               
               
               
           }
           
           }
            
        }
        
        return $this->render('OrchestraOrchestraBundle:User:ldap.html.twig', array('form' => $form->createView(),
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

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
