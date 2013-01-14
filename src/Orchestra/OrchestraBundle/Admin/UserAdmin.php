<?php

namespace Orchestra\OrchestraBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Orchestra\OrchestraBundle\Entity\User;

class UserAdmin extends Admin {

    protected $baseRouteName = 'user_admin';
    protected $baseRoutePattern = 'user';

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('firstname')
                ->add('lastname')
                ->add('username')
                ->add('classe')
                ->add('email')
                ->add('phone')
                ->add('mobilePhone')
                ->add('birthdate','date')
                ->add('isProfesseur')
                ->add('isEleve')
                ->add('isContact')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('firstname')
                ->add('lastname')
                ->add('username')
                ->add('classe')
                ->add('email')
                ->add('phone')
                ->add('mobilePhone')
                ->add('plainPassword', 'text', array('required' => false,))
                ->add('birthdate', 'birthday', array('widget' => 'choice', 'years' => range(date('Y') - 110, date('Y')), 'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'), 'required' => false,))
                ->add('isProfesseur', 'checkbox', array('required' => false,))
                ->add('isEleve', 'checkbox', array('required' => false,))
                ->add('isContact', 'checkbox', array('required' => false,))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('firstname')
                ->add('lastname')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('firstname')
                ->add('lastname')
                ->add('username')
                ->add('classe')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                        )
        );
    }

}