<?php

namespace Drupal\content_d8_example;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Content Entity Example entity.
 *
 * @see \Drupal\content_d8_example\Entity\ContentEntityExample.
 */
class ContentEntityExampleAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\content_d8_example\Entity\ContentEntityExampleInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished content entity example entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published content entity example entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit content entity example entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete content entity example entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add content entity example entities');
  }

}
