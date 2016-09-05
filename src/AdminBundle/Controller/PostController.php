<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use AdminBundle\Form\PostForm;

class PostController
{
    private $formFactory, $requestStack, $em;

    public function __construct($formFactory, $requestStack, $em)
    {
        $this->formFactory = $formFactory;
        $this->request = $requestStack->getCurrentRequest();
        $this->em = $em;
    }

    public function postAction()
    {
        $attributes = json_decode($this->request->getContent(), true);
        $form = $this->formFactory->create(PostForm::class);
        $form->submit($attributes);
        if ($form->isValid()) {
            $post = $form->getData();
            $this->em->persist($post);
            $this->em->flush();
            return new JsonResponse(['id' => $post->getId()]);
        } else {
            $errors = $this->getErrorMessages(iterator_to_array($form->getErrors()));
            return new JsonResponse($errors, 400);
        }
    }

    public function putAction($id)
    {
        $repository = $this->em->getRepository('FrontendBundle:Post');
        $post = $repository->find($id);

        if (!$post) {
            return new JsonResponse(['Post does not exist.. :('], 400);
        }

        $attributes = json_decode($this->request->getContent(), true);
        $form = $this->formFactory->create(PostForm::class);
        $form->submit($attributes);
        if ($form->isValid()) {
            $post->setContent($attributes['content']);
            $post->setTitle($attributes['title']);
            $this->em->persist($post);
            $this->em->flush();
            return new JsonResponse(['id' => $post->getId()]);
        } else {
            $errors = $this->getErrorMessages(iterator_to_array($form->getErrors()));
            return new JsonResponse($errors, 400);
        }
    }

    public function getAction($id)
    {
        $repository = $this->em->getRepository('FrontendBundle:Post');
        $post = $repository->getPost($id);
        return new JsonResponse($post[0]);
    }

    private function getErrorMessages($errors)
    {
        $errorMessages = array();
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }
        return $errorMessages;
    }
}
