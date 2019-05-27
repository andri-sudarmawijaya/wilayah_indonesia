<?php

namespace Drupal\wilayah_indonesia_province\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\wilayah_indonesia_province\Entity\Province;

/**
 * Class ProvinceGenerateForm.
 */
class ProvinceGenerateForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'province_generate_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      //drupal_set_message($key . ': ' . $value);
    }
	  // Initialize some variables during the first pass through.
	  if (!isset($sandbox['total'])) {
		$database = \Drupal::database();
		$query = $database->select('daftar_provinces', 'p')
		  //->fields('p', array('id'))
		  ->countQuery()
		  ->execute();
		$count = $query->fetchField();  
		$sandbox['total'] = $count;
	  }
	
	  $provinces_per_batch = 25;
	 
	  // Handle one pass through.
      usleep(2000);
      $pids = $database->select('daftar_provinces', 'p')
		->fields('p')
		->range($sandbox['current'], $sandbox['current'] + $provinces_per_batch)
		->execute()->fetchAll();
	  
	  foreach($pids as $key => $pid) {
		$values[$key] = $pid;
        $transaction = $database->startTransaction();
        try {
		  $province = Province::create((array)$pid);
		  $province->save();
        }
        catch (\Exception $e) {
          $transaction->rollback();
          $province = NULL;
          watchdog_exception('wilayah_indonesua_province', $e, $e->getMessage());
          throw new \Exception(  $e->getMessage(), $e->getCode(), $e->getPrevious());
        }
		$sandbox['current']++;
	  }
	  $this->messenger()->addMessage($this->t('@count provinces processed.', array('@count' => $sandbox['current'])));	 

	  if ($sandbox['total'] == 0) {
		$sandbox['#finished'] = 1;
	  } else {
		$sandbox['#finished'] = ($sandbox['current'] / $sandbox['total']);
	  }
  }

}
