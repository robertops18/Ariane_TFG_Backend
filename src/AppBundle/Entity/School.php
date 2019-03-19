<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-03-19
 * Time: 16:11
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="school")
 * @ORM\Entity()
 */
class School extends Base
{
    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $schoolName;

    /**
     * @return mixed
     */
    public function getSchoolName()
    {
        return $this->getSchoolName();
    }

    /**
     * @param mixed $schoolName
     */
    public function setSchoolName($schoolName)
    {
        $this->schoolName = $schoolName;
    }

    public function __toString()
    {
        return $this->getSchoolName();
    }


}