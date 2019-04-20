<?php

namespace Drupal\wilayah_indonesia_vilage;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Vilage entities.
 *
 * @ingroup wilayah_indonesia_vilage
 */
class VilageListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Vilage ID');
    $header['name'] = $this->t('Name');
    $header['province'] = $this->t('Province');
    $header['regency'] = $this->t('Regency');
    $header['district'] = $this->t('District');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\wilayah_indonesia_vilage\Entity\Vilage */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.vilage.canonical',
      ['vilage' => $entity->id()]
    );
	if($entity->province_id->entity){
      $row['province'] = Link::createFromRoute(
        $entity->province_id->entity->label(),
        'entity.province.canonical',
        ['province' => $entity->district_id->entity->regency_id->entity->province_id->target_id]
      );
	}
	else{
		$row['province'] = NULL;
	}
	if($entity->regency_id->entity){
      $row['regency'] = Link::createFromRoute(
        $entity->regency_id->entity->label(),
        'entity.regency.canonical',
        ['regency' => $entity->district_id->entity->regency_id->target_id]
      );
	}
	else{
		$row['regency'] = NULL;
	}
	if($entity->district_id->entity){
    $row['district'] = Link::createFromRoute(
      $entity->district_id->entity->label(),
      'entity.district.canonical',
      ['district' => $entity->district_id->target_id]
    );
	}
	else{
		$row['district'] = NULL;
	}
    return $row + parent::buildRow($entity);
  }

}
