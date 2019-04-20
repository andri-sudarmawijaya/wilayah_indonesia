<?php

namespace Drupal\wilayah_indonesia_vilage\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Vilage entities.
 */
class VilageViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    $data['wilayah_indonesia_vilage']['wilayah_indonesia_district'] = array(
	  'title' => t('Relation to District'),
	  'relationship' => array(
	    'base' => 'wilayah_indonesia_district', // The name of the table to join with.
	    'base field' => 'district_id', // The name of the field on the joined table.
	    'relationship field' => 'id', // The name of the field on the joined table.
	    // 'relationship field' => 'tid',
	    // 'field' => 'optimo_package_id' -- see hook_views_data_alter(); not needed here.
	    'handler' => 'views_handler_relationship',
	    'label' => t('District'),
	    'title' => t('District ID'),
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
