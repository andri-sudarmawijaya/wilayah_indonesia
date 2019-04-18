<?php

/**
 * @file
 * Contains vilage.page.inc.
 *
 * Page callback for Vilage entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Vilage templates.
 *
 * Default template: vilage.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_vilage(array &$variables) {
  // Fetch Vilage Entity Object.
  $vilage = $variables['elements']['#vilage'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
