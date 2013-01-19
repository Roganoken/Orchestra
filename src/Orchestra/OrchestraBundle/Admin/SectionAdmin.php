<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\Section;

class SectionAdmin extends Admin {

    protected $baseRouteName = 'section_admin';
    protected $baseRoutePattern = 'section';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('name')
                ->add('description')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('name')
                ->add('description')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('name')
                ->add('description')
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