<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubjectController extends Controller
{
    /**
     * @Route("/subject/list", name="subject_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('subject/list.html.twig', array(
        ));
    }
}
