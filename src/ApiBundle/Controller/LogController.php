<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-15
 * Time: 17:43
 */

namespace ApiBundle\Controller;


use AppBundle\Entity\Answer;
use AppBundle\Entity\Log;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\FOSRestController;

class LogController extends FOSRestController
{
    /** Creates an answer for the related task.
     *
     * @Route("/{taskId}",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Log for task created"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Error creating the log"
     * )
     * @SWG\Parameter(
     *       name="data",
     *       in="body",
     *       description="Action performed",
     *       required=true,
     *              @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="action", type="string"),
     *              @SWG\Property(property="lat", type="float"),
     *              @SWG\Property(property="lng", type="float")
     *          )
     *     )
     * @SWG\Tag(name="Logs")
     * @Security(name="Bearer")
     */
    public function createLogAction(Request $request, $taskId)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AppBundle:Task')->find($taskId);
        $user = $this->getUser();

        if (!$task) {
            $view = $this->view(['error' => 'This task does not exist'], Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $action = $request->get('action');
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        $log = new Log();
        $log->setAction($action);
        $log->setStudent($user);
        $log->setTask($task);
        $log->setFieldActivity($task->getFieldActivity());
        $log->setLatitude($lat);
        $log->setLongitude($lng);

        $em->persist($log);
        $em->flush();

        $view = $this->view(['action' => 'Action correctly saved'], Response::HTTP_OK);
        return $this->handleView($view);
    }
}