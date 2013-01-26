<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('contenu')
            /*->add('created')
            ->add('updated')*/
            ->add('file', 'file', array('label' => 'Image'))
            ->add('date', 'datetime', array('widget' => 'choice', 
                'years' => range(date('Y'), date('Y')), 
                'empty_value' => array('year' => 'Année', 
                                       'month' => 'Mois', 
                                       'day' => 'Jour',
                                       'hour' => 'Heure', 
                                       'minute' => 'Minute'
                    ), 
                ))
/*            ->add('commentaire')*/
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Evenement'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_evenementtype';
    }
}
