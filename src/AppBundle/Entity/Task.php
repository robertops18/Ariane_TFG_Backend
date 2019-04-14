<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity()
 */
class Task extends Base
{
    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $taskName;

    /**
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    /**
     * @ORM\Column(name="question", type="string")
     */
    protected $question;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FieldActivity")
     * @ORM\JoinColumn(name="field_activity_id", referencedColumnName="id")
     */
    protected $fieldActivity;

    /**
     * @return mixed
     */
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * @param mixed $taskName
     */
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getFieldActivity()
    {
        return $this->fieldActivity;
    }

    /**
     * @param mixed $fieldActivity
     */
    public function setFieldActivity($fieldActivity)
    {
        $this->fieldActivity = $fieldActivity;
    }
}