<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Genre;

class GenreAdmin extends Admin {

    protected $baseRouteName = 'genre_admin';
    protected $baseRoutePattern = 'genre';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('libelle')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('libelle')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('libelle')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('libelle')
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
