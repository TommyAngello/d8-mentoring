<?php

namespace Drupal\config_d8_example\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Config Entity Example entity.
 *
 * @ConfigEntityType(
 *   id = "config_entity_example",
 *   label = @Translation("Config Entity Example"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\config_d8_example\ConfigEntityExampleListBuilder",
 *     "form" = {
 *       "add" = "Drupal\config_d8_example\Form\ConfigEntityExampleForm",
 *       "edit" = "Drupal\config_d8_example\Form\ConfigEntityExampleForm",
 *       "delete" = "Drupal\config_d8_example\Form\ConfigEntityExampleDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\config_d8_example\ConfigEntityExampleHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "config_entity_example",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/config_entity_example/config_entity_example/{config_entity_example}",
 *     "add-form" = "/admin/structure/config_entity_example/config_entity_example/add",
 *     "edit-form" = "/admin/structure/config_entity_example/config_entity_example/{config_entity_example}/edit",
 *     "delete-form" = "/admin/structure/config_entity_example/config_entity_example/{config_entity_example}/delete",
 *     "collection" = "/admin/structure/config_entity_example/config_entity_example"
 *   }
 * )
 */
class ConfigEntityExample extends ConfigEntityBase implements ConfigEntityExampleInterface {

  /**
   * The Config Entity Example ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Config Entity Example label.
   *
   * @var string
   */
  protected $label;

}
