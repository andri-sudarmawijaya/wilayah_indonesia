<?php

namespace Drupal\wilayah_indonesia_regency\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Regency entities.
 */
class RegencyViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
