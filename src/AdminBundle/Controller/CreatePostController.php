<?php

namespace AdminBundle\Controller;

Class CreatePostController
{
	private $templating;

	public function __construct($templating)
	{
		$this->templating = $templating;
	}

	public function indexAction()
	{
		return $this->templating->renderResponse('AdminBundle::base.html.twig');
	}
}