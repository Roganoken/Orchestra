<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('password')
            ->add('classe')
            ->add('birthdate', 'birthday', array('widget' => 'choice', 'format' => 'yyyy-MM-dd'))
            ->add('photo')
            ->add('email')
            ->add('phone')
            ->add('mobilePhone')
            //->add('ldap')
            //->add('roles', 'choice', array('label' => 'Rôles : ', 'choices'=> array('ROLE_ADMIN' => 'Admin', 'ROLE_USER' => 'Utilisateur')))
            
            //->add('connected')
            
            //->add('created', 'datetime', array('widget' => 'choice', 'format' => 'yyyy-M-dd HH:mm:ss'))
            //->add('updated', 'datetime', array('widget' => 'choice', 'format' => 'yyyy-MM-dd HH:mm:ss'))
            
             ->add('isProfesseur', 'checkbox', array('required' => false,))
             ->add('isEleve', 'checkbox', array('required' => false,))
             ->add('isContact', 'checkbox', array('required' => false,))
//             ->add('access')
//             ->add('company')
//             ->add('course')
//             ->add('position')
//             ->add('image')
//             ->add('livre')
//             ->add('module')
//             ->add('address')
//             ->add('sex')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_usertype';
    }
}
