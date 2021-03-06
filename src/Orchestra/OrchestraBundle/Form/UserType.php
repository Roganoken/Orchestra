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
            ->add('birthdate')
            ->add('photo')
            ->add('email')
            ->add('phone')
            ->add('mobilePhone')
            ->add('ldap')
            ->add('connected')
            ->add('created')
            ->add('updated')
            ->add('isProfesseur')
            ->add('isEleve')
            ->add('isContact')
            ->add('access')
            ->add('company')
            ->add('course')
            ->add('position')
            ->add('image')
            ->add('livre')
            ->add('module')
            ->add('address')
            ->add('sex')
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
