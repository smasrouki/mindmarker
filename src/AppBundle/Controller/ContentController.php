<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Content;
use AppBundle\Form\ContentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Content controller.
 *
 * @Route("/content")
 */
class ContentController extends Controller
{
    /**
     * Lists all Content entities.
     *
     * @Route("/", name="content_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contents = $em->getRepository('AppBundle:Content')->findAll();

        return $this->render('content/index.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * Creates a new Content entity.
     *
     * @Route("/new", name="content_new", options = { "expose" = true })
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $content = new Content();

        if($request->isMethod('get') && $request->get('title')) {
            $currentSubject = $this->getDoctrine()->getRepository('AppBundle:Subject')->find($request->getSession()->get('subject'));

            $content->setTitle($request->get('title'));
            $content->setSubject($currentSubject);

            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return new Response($content->getId());
        }

        $form = $this->createForm('AppBundle\Form\ContentType', $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return new Response($content->getId());
        }

        return $this->render('content/new.html.twig', array(
            'content' => $content,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Content entity.
     *
     * @Route("/show/{id}", name="content_show")
     * @Method("GET")
     */
    public function showAction(Content $content)
    {
        $deleteForm = $this->createDeleteForm($content);

        return $this->render('content/show.html.twig', array(
            'content' => $content,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Content entity.
     *
     * @Route("/{id}/edit", name="content_edit", options = { "expose" = true })
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Content $content)
    {
        $deleteForm = $this->createDeleteForm($content);
        $editForm = $this->createForm('AppBundle\Form\ContentType', $content);

        $em = $this->getDoctrine()->getManager();

        if($request->isMethod('get') && $request->get('title')) {
            $content->setTitle($request->get('title'));
            $em->persist($content);
            $em->flush();

            return $this->redirectToRoute('content_edit', array('id' => $content->getId()));
        }

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($content);
            $em->flush();

            return $this->render('content/_value.html.twig', array('content' => $content));
        }

        return $this->render('content/edit.html.twig', array(
            'content' => $content,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Collapse a Content panel.
     *
     * @Route("/collapse/{id}", name="content_collapse", options = { "expose" = true })
     */
    public function collapseAction(Content $content)
    {
        $content->setCollapsed(true);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('content_index');
    }

    /**
     * open a Content panel.
     *
     * @Route("/open/{id}", name="content_open", options = { "expose" = true })
     */
    public function openAction(Content $content)
    {
        $content->setCollapsed(false);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('content_index');
    }

    /**
     * open a Content panel.
     *
     * @Route("/reorder", name="content_reorder", options = { "expose" = true })
     */
    public function reorderAction(Request $request)
    {
        foreach (array('1' => 'firstBlock', '2' => 'leftBlock', '3' => 'rightBlock') as $key => $name) {
            $blockIds = $request->get($name);
            $order = 1;

            if($blockIds) {
                foreach($blockIds as $id)
                {
                    $content = $this->getDoctrine()->getRepository('AppBundle:Content')->find($id);

                    $content->setBlock($key);
                    $content->setOrder($order);

                    $order++;
                }
            }
        }

        $this->getDoctrine()->getManager()->flush();

        return new Response('OK');
    }

    /**
     * Deletes a Content entity.
     *
     * @Route("/delete/{id}", name="content_delete", options = { "expose" = true })
     */
    public function deleteAction(Request $request, Content $content)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($content);
        $em->flush();

        return $this->redirectToRoute('content_index');
    }

    /**
     * Creates a form to delete a Content entity.
     *
     * @param Content $content The Content entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Content $content)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('content_delete', array('id' => $content->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Moves Content entity to another subject
     *
     * @Route("/{id}/change-subject/{subjectId}", name="content_change_subject", options = { "expose" = true })
     * @Method({"GET", "POST"})
     * @ParamConverter("subject", class="AppBundle:Subject", options={"id" = "subjectId"})
     */
    public function changeSubjectAction(Content $content, Subject $subject)
    {
        $content->setSubject($subject);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('ok');
    }
}
