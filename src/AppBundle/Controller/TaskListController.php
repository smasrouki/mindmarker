<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TaskList;
use AppBundle\Form\TaskListType;
use Symfony\Component\HttpFoundation\Response;

/**
 * TaskList controller.
 *
 * @Route("/tasklist")
 */
class TaskListController extends Controller
{
    /**
     * Lists all TaskList entities.
     *
     * @Route("/", name="tasklist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taskLists = $em->getRepository('AppBundle:TaskList')->findAll();

        return $this->render('tasklist/index.html.twig', array(
            'taskLists' => $taskLists,
        ));
    }

    /**
     * Creates a new TaskList entity.
     *
     * @Route("/new/{title}", name="tasklist_new", options = { "expose" = true }, defaults = { "title" = "TODO" })
     * @Method({"GET", "POST"})
     *
     * TODO remove default title
     */
    public function newAction($title)
    {
        $taskList = new TaskList();

        $taskList->setTitle($title);

        $em = $this->getDoctrine()->getManager();
        $em->persist($taskList);
        $em->flush();

        return new Response($taskList->getId());
    }

    /**
     * Finds and displays a TaskList entity.
     *
     * @Route("/{id}", name="tasklist_show")
     * @Method("GET")
     */
    public function showAction(TaskList $taskList)
    {
        $deleteForm = $this->createDeleteForm($taskList);

        return $this->render('tasklist/show.html.twig', array(
            'taskList' => $taskList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TaskList entity.
     *
     * @Route("/{id}/edit/{title}", name="tasklist_edit", options = { "expose" = true }, defaults = { "title" = "TODO" })
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TaskList $taskList, $title)
    {
        $taskList->setTitle($title);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response($taskList->getId());
    }

    /**
     * Deletes a TaskList entity.
     *
     * @Route("/{id}", name="tasklist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TaskList $taskList)
    {
        $form = $this->createDeleteForm($taskList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($taskList);
            $em->flush();
        }

        return $this->redirectToRoute('tasklist_index');
    }

    /**
     * Creates a form to delete a TaskList entity.
     *
     * @param TaskList $taskList The TaskList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TaskList $taskList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tasklist_delete', array('id' => $taskList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function listAction(Subject $subject)
    {
        return $this->render('tasklist/list.html.twig', array(
            'subject' => $subject,
        ));
    }
}
