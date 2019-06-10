<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:12
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Enum\TaskTypeEnum;
use Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

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
            ->add('fieldActivity')
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
            ->add('imageUrl', null, array('label' => 'Image URL'))
            ->add('latitude')
            ->add('longitude')
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
        //$googlemap = new GoogleMapType("AIzaSyAvAte5AxaesDDFEULrtH4vfn4QGyGd60Y");
        $formMapper
            ->add('fieldActivity')
            ->add('taskName')
            ->add('type', 'choice', array('label' => 'Type', 'choices' => TaskTypeEnum::getEnumArray()))
            ->add('description')
            ->add('question', null, array('label' => 'Question (URL if video or audio)'))
            ->add('imageUrl', null, array('label' => 'Image URL'))
            ->add('options', null, array('label' => 'Options of the question (separated by semi-column (;))'))
            ->add('correctAnswer', null, array('label' => 'Correct option of the previous ones'))
            ->add('latlng', GoogleMapType::class,
                array(
                    'label' => 'Position in map',
                    'type' => 'text',
                    'addr_type' => HiddenType::class,
                    'search_enabled' => false,
                    'addr_options' => array('required' => false)
                ))
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
            ->add('latitude')
            ->add('longitude')
        ;
    }
}