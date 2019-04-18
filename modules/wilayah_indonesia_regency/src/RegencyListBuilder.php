<?php

namespace Drupal\wilayah_indonesia_regency;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Regency entities.
 *
 * @ingroup wilayah_indonesia_regency
 */
class RegencyListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Regency ID');
    $header['name'] = $this->t('Name');
    $header['province'] = $this->t('Province');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\wilayah_indonesia_regency\Entity\Regency */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.regency.canonical',
      ['regency' => $entity->id()]
    );
    $row['province_id'] = Link::createFromRoute(
      $entity->province_id->entity->label(),
      'entity.province.canonical',
      ['province' => $entity->province_id->target_id]
    );
    return $row + parent::buildRow($entity);
  }

}
