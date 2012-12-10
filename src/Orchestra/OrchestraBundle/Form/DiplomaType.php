<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiplomaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName')
            ->add('certificationName')
            ->add('certificationDate')
            ->add('final')
            ->add('created')
            ->add('updated')
            ->add('course')
            ->add('jobOffers')
            ->add('degree')
            ->add('field')
            ->add('speciality')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Diploma'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_diplomatype';
    }
}
