<?php
/**
 * Created by PhpStorm.
 * User: robertoperez
 * Date: 2019-04-15
 * Time: 17:43
 */

namespace ApiBundle\Controller;


use AppBundle\Entity\Answer;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\FOSRestController;

class AnswerController extends FOSRestController
{
    /** Creates an answer for the related task.
     *
     * @Route("/{taskId}",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Task answered"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Error answering the task"
     * )
     * @SWG\Parameter(
     *       name="data",
     *       in="body",
     *       description="Answer to the task",
     *       required=true,
     *              @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="answer", type="string")
     *          )
     *     )
     * @SWG\Tag(name="Answers")
     * @Security(name="Bearer")
     */
    public function answerTaskAction(Request $request, $taskId)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AppBundle:Task')->find($taskId);
        $user = $this->getUser();

        if (!$task) {
            $view = $this->view(['error' => 'This task does not exist'], Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $answer_body = $request->get('answer');

        $answer = new Answer();
        $answer->setAnswer($answer_body);
        $answer->setStudent($user);
        $answer->setTask($task);

        $task->incrementAnswers();

        $em->persist($answer);
        $em->flush();

        $view = $this->view(['answer' => 'Task correctly answered'], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Gets the answer for the related task.
     *
     * @Route("/{taskId}",methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Answer to the task"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Error getting the answer to the task"
     * )
     * @SWG\Tag(name="Answers")
     * @Security(name="Bearer")
     */
    public function getAnswerForTask($taskId) {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AppBundle:Task')->find($taskId);
        $user = $this->getUser();

        $answer = $em->getRepository('AppBundle:Answer')->findBy(array('task' => $task, 'student' => $user));

        $view = $this->view(['answer' => $answer[0]->getAnswer()], Response::HTTP_OK);
        return $this->handleView($view);
    }
}