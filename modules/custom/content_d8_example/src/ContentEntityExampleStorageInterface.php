<?php

namespace Drupal\content_d8_example;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface ContentEntityExampleStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Content Entity Example revision IDs for a specific Content Entity Example.
   *
   * @param \Drupal\content_d8_example\Entity\ContentEntityExampleInterface $entity
   *   The Content Entity Example entity.
   *
   * @return int[]
   *   Content Entity Example revision IDs (in ascending order).
   */
  public function revisionIds(ContentEntityExampleInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Content Entity Example author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Content Entity Example revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\content_d8_example\Entity\ContentEntityExampleInterface $entity
   *   The Content Entity Example entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(ContentEntityExampleInterface $entity);

  /**
   * Unsets the language for all Content Entity Example with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
