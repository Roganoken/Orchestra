<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Livre;

class LivreAdmin extends Admin {

    protected $baseRouteName = 'livre_admin';
    protected $baseRoutePattern = 'livre';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
            ->add('isbn')
            ->add('titre') 
            ->add('annee','date')
            ->add('active')
            ->add('auteur')
            ->add('genre')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('isbn')
            ->add('titre') 
            ->add('resume')
            ->add('annee','date')
            ->add('illustration')
            ->add('dateReservation','date', array('required' => false,))  
            ->add('dateEmprunt','date', array('required' => false,))
            ->add('dateRetour','date', array('required' => false,))
            ->add('codeBarre')
            ->add('active')
            ->add('created','date', array('required' => false,))
            ->add('auteur')
            ->add('genre')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('titre')
                ->add('auteur')
                ->add('genre')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('isbn')
            ->add('titre') 
            ->add('annee','date')
            ->add('active')
            ->add('auteur')
            ->add('genre')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
        ;
    }

}
