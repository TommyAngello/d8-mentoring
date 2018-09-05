<?php

namespace Drupal\content_d8_example;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Content Entity Example entities.
 *
 * @ingroup content_d8_example
 */
class ContentEntityExampleListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Content Entity Example ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\content_d8_example\Entity\ContentEntityExample */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.content_entity_example.edit_form',
      ['content_entity_example' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
