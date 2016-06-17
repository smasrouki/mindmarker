<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Task controller.
 *
 * @Route("/task")
 */
class TaskController extends Controller
{
    /**
     * Lists all Task entities.
     *
     * @Route("/", name="task_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('AppBundle:Task')->findAll();

        return $this->render('task/index.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    /**
     * Creates a new Task entity.
     *
     * @Route("/new", name="task_new", options = { "expose" = true })
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('AppBundle\Form\TaskType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_show', array('id' => $task->getId()));
        }

        return $this->render('task/new.html.twig', array(
            'task' => $task,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Task entity.
     *
     * @Route("/{id}", name="task_show")
     * @Method("GET")
     */
    public function showAction(Task $task)
    {
        $deleteForm = $this->createDeleteForm($task);

        return $this->render('task/show.html.twig', array(
            'task' => $task,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     * @Route("/{id}/edit", name="task_edit", options = { "expose" = true })
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Task $task)
    {
        $deleteForm = $this->createDeleteForm($task);
        $editForm = $this->createForm('AppBundle\Form\TaskType', $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_edit', array('id' => $task->getId()));
        }

        return $this->render('task/edit.html.twig', array(
            'task' => $task,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Task entity.
     *
     * @Route("/delete/{id}", name="task_delete", options = { "expose" = true })
     */
    public function deleteAction(Request $request, Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('task_index');
    }

    /**
     * Creates a form to delete a Task entity.
     *
     * @param Task $task The Task entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Task $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('id' => $task->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Mark Task as done
     *
     * @Route("/do/{id}", name="task_do", options = { "expose" = true })
     */
    public function doAction(Task $task)
    {
        $task->setDone(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response($task->getTaskList()->getStatus() ? 'done' : '');
    }

    /**
     * Mark Task as undone
     *
     * @Route("/undo/{id}", name="task_undo", options = { "expose" = true })
     */
    public function undoAction(Task $task)
    {
        $task->setDone(false);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response($task->getTaskList()->getStatus() ? 'done' : '');
    }

    /**
     * Move task to a new position and reoder the list
     *
     * @Route("/move/{id}/{taskListId}/{newPosition}", name="task_move", options = { "expose" = true })
     */
    public function moveAction($taskListId, Task $movedTask, $newPosition)
    {
        $oldPosition = $movedTask->getNumber();

        $taskList = $movedTask->getTaskList();

        if($movedTask->getNumber() > $newPosition){
            foreach ($taskList->getTasks() as $task) {
                if($task->getNumber() >= $newPosition and $task->getNumber() < $oldPosition) {
                    $task->setNumber($task->getNumber() + 1);
                }
            }
        } else {
            foreach ($taskList->getTasks() as $task) {
                if($task->getNumber() <= $newPosition and $task->getNumber() > $oldPosition) {
                    $task->setNumber($task->getNumber() - 1);
                }
            }
        }

        $movedTask->setNumber($newPosition);

        $this->getDoctrine()->getManager()->flush();

        return new Response('ok');
    }
}
