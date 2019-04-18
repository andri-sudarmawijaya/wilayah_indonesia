<?php

/**
 * @file
 * Contains regency.page.inc.
 *
 * Page callback for Regency entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Regency templates.
 *
 * Default template: regency.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_regency(array &$variables) {
  // Fetch Regency Entity Object.
  $regency = $variables['elements']['#regency'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
