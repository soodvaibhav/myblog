<?php

namespace AdminBundle\Controller;

class DashBoardController
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
