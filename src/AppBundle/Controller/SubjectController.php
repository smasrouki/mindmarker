<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Subject;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Subject controller.
 *
 * @Route("/subject")
 */
class SubjectController extends Controller
{
    /**
     * Lists all Subject entities.
     *
     * @Route("/", name="subject_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subjects = $em->getRepository('AppBundle:Subject')->findOrdered();

        $subjectList = array();

        foreach($subjects as $subject) {
            $items = array();

            foreach($subject->getContents() as $content) {
                if($content->getDeletedAt() === null) {
                    $items[] = array(
                        'title' => $content->getTitle().' <small><span class="label label-primary">C</span></small>',
                        'id' => $content->getId(),
                        'description' => 'C',
                    );
                }
            }

            foreach($subject->getTasklists() as $tasklist) {
                $items[] = array(
                    'title' => $tasklist->getTitle().' <small><span class="label label-default">T</span></small>',
                    'id' => $tasklist->getId(),
                    'description' => 'T',
                );
            }

            $subjectList[] = array(
                'id' => $subject->getId(),
                'title' => '<a href="'.$this->generateUrl('subject_show', array('id' => $subject->getId())).'">'.$subject->getLabel().'</a>',
                'items' => $items,
                'enableTodoRemove' => false,
                'enableTodoEdit' => false,
            );
        }

        return $this->render('subject/index.html.twig', array(
            'subjects' => json_encode($subjectList),
        ));
    }

    /**
     * Creates a new Subject entity.
     *
     * @Route("/new/{label}", name="subject_new", options = { "expose" = true }, defaults = {"label" = null})
     * @Method({"GET", "POST"})
     */
    public function newAction($label)
    {
        $subject = new Subject();

        $subject->setLabel($label);
        $subject->setParent($this->getDoctrine()->getRepository('AppBundle:Subject')->getRoot());

        $em = $this->getDoctrine()->getManager();
        $em->persist($subject);
        $em->flush();

        return new Response($subject->getId());
    }

    /**
     * Finds and displays a Subject entity.
     *
     * @Route("/{id}", name="subject_show", options = { "expose" = true })
     * @Method("GET")
     */
    public function showAction(Request $request, Subject $subject)
    {
        $request->getSession()->set('subject', $subject->getId());

        $deleteForm = $this->createDeleteForm($subject);

        // To use for archive
        //$this->getDoctrine()->getManager()->getFilters()->disable('softdeleteable');

        // TODO get content from subject
        $firstBlock = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array('subject' => $subject, 'block' => 1), array('order' => 'ASC'));
        $leftBlock = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array('subject' => $subject, 'block' => 2), array('order' => 'ASC'));
        $rightBlock = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array('subject' => $subject, 'block' => 3), array('order' => 'ASC'));

        return $this->render('subject/show.html.twig', array(
            'subject' => $subject,
            'firstBlock' => $firstBlock,
            'leftBlock' => $leftBlock,
            'rightBlock' => $rightBlock,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Subject entity.
     *
     * @Route("/{id}/edit/{label}", name="subject_edit", options = { "expose" = true }, defaults = {"label" = null})
     * @Method({"GET", "POST"})
     */
    public function editAction(Subject $subject, $label)
    {
        $subject->setLabel($label);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response($subject->getId());
    }

    /**
     * Deletes a Subject entity.
     *
     * @Route("/delete/{id}", name="subject_delete")
     */
    public function deleteAction(Request $request, Subject $subject)
    {
        $em = $this->getDoctrine()->getManager();

        $children = $this->getDoctrine()->getRepository('AppBundle:Subject')->getChildren($subject);

        foreach ($children as $child) {
            $em->remove($child);
        }

        $em->remove($subject);
        $em->flush();

        return $this->redirectToRoute('subject_index');
    }

    /**
     * Creates a form to delete a Subject entity.
     *
     * @param Subject $subject The Subject entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subject $subject)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subject_delete', array('id' => $subject->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function listAction(Subject $subject)
    {
        $selectedSubjectHierarchy = array();

        $parent = $subject->getParent();

        while($parent) {
            $selectedSubjectHierarchy[] = $parent->getId();
            $parent = $parent->getParent();
        }

        $subjects = $this->getDoctrine()->getRepository('AppBundle:Subject')->getRootSubjects();

        return $this->render('subject/list.html.twig', array(
            'subjects' => $subjects,
            'selectedSubjectHierarchy' => $selectedSubjectHierarchy,
            'selectedSubject' => $subject,
        ));

    }

    /**
     * Displays a form to edit an existing Subject entity.
     *
     * @Route("/move/{id}/{toId}/{mode}", name="subject_move", options = { "expose" = true }, defaults = {"label" = null})
     * @ParamConverter("target", class="AppBundle:Subject", options={"id" = "toId"})
     */
    public function moveAction(Subject $source, Subject $target, $mode)
    {
        if($mode == 'over') {
            $source->setParent($target);
        }

        if($mode == 'after') {
            $this->getDoctrine()->getRepository('AppBundle:Subject')->persistAsNextSiblingOf($source, $target);
        }

        if($mode == 'before') {
            $this->getDoctrine()->getRepository('AppBundle:Subject')->persistAsPrevSiblingOf($source, $target);
        }

        $this->getDoctrine()->getManager()->flush();

        return new Response('ok');
    }
}
