<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AvatarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
       {
           $builder
               ->add('file')

           ;
       }

       public function getName()
       {
           return 'orchestra_orchestrabundle_avatartype';
       }
}