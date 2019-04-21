<?php

namespace Drupal\wilayah_indonesia_district\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\wilayah_indonesia_regency\Entity\Regency;


/**
 * Form controller for District edit forms.
 *
 * @ingroup wilayah_indonesia_district
 */
class DistrictForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wilayah_indonesia_district\Entity\District */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;
	
	if(!$entity->get('id')->value){
	  $form['district_code'] = [
        '#title' => 'Code',
        '#type' => 'number',
        '#default_value' => '0',
		'#weight' => '-10',
		'#required' => TRUE,
      ];
	}
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wilayah_indonesia_province\Entity\Province */		
	parent::validateForm($form, $form_state);

    $entity = $this->entity;

	if(is_null($entity->id())){
	  $id = \Drupal::entityQuery('district')
	        ->condition('id', $form_state->getValue('district_code'))
			->range('0', '1')
			->execute();
	  if(!empty($id)){
	    $form_state->setErrorByName('district_code',"The district code field already exist");
	  }
	}
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->entity;

	if(is_null($entity->id())){
		$entity->set('id', $form_state->getValue('district_code'));
	}
	/*
    $regency_id = \Drupal::entityQuery('regency')
	      ->condition('id', $form_state->getValue('regency_id')[0]['target_id'])
		  ->range('0', '1')
		  ->execute();
    if($regency_id){
	  $regency= Regency::load(reset($regency_id));
	  if($regency->province_id->target_id){
		$entity->set('province_id', $regency->province_id->target_id);
	  }
	}
	*/
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label District.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label District.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.district.canonical', ['district' => $entity->id()]);
  }

}
