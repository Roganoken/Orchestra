<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Auteur;

class AuteurAdmin extends Admin {

    protected $baseRouteName = 'auteur_admin';
    protected $baseRoutePattern = 'auteur';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('prenom')
                ->add('nom')
                ->add('date_naissance')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('prenom')
                ->add('nom')
                ->add('date_naissance', 'birthday', array('widget' => 'choice', 'years' => range(date('Y') - 110, date('Y')), 'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'), 'required' => false,))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('nom')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('prenom')
                ->add('nom')
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
