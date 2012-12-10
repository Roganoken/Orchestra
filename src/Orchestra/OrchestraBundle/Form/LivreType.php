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
            ->add('annee')
            ->add('illustration')
            ->add('dateReservation')
            ->add('dateEmprunt')
            ->add('dateRetour')
            ->add('codeBarre')
            ->add('active')
            ->add('created')
            ->add('updated')
            ->add('commentaire')
            ->add('user')
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
