<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('date', 'datetime', array('widget' => 'choice', 
                'years' => range(date('Y'), date('Y')), 
                'empty_value' => array('year' => 'Année', 
                                       'month' => 'Mois', 
                                       'day' => 'Jour',
                                       'hour' => 'Heure', 
                                       'minute' => 'Minute'
                    ), 
                ))
            ->add('description')
            ->add('salle', 'entity', array(
    'class' => 'OrchestraOrchestraBundle:Salle',
    'property' => 'numero',))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Module'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_moduletype';
    }
}
