<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-14
 * Time: 11:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oh\GoogleMapFormTypeBundle\Traits\LocationTrait;

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
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FieldActivity", inversedBy="tasks")
     * @ORM\JoinColumn(name="field_activity_id", referencedColumnName="id")
     */
    protected $fieldActivity;

    /**
     * @ORM\Column(name="num_answers", type="integer")
     */
    protected $numberOfAnswers;

    /**
     * @ORM\Column(name="lat", type="string")
     */
    protected $lat;

    /**
     * @ORM\Column(name="lng", type="string")
     */
    protected $lng;

    public function __construct()
    {
        $this->numberOfAnswers = 0;
    }

    public function setLatLng($latlng)
    {
        $this->setLat($latlng['lat']);
        $this->setLng($latlng['lng']);
        return $this;
    }

    public function getLatLng()
    {
        return array('lat'=>$this->getLat(),'lng'=>$this->getLng());
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getNumberOfAnswers()
    {
        return $this->numberOfAnswers;
    }

    /**
     * @param mixed $numberOfAnswers
     */
    public function setNumberOfAnswers($numberOfAnswers)
    {
        $this->numberOfAnswers = $numberOfAnswers;
    }

    public function incrementAnswers() {
        $this->numberOfAnswers += 1;
    }

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

    public function __toString()
    {
        return (string) $this->getTaskName();
    }
}