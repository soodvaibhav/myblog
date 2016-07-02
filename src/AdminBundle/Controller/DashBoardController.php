<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashBoardController extends Controller
{
	private $templating;

	public function __construct($templating)
	{
		$this->templating = $templating;
	}

    public function indexAction()
    {
        return  $this->templating->renderResponse('AdminBundle:DashBoard:index.html.twig');
    }
}
