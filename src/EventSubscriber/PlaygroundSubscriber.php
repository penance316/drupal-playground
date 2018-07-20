<?php

namespace Drupal\playground\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class PlaygroundSubscriber implements EventSubscriberInterface {

  /**
   * Execute some code.
   */
  public function executeSomeCode() {
    playground_init();
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('executeSomeCode');
    return $events;
  }
}
