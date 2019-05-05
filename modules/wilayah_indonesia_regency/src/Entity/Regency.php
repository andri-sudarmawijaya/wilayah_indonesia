<?php

namespace Drupal\wilayah_indonesia_regency\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Regency entity.
 *
 * @ingroup wilayah_indonesia_regency
 *
 * @ContentEntityType(
 *   id = "regency",
 *   label = @Translation("Regency"),
 *   handlers = {
 *     "storage_schema" = "Drupal\wilayah_indonesia_regency\RegencyStorageSchema",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\wilayah_indonesia_regency\RegencyListBuilder",
 *     "views_data" = "Drupal\wilayah_indonesia_regency\Entity\RegencyViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\wilayah_indonesia_regency\Form\RegencyForm",
 *       "add" = "Drupal\wilayah_indonesia_regency\Form\RegencyForm",
 *       "edit" = "Drupal\wilayah_indonesia_regency\Form\RegencyForm",
 *       "delete" = "Drupal\wilayah_indonesia_regency\Form\RegencyDeleteForm",
 *     },
 *     "access" = "Drupal\wilayah_indonesia_regency\RegencyAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\wilayah_indonesia_regency\RegencyHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "wilayah_indonesia_regency",
 *   admin_permission = "administer regency entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/regency/{regency}",
 *     "add-form" = "/admin/content/regency/add",
 *     "edit-form" = "/admin/content/regency/{regency}/edit",
 *     "delete-form" = "/admin/content/regency/{regency}/delete",
 *     "collection" = "/admin/content/regency",
 *   },
 *   field_ui_base_route = "regency.settings"
 * )
 */
class Regency extends ContentEntityBase implements RegencyInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    /*
	if ($entity_type->hasKey('id')) {
      $fields[$entity_type->getKey('id')] = BaseFieldDefinition::create('integer')
        ->setLabel(t('ID'))
        ->setReadOnly(TRUE)
        ->setSettings([
          'unsigned' => true,
          'size' => 'big'
        ]);
    }
	*/
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Regency entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'hidden',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Regency entity.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['province_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Province'))
      ->setDescription(t('The province ID of author of the Regency entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'province')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setRequired(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'Above',
        'type' => 'entity_reference_label',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => -3,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Regency is published.'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 10,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
