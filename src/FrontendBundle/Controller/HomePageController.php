<?php

namespace FrontendBundle\Controller;

class HomePageController
{
    const POST_COUNT = 3;
    private $em, $templating;

    public function __construct($em, $templating)
    {
        $this->em = $em;
        $this->templating = $templating;
    }

    public function indexAction($page)
    {
        $endRank = $page * self::POST_COUNT;
        $startRank = $endRank - self::POST_COUNT + 1;

        $posts = $this->em
            ->getRepository('FrontendBundle:Post')
            ->getPosts($startRank, $endRank);

        if (count($posts) > self::POST_COUNT) {
            $nextPage = $page + 1;
            array_pop($posts);
        } else {
            $nextPage = False;
        }
        $previousPage = ($page > 1) ? $page - 1 : False;

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
