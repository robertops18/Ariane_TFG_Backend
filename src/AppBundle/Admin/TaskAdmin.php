<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:12
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Enum\TaskTypeEnum;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class TaskAdmin extends AbstractAdmin
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
            ->add('taskName')
            ->add('type', null, array('label' => 'Type'), 'choice', array('choices' => TaskTypeEnum::getEnumArray()))
            ->add('description')
            ->add('question')
            ->add('fieldActivity')
            ->add('numberOfAnswers')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('taskName')
            ->add('id')
            ->add('type')
            ->add('question')
            ->add('description')
            ->add('fieldActivity')
            ->add('numberOfAnswers')
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
            ->add('taskName')
            ->add('type', 'choice', array('label' => 'Type', 'choices' => TaskTypeEnum::getEnumArray()))
            ->add('description')
            ->add('question')
            ->add('fieldActivity')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('taskName')
            ->add('type')
            ->add('question')
            ->add('description')
            ->add('fieldActivity')
            ->add('numberOfAnswers')
        ;
    }
}