<?php

namespace Drupal\wilayah_indonesia_district;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of District entities.
 *
 * @ingroup wilayah_indonesia_district
 */
class DistrictListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('District ID');
    $header['name'] = $this->t('Name');
    $header['province'] = $this->t('Province');
    $header['regency'] = $this->t('Regency');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\wilayah_indonesia_district\Entity\District */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.district.edit_form',
      ['district' => $entity->id()]
    );
    $row['province'] = Link::createFromRoute(
      $entity->province_id->entity->label(),
      'entity.province.canonical',
      ['province' => $entity->province_id->target_id]
    );
    $row['regency'] = Link::createFromRoute(
      $entity->regency_id->entity->label(),
      'entity.regency.canonical',
      ['regency' => $entity->regency_id->target_id]
    );
    return $row + parent::buildRow($entity);
  }

}
