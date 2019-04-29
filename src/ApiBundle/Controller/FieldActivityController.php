<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-07
 * Time: 17:02
 */

namespace ApiBundle\Controller;


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
            $view = $this->view(['error' => 'This field activity does not exist'], Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }
        $view = $this->view(['result' => $field], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Get Field activities of the student.
     *
     * @Route("/student/activities",methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Get Field Activities of the student"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not Found"
     * )
     * @SWG\Tag(name="Field Activities")
     * @Security(name="Bearer")
     */
    public function getFieldActivitiesByStudent()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $studentId = $user->getId();

        $field_activities = $em->getRepository('AppBundle:FieldActivity')->findAll();
        $filtered_activities = [];

        foreach ($field_activities as $field) {
            foreach ($field->getStudents() as $student) {
                if ($student->getId() === $studentId) {
                    array_push($filtered_activities, $field);
                }
            }
        }

        $view = $this->view(['result' => $filtered_activities], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Get tasks of field activity.
     *
     * @Route("/tasks",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Get Tasks"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not Found"
     * )
     * @SWG\Parameter(
     *       name="data",
     *       in="body",
     *       description="ID of the field activity",
     *       required=true,
     *              @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="id", type="number")
     *          )
     *     )
     * @SWG\Tag(name="Field Activities")
     * @Security(name="Bearer")
     */
    public function getTasksOfFieldActivity(Request $request) {
        $fieldActivityId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $field_activity = $em->getRepository('AppBundle:FieldActivity')->find($fieldActivityId);
        $tasks = $field_activity->getTasks();

        $view = $this->view(['result' => $tasks], Response::HTTP_OK);
        return $this->handleView($view);
    }
}