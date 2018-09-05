<?php

namespace Drupal\content_d8_example\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Content Entity Example entities.
 *
 * @ingroup content_d8_example
 */
interface ContentEntityExampleInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Content Entity Example name.
   *
   * @return string
   *   Name of the Content Entity Example.
   */
  public function getName();

  /**
   * Sets the Content Entity Example name.
   *
   * @param string $name
   *   The Content Entity Example name.
   *
   * @return \Drupal\content_d8_example\Entity\ContentEntityExampleInterface
   *   The called Content Entity Example entity.
   */
  public function setName($name);

  /**
   * Gets the Content Entity Example creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Content Entity Example.
   */
  public function getCreatedTime();

  /**
   * Sets the Content Entity Example creation timestamp.
   *
   * @param int $timestamp
   *   The Content Entity Example creation timestamp.
   *
   * @return \Drupal\content_d8_example\Entity\ContentEntityExampleInterface
   *   The called Content Entity Example entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Content Entity Example published status indicator.
   *
   * Unpublished Content Entity Example are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Content Entity Example is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Content Entity Example.
   *
   * @param bool $published
   *   TRUE to set this Content Entity Example to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\content_d8_example\Entity\ContentEntityExampleInterface
   *   The called Content Entity Example entity.
   */
  public function setPublished($published);

  /**
   * Gets the Content Entity Example revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Content Entity Example revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\content_d8_example\Entity\ContentEntityExampleInterface
   *   The called Content Entity Example entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Content Entity Example revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Content Entity Example revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\content_d8_example\Entity\ContentEntityExampleInterface
   *   The called Content Entity Example entity.
   */
  public function setRevisionUserId($uid);

}
