<?php

namespace Drupal\wilayah_indonesia_province\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Province entities.
 */
class ProvinceViewsData extends EntityViewsData {

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
