<?php

namespace FrontendBundle\Controller;

class TopPostsController
{
    private $em, $templating;

    public function __construct($em, $templating)
    {
        $this->em = $em;
        $this->templating = $templating;
    }

    public function indexAction()
    {
        $posts = $this->em
        ->getRepository('FrontendBundle:Post')
        ->getTopPosts();

        return  $this->templating->renderResponse(
            'FrontendBundle:TopPosts:index.html.twig',
            ['posts' => $posts]
        );
    }
}
