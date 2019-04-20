<?php

namespace Drupal\wilayah_indonesia_vilage;

use Drupal\Core\Entity\ContentEntityTypeInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorageSchema;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Defines the node schema handler.
 */
class VilageStorageSchema extends SqlContentEntityStorageSchema {
  /**
   * {@inheritdoc}
   */
  protected function getEntitySchema(ContentEntityTypeInterface $entity_type, $reset = FALSE) {
    $schema = parent::getEntitySchema($entity_type, $reset);

    $schema['wilayah_indonesia_vilage']['indexes'] += array(
      'vilage__name' => array('name'),
      //'vilage__province' => array('id', 'province_id', 'regency_id', 'district_id'),
    );

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  protected function getSharedTableFieldSchema(FieldStorageDefinitionInterface $storage_definition, $table_name, array $column_mapping) {
    $schema = parent::getSharedTableFieldSchema($storage_definition, $table_name, $column_mapping);
    $field_name = $storage_definition->getName();

    if ($table_name == 'wilayah_indonesia_vilage') {
      switch ($field_name) {
        case 'user_id':
          $this->addSharedTableFieldForeignKey($storage_definition, $schema, 'users', 'uid');
          break;
        case 'province_id':
          $this->addSharedTableFieldForeignKey($storage_definition, $schema, 'wilayah_indonesia_province', 'id');
          break;
        case 'regency_id':
          $this->addSharedTableFieldForeignKey($storage_definition, $schema, 'wilayah_indonesia_regency', 'id');
          break;
        case 'district_id':
          $this->addSharedTableFieldForeignKey($storage_definition, $schema, 'wilayah_indonesia_district', 'id');
          break;
      }
    }

    return $schema;
  }

}
