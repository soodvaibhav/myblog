<?php

namespace FrontendBundle\Controller;

class PostPageController
{
    private $em, $templating;

    public function __construct($em, $templating)
    {
        $this->em = $em;
        $this->templating = $templating;
    }

    public function indexAction($name)
    {
        $post = $this->em
        ->getRepository('FrontendBundle:Post')
        ->findOneByName($name);

        return  $this->templating->renderResponse(
            'FrontendBundle:PostPage:index.html.twig',
            ['post' => $post]
        );
    }
}
