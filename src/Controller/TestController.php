<?php

namespace Drupal\playground\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Response;

class TestController extends ControllerBase {

  /**
   * Just a test.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The response.
   */
  public function test(): Response {
    $response = new Response();
    $response->setContent('end');
    return $response;
  }

  /**
   * Returns a list of all the dependencies for a given module.
   *
   * @param string $module_name
   *   The name of the module to get dependencies for.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The response.
   */
  public function getDependencies(string $module_name): Response {
    $response = new Response();

    /** @var \Drupal\Core\Config\ConfigManager $config_manager */
    $config_manager = \Drupal::service('config.manager');
    $dependents = $config_manager->findConfigEntityDependenciesAsEntities('module', [$module_name]);
    $names = array_map(fn($dependent) => $dependent->getConfigDependencyName(), $dependents);

    dump($names);
    $response->setContent('end');
    return $response;
  }

  /**
   * Loads an entity and renders it using a view mode.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to render.
   * @param string $view_mode
   *   (optional) The view mode that should be used to render the entity.
   *   Defaults to 'default'.
   *   Example http://{siteUri}/playground/entity/node/1541/default.
   *
   * @return array
   *   A render array.
   */
  public function content(EntityInterface $entity, $view_mode) {
    $output = [];
    $output['#prefix'] = '<div class="contented rhythmic-xxl">';
    $output['#suffix'] = '</div>';

    $title = $this->t('Here is %entity_type entity %entity_id (bundle %bundle) shown using the %view_mode view mode', [
      '%entity_type' => $entity->getEntityTypeId(),
      '%entity_id' => $entity->id(),
      '%bundle' => $entity->bundle(),
      '%view_mode' => $view_mode,
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
