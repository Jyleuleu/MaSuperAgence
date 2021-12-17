<?php

namespace App\Listener;

use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{
    private $cacheManager;
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preRemove,
            Events::preUpdate
        ];
    }

    public function preRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if(!$entity instanceof Property) {
            return;
        } else {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        if(!$entity instanceof Property) {
            return;
        } else {
            if($args->getEntity()->getImageFile() instanceof UploadedFile) {
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
            }           
        }
    }
}
