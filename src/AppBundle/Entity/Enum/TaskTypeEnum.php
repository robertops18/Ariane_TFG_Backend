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
    public static $youtube = 'YOUTUBE';
    public static $test = 'TEST';
    public static $description = 'DESCRIPCIÓN';
    public static $ar = 'AR';
    public static $valoracion = 'VALORACIÓN';
    public static $opinion = 'OPINIÓN';
    public static $audio = 'AUDIO';

    /**
     * @return array
     */
    public static function getEnumArray()
    {
        return array(
            self::$video => 'VIDEO',
            self::$youtube => 'YOUTUBE',
            self::$test => 'TEST',
            self::$description => 'DESCRIPCIÓN',
            self::$ar => 'AR',
            self::$valoracion => 'VALORACIÓN',
            self::$opinion => 'OPINIÓN',
            self::$audio => 'AUDIO',
        );
    }
}