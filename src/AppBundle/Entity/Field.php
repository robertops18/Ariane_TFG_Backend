<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 17:17
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Field
 *
 * @ORM\Table(name="field")
 * @ORM\Entity()
 */
class Field extends Base
{
    /**
     * @ORM\Column(name="title", type="string")
     */
    protected $fieldTitle;

    /**
     * @ORM\Column(name="duration", type="string")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    protected $schoolId;

    /**
     * @return mixed
     */
    public function getFieldTitle()
    {
        return $this->fieldTitle;
    }

    /**
     * @param mixed $fieldTitle
     */
    public function setFieldTitle($fieldTitle)
    {
        $this->fieldTitle = $fieldTitle;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getSchoolId()
    {
        return $this->schoolId;
    }

    /**
     * @param mixed $schoolId
     */
    public function setSchoolId($schoolId)
    {
        $this->schoolId = $schoolId;
    }


}