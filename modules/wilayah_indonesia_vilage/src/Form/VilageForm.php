<?php

namespace Drupal\wilayah_indonesia_vilage\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\wilayah_indonesia_district\Entity\District;

/**
 * Form controller for Vilage edit forms.
 *
 * @ingroup wilayah_indonesia_vilage
 */
class VilageForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wilayah_indonesia_vilage\Entity\Vilage */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;
	
	if(!$entity->get('id')->value){
	  $form['vilage_code'] = [
        '#title' => 'Code',
        '#type' => 'number',
        '#default_value' => '0',
		'#weight' => '-10',
		'#required' => TRUE,
      ];
	}
	$form['province_id']['#access'] = FALSE;
	$form['regency_id']['#access'] = FALSE;

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
	  $id = \Drupal::entityQuery('vilage')
	        ->condition('id', $form_state->getValue('vilage_code'))
			->range('0', '1')
			->execute();
	  if(!empty($id)){
	    $form_state->setErrorByName('district_code',"The vilage code field already exist");
	  }
	}
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

	if(is_null($entity->id())){
		$entity->set('id', $form_state->getValue('vilage_code'));
	}
    /*
	$district= District::load($form_state->getValue('district_id')[0]['target_id']);
	$regency = $district->regency_id->entity;
	
	if($regency){
	  $entity->set('regency_id', $regency->id());
	  $province = $regency->province_id->entity;
	  if($province){
	    $entity->set('province_id', $province->id());
	  }
	}
    */
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Vilage.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Vilage.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.vilage.canonical', ['vilage' => $entity->id()]);
  }

}
