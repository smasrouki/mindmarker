<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/{id}", name="homepage", defaults = {"id"=null})
     */
    public function indexAction(Subject $subject = null, Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'subject' => $subject,
        ));
    }
}
