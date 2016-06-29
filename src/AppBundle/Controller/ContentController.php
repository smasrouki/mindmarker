<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Content;
use AppBundle\Form\ContentType;

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
     * @Route("/{id}", name="content_show")
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
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return $this->redirectToRoute('content_edit', array('id' => $content->getId()));
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
     * @Route("collapse/{id}", name="content_collapse", options = { "expose" = true })
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
     * @Route("open/{id}", name="content_open", options = { "expose" = true })
     */
    public function openAction(Content $content)
    {
        $content->setCollapsed(false);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('content_index');
    }

    /**
     * Deletes a Content entity.
     *
     * @Route("delete/{id}", name="content_delete", options = { "expose" = true })
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
}
