<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 17:25
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FieldAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection) {
        //$collection->remove('show');
        //$collection->remove('create');
        //$collection->remove('export');
    }

    public function getExportFormats() {
        return ['xls'];
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('id')
            ->add('fieldTitle')
            ->add('duration')
            ->add('schoolId')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('fieldTitle')
            ->add('duration')
            ->add('schoolId')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('fieldTitle')
            ->add('duration')
            ->add('schoolId')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('fieldTitle')
            ->add('duration')
            ->add('schoolId')
        ;
    }
}