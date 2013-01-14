<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Sex;

class SexAdmin extends Admin {

    protected $baseRouteName = 'sex_admin';
    protected $baseRoutePattern = 'sex';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('gender')
                ->add('title')
                ->add('titleAbbrev')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('gender')
                ->add('title')
                ->add('titleAbbrev')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('gender')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('gender')
                ->add('title')
                ->add('titleAbbrev')
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