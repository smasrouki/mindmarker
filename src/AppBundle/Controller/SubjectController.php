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

        $subjects = $em->getRepository('AppBundle:Subject')->findAll();

        return $this->render('subject/index.html.twig', array(
            'subjects' => $subjects,
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
     * @Route("/{id}", name="subject_show")
     * @Method("GET")
     */
    public function showAction(Subject $subject)
    {
        $deleteForm = $this->createDeleteForm($subject);

        // To use for archive
        //$this->getDoctrine()->getManager()->getFilters()->disable('softdeleteable');

        // TODO get content from subject
        $contents = $this->getDoctrine()->getRepository('AppBundle:Content')->findAll();

        return $this->render('subject/show.html.twig', array(
            'subject' => $subject,
            'contents' => $contents,
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
     * @Route("/{id}", name="subject_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Subject $subject)
    {
        $form = $this->createDeleteForm($subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subject);
            $em->flush();
        }

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
        $subjects = $this->getDoctrine()->getRepository('AppBundle:Subject')->getRootSubjects();

        return $this->render('subject/list.html.twig', array(
            'subjects' => $subjects,
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
