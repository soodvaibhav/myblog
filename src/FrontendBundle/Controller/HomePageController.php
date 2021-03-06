<?php

namespace FrontendBundle\Controller;

class HomePageController
{
    const POST_COUNT = 10;
    private $em, $templating;

    public function __construct($em, $templating)
    {
        $this->em = $em;
        $this->templating = $templating;
    }

    public function indexAction($page)
    {
        $posts = $this->em
        ->getRepository('FrontendBundle:Post')
        ->getPostList($page);

        if (count($posts) > self::POST_COUNT) {
            $nextPage = $page + 1;
            array_pop($posts);
        } else {
            $nextPage = False;
        }
        $previousPage = ($page > 1) ? $page - 1 : False;

        foreach ($posts as $key => $post) {
            $posts[$key]['content'] = substr(strip_tags($post['content']), 0, 300);
        }

        return  $this->templating->renderResponse(
        'FrontendBundle:HomePage:index.html.twig',
        [
            'posts' => $posts,
            'nextPage' => $nextPage,
            'previousPage' => $previousPage,
        ]
    );
}
}
