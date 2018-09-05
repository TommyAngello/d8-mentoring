<?php

namespace Drupal\content_d8_example\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Content Entity Example entities.
 */
class ContentEntityExampleViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
