<?php

/**
 * @file
 * Contains content_entity_example.page.inc.
 *
 * Page callback for Content Entity Example entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Content Entity Example templates.
 *
 * Default template: content_entity_example.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_content_entity_example(array &$variables) {
  // Fetch ContentEntityExample Entity Object.
  $content_entity_example = $variables['elements']['#content_entity_example'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
