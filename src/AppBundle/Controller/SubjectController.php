<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use AppBundle\Form\SubjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubjectController extends Controller
{
    /**
     * @Route("/subject/list/", name="subject_list")
     */
    public function listAction(Subject $subject = null, Request $request)
    {
        $form = $this->getForm();

        $subjects = $this->get('subject_manager')->childrenHierarchy();

        return $this->render('subject/list.html.twig', array(
            'form' => $form->createView(),
            'subjects' => json_encode($subjects),
            'selectedSubject' => $subject,
        ));
    }

    /**
     * @Route("/subject/new", name="subject_new")
     */
    public function newAction(Request $request)
    {
        $subject = new Subject();

        $form = $this->getForm($subject);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($subject);
            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('subject/list.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    protected function getForm($subject = null)
    {
        if (null === $subject) {
            $subject = new Subject();
        }

        $form = $this->createForm(new SubjectType(), $subject, array(
            'action' => $this->generateUrl('subject_new'),
            'method' => 'post',
        ));

        return $form;
    }
}
