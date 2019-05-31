<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-05-05
 * Time: 17:52
 */

namespace AppBundle\Entity\Enum;


class TaskTypeEnum extends BaseEnum
{
    public static $video = 'VIDEO';
    public static $test = 'TEST';
    public static $description = 'DESCRIPCIÓN';
    public static $ar = 'AR';
    public static $valoracion = 'VALORACIÓN';
    public static $opinion = 'OPINIÓN';
    /**
     * @return array
     */
    public static function getEnumArray()
    {
        return array(
            self::$video => 'VIDEO',
            self::$test => 'TEST',
            self::$description => 'DESCRIPCIÓN',
            self::$ar => 'AR',
            self::$valoracion => 'VALORACIÓN',
            self::$opinion => 'OPINIÓN',
        );
    }
}