<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isbn')
            ->add('titre') 
            ->add('resume')
            ->add('annee','date')
            ->add('illustration')
            ->add('dateReservation','date')  
            ->add('dateEmprunt','date')
            ->add('dateRetour','date')
            ->add('codeBarre')
            ->add('active')
            
            ->add('created','date')
            
//        		->add('created', 'date', array('widget' => 'choice',
//         		'input' => 'timestamp',
//         		'format' => 'y-M-d',
//         		'empty_value' => array('day' => 'Jour', 'month' => 'Mois','year' => 'Année' ),
//         		'pattern' => "{{ year }}/{{ month }}/{{ day }}",
//         		'data_timezone' => "Europe/Paris",
//         		'user_timezone' => "Europe/Paris"))      
        
            //->add('updated','date')         
            //->add('commentaire')      
            //->add('user')
            ->add('auteur')
            ->add('genre')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Livre'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_livretype';
    }
}
