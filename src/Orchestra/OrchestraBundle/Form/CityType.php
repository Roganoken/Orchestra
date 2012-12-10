<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postalCode')
            ->add('ucArt')
            ->add('ucName')
            ->add('art')
            ->add('name')
            ->add('department')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\City'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_citytype';
    }
}
