<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-06-09
 * Time: 15:38
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Enum\TaskTypeEnum;
use AppBundle\Entity\FieldActivity;
use AppBundle\Entity\Log;
use AppBundle\Entity\StudentsGroup;
use AppBundle\Entity\Task;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntityControllerTest extends WebTestCase
{
    public function testFieldActivity() {
        $fieldTrip = new FieldActivity();
        $fieldTrip->setFieldTitle('Test field trip');
        $user = new User();
        $fieldTrip->setTeacher($user);
        $initDate = new \DateTime();
        $finishDate = new \DateTime();
        $fieldTrip->setInitDate($initDate);
        $fieldTrip->setFinishDate($finishDate);
        $group = new StudentsGroup();
        $group->setGroupName('Group test');
        $fieldTrip->setStudentsGroup($group);

        //Some getters and setters test
        $this->assertNotNull($fieldTrip);
        $this->assertEquals($fieldTrip->getFieldTitle(), 'Test field trip');
        $this->assertEquals($user, $fieldTrip->getTeacher());
        $this->assertEquals($initDate, $fieldTrip->getInitDate());
        $this->assertEquals($finishDate, $fieldTrip->getFinishDate());
        $this->assertEquals($group, $fieldTrip->getStudentsGroup());
        $this->assertEquals($fieldTrip->getStudentsGroup()->getGroupName(), 'Group test');

        //Array test
        $this->assertEmpty($fieldTrip->getTasks());
        $tasks = [];
        $tasks[0] = new Task();
        $fieldTrip->setTasks($tasks);
        $this->assertNotEmpty($fieldTrip->getTasks());
        $this->assertCount(1, $fieldTrip->getTasks());
    }

    public function testTask() {
        $task = new Task();
        $task->setTaskName('Test task');
        $task->setType(TaskTypeEnum::$valoracion);

        //Getters and setters
        $this->assertNotNull($task);
        $this->assertEquals($task->getNumberOfAnswers(), 0);
        $this->assertEquals($task->getTaskName(), 'Test task');
        $this->assertEquals($task->getType(), 'VALORACIÓN');

        $task->incrementAnswers();
        $this->assertEquals($task->getNumberOfAnswers(), 1);
    }

    public function testAnswer() {
        $answer = new Answer();
        $answer->setStudent(new User());
        $answer->setTask(new Task());
        $answer->setFieldActivity(new FieldActivity());
        $answer->setAnswer('Test answer');

        //Getters and setters
        $this->assertNotNull($answer);
        $this->assertNotNull($answer->getStudent());
        $this->assertNotNull($answer->getFieldActivity());
        $this->assertNotNull($answer->getTask());
        $this->assertEquals($answer->getAnswer(), 'Test answer');
    }

    public function testLog() {
        $log = new Log();
        $log->setStudent(new User());
        $log->setTask(new Task());
        $log->setFieldActivity(new FieldActivity());
        $log->setAction('Test log');

        //Getters and setters
        $this->assertNotNull($log);
        $this->assertNotNull($log->getStudent());
        $this->assertNotNull($log->getFieldActivity());
        $this->assertNotNull($log->getTask());
        $this->assertEquals($log->getAction(), 'Test log');
    }
}