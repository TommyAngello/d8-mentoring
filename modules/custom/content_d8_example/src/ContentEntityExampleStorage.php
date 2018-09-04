<?php

namespace Drupal\content_d8_example;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\content_d8_example\Entity\ContentEntityExampleInterface;

/**
 * Defines the storage handler class for Content Entity Example entities.
 *
 * This extends the base storage class, adding required special handling for
 * Content Entity Example entities.
 *
 * @ingroup content_d8_example
 */
class ContentEntityExampleStorage extends SqlContentEntityStorage implements ContentEntityExampleStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(ContentEntityExampleInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {content_entity_example_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {content_entity_example_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(ContentEntityExampleInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {content_entity_example_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('content_entity_example_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
