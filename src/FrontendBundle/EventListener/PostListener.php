<?php

namespace FrontendBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use FrontendBundle\Entity\Post;

class PostListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Post) {
            return;
        }

        $content = $entity->getContent();
        $title = $entity->getTitle();

        $image = $this->getImage($content);
        if (strlen($image) > 0) {
            $entity->setImage($image);
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
            $image = $this->getImage($content);
            if (strlen($image) > 0) {
                $entity->setImage($image);
            }
        }

        if ($args->hasChangedField('title')) {
            $name = preg_replace('/[^A-Za-z0-9\-]/', '-', $entity->getTitle());
            $entity->setName($name);
        }
    }

    private function getImage($content)
    {
        preg_match('/src="([^"]*)"/i', $content, $matches);
        if (!empty($matches)) {
            return $matches[1];
        }
        return '';
    }
}
