<?php

namespace Drupal\wilayah_indonesia_district\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for District entities.
 */
class DistrictViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    $data['wilayah_indonesia_district']['wilayah_indonesia_regency'] = array(
	  'title' => t('Relation to Regency'),
	  'relationship' => array(
	    'base' => 'wilayah_indonesia_regency', // The name of the table to join with.
	    'base field' => 'regency_id', // The name of the field on the joined table.
	    'relationship field' => 'id', // The name of the field on the joined table.
	    // 'relationship field' => 'tid',
	    // 'field' => 'optimo_package_id' -- see hook_views_data_alter(); not needed here.
	    'handler' => 'views_handler_relationship',
	    'label' => t('Regency'),
	    'title' => t('Regency ID'),
	    'field' => [
		  // ID of field handler plugin to use.
		  'id' => 'numeric',
	    ],
	    'sort' => [
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
	    ],
	    'filter' => [
		  // ID of filter handler plugin to use.
		  'id' => 'numeric',
	    ],
	    'id' => 'standard'
      ),
    );
    
    return $data;
  }

}
