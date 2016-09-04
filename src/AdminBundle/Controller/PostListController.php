<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostListController
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getPostListAction(Request $request)
    {
        $page = (int) $request->query->get('page');
        $repository = $this->em->getRepository('FrontendBundle:Post');
        $posts = $repository->getPostList($page);

        return new JsonResponse($posts);
    }
}
