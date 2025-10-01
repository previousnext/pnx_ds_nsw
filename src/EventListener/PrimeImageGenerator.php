<?php

declare(strict_types=1);

namespace Drupal\pnx_ds_nsw\EventListener;

use PreviousNext\Ds\Common\Component\Media\Image\Image;
use PreviousNext\IdsTools\ImageGeneration\DrupalImageGenerator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class PrimeImageGenerator implements EventSubscriberInterface {

  public static function getSubscribedEvents(): array {
    return [
      KernelEvents::REQUEST => ['onRequest', 100],
    ];
  }

  public function onRequest(RequestEvent $event): void {
    Image::setImageGenerator(DrupalImageGenerator::class);
  }

}
