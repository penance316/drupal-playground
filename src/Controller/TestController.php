<?php

namespace Drupal\playground\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Response;

class TestController extends ControllerBase {


  public function test() {
    $response = new Response();
    $response->setContent('just testing....');
    return $response;
  }

  /**
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to render.
   * @param string $view_mode
   *   (optional) The view mode that should be used to render the entity.
   *   Defaults to 'default'.
   * Example http://{siteUri}/playground/test/node/1541/default
   *
   * @return array
   */
  public function content(EntityInterface $entity, $view_mode) {
    $output = [];
    $output['#prefix'] = '<div class="contented rhythmic-xxl">';
    $output['#suffix'] = '</div>';

    $title = $this->t('Here is %entity_type entity %entity_id (bundle %bundle) shown using the %view_mode view mode', [
      '%entity_type' => $entity->getEntityTypeId(),
      '%entity_id'   => $entity->id(),
      '%bundle'      => $entity->bundle(),
      '%view_mode'   => $view_mode,
    ]);

    $output['entity_header'] = [
      '#markup' => '<h1>' . $title . '</h1>',
      '#prefix' => '<div class="rhythmic-l">',
      '#suffix' => '</div>',
    ];

    $output['entity'] = \Drupal::entityTypeManager()
      ->getViewBuilder($entity->getEntityTypeId())
      ->view($entity, $view_mode);

    return $output;
  }

}
