<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashBoardController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:DashBoard:index.html.twig');
    }
}
