<?php

namespace FrontendBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use FrontendBundle\Entity\Post;

class PostListener
{
    private $imageThumbnailService;

    public function __construct($imageThumbnailService)
    {
        $this->imageThumbnailService = $imageThumbnailService;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Post) {
            return;
        }

        $content = $entity->getContent();
        $title = $entity->getTitle();
        $entity->setDateTime(new \DateTime());

        $image = $this->getImage($content);
        if (strlen($image) > 0) {
            $entity->setImage($image);
            $this->imageThumbnailService->generateThmbnails($image);
        }

        $name = preg_replace('/[^A-Za-z0-9\-]/', '-', $title);
        $entity->setName($name);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Post) {
            return;
        }

        if ($args->hasChangedField('content')) {
            $image = $this->getImage($entity->getContent());
            if (strlen($image) > 0) {
                if ($entity->getImage() != $image) {
                    $this->imageThumbnailService->generateThmbnails($image);
                }
                $entity->setImage($image);
            }
        }

        if ($args->hasChangedField('title')) {
            $name = preg_replace('/[^A-Za-z0-9\-]/', '-', $entity->getTitle());
            $entity->setName($name);
        }

        if ($args->hasChangedField('status') && 'publish' === $entity->getStatus()) {
            $entity->setDateTime(new \DateTime());
        }
    }

    private function getImage($content)
    {
        preg_match('/([a-z\-_0-9\/\:\.]*\.(jpg|jpeg|png|gif))/i', $content, $matches);
        if (!empty($matches)) {
            return $matches[1];
        }
        return '';
    }
}
