<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 16:14
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class StudentsGroupAdmin extends AbstractAdmin
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
            ->add('groupName')
            ->add('createdAt')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('groupName')
            ->add('students')
            ->add('createdAt')
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
            ->add('groupName')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('groupName')
            ->add('students')
            ->add('createdAt')
        ;
    }
}