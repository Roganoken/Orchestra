<?php


namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface  $builder, array $options)
    {        
        $builder->add('motcle', 'text', array('label' => 'Mot-clé'));
    }
    
    public function getName()
    {        
        return 'usersearch';
    }
}