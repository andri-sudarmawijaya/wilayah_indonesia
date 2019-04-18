<?php

namespace Drupal\wilayah_indonesia_province;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Province entities.
 *
 * @ingroup wilayah_indonesia_province
 */
class ProvinceListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Province ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\wilayah_indonesia_province\Entity\Province */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.province.edit_form',
      ['province' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
