<?php

namespace Drupal\wilayah_indonesia_province\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Province edit forms.
 *
 * @ingroup wilayah_indonesia_province
 */
class ProvinceForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wilayah_indonesia_province\Entity\Province */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

	if(!$entity->get('id')->value){
	  $form['province_code'] = [
        '#title' => 'Code',
        '#type' => 'number',
        '#default_value' => '-10',
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
	  $id = \Drupal::entityQuery('province')
	        ->condition('id', $form_state->getValue('province_code'))
			->range('0', '1')
			->execute();
	  if(!empty($id)){
	    $form_state->setErrorByName('province_code',"The province_code field already exist");
	  }
	}
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
	
    $entity = $this->entity;
	
	if(is_null($entity->id())){
		$entity->set('id', $form_state->getValue('province_code'));
	}
	
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Province.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Province.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.province.canonical', ['province' => $entity->id()]);
  }

}
