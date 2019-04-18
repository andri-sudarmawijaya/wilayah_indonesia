<?php

/**
 * @file
 * Contains province.page.inc.
 *
 * Page callback for Province entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Province templates.
 *
 * Default template: province.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_province(array &$variables) {
  // Fetch Province Entity Object.
  $province = $variables['elements']['#province'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
