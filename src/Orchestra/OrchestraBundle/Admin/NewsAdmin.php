<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\News;

class NewsAdmin extends Admin {

    protected $baseRouteName = 'news_admin';
    protected $baseRoutePattern = 'news';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
            ->add('title')
            ->add('content')
            ->add('active')
            ->add('section')
            ->add('user')
            ->add('created')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('title')
            ->add('content')
            ->add('active')
            ->add('section', 'entity', array(
                             'class' => 'OrchestraOrchestraBundle:Section',
                             'property' => 'name'))
            ->add('user', 'entity', array(
                             'class' => 'OrchestraOrchestraBundle:User',
                             'property' => 'lastname',
                             'required' => true))
            ->add('created', 'datetime',array('widget' => 'choice', 
                             'data'  => date_create()   
                        )) 
            ->add('updated', 'datetime', array('required' => false,))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('title')
            ->add('active')
            ->add('user')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('title')
            ->add('content')
            ->add('active')
            ->add('section')
            ->add('user')
            ->add('created')
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
