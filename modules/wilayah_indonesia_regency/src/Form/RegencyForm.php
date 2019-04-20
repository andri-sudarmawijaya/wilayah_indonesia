<?php

namespace Drupal\wilayah_indonesia_regency\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Regency edit forms.
 *
 * @ingroup wilayah_indonesia_regency
 */
class RegencyForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wilayah_indonesia_regency\Entity\Regency */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

	if(!$entity->get('id')->value){
	  $form['regency_code'] = [
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
	  $id = \Drupal::entityQuery('regency')
	        ->condition('id', $form_state->getValue('regency_code'))
			->range('0', '1')
			->execute();
	  if(!empty($id)){
	    $form_state->setErrorByName('regency_code',"The regency code field already exist");
	  }
	}
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
	
	if(is_null($entity->id())){
		$entity->set('id', $form_state->getValue('regency_code'));
	}
	
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Regency.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Regency.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.regency.canonical', ['regency' => $entity->id()]);
  }

}
