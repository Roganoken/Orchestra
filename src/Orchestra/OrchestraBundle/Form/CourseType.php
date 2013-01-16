<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fullName')
            ->add('description')
            ->add('exam')
            ->add('program')
            ->add('duration')
            ->add('start')
            ->add('end')
            ->add('coefficient')
            ->add('isQualifying')
            ->add('isFede')
            ->add('diploma')
            ->add('user')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Course'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_coursetype';
    }
}
