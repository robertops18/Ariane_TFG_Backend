<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-07
 * Time: 17:02
 */

namespace ApiBundle\Controller;


use AppBundle\Entity\Enum\CheckInEnum;
use AppBundle\Entity\Registry;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\FOSRestController;

class FieldActivityController extends FOSRestController
{
    /** Get all field activities.
     *
     * @Route("/all",methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Get FieldActivity Activities"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not Found"
     * )
     * @SWG\Tag(name="Field Activities")
     * @Security(name="Bearer")
     */
    public function getAllFieldActivitiesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $fieldActivities = $em->getRepository('AppBundle:FieldActivity')->findAll();
        $view = $this->view(['result' => $fieldActivities], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Get field activity by ID.
     *
     * @Route("/{activityId}",methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Get Field Activity"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not Found"
     * )
     * @SWG\Tag(name="Field Activities")
     * @Security(name="Bearer")
     */
    public function getFieldActivityByIdAction($activityId)
    {
        $em = $this->getDoctrine()->getManager();
        $field = $em->getRepository('AppBundle:FieldActivity')->find($activityId);
        if (!$field) {
            $view = $this->view(['error' => 'This field activity does not exist'], Response::HTTP_OK);
            return $this->handleView($view);
        }
        $view = $this->view(['result' => $field], Response::HTTP_OK);
        return $this->handleView($view);
    }
}