<?php

namespace Orchestra\OrchestraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('website')
            ->add('email')
            ->add('logo')
            ->add('issueDate')
            ->add('siret')
            ->add('siren')
            ->add('isActive')
            ->add('created')
            ->add('updated')
            ->add('field')
            ->add('sector')
            ->add('user')
            ->add('address')
            ->add('legal')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Orchestra\OrchestraBundle\Entity\Company'
        ));
    }

    public function getName()
    {
        return 'orchestra_orchestrabundle_companytype';
    }
}
