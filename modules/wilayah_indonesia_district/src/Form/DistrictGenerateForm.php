<?php

namespace Drupal\wilayah_indonesia_district\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\wilayah_indonesia_district\Entity\District;
/**
 * Class DistrictGenerateForm.
 */
class DistrictGenerateForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'district_generate_form';
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
   
	  // Initialize some variables during the first pass through.
	  if (!isset($sandbox['total'])) {
		$database = \Drupal::database();
		$query = $database->select('daftar_districts', 'p')
		  //->fields('p', array('id'))
		  ->countQuery()
		  ->execute();
		$count = $query->fetchField();  
		$sandbox['total'] = $count;
	  }
	
	  $districts_per_batch = 25;
	 
	  // Handle one pass through.
      usleep(2000);
      $pids = $database->select('daftar_districts', 'p')
		->fields('p')
		->range($sandbox['current'], $sandbox['current'] + $districts_per_batch)
		->execute()->fetchAll();
	  
	  foreach($pids as $key => $pid) {
		$values[$key] = $pid;
        $transaction = $database->startTransaction();
        try {
		  $district = District::create((array)$pid);
		  $district->save();
        }
        catch (\Exception $e) {
          $transaction->rollback();
          $district = NULL;
          watchdog_exception('wilayah_indonesua_district', $e, $e->getMessage());
          throw new \Exception(  $e->getMessage(), $e->getCode(), $e->getPrevious());
        }
		$sandbox['current']++;
	  }
	  $this->messenger()->addMessage($this->t('@count districts processed.', array('@count' => $sandbox['current'])));	 

	  if ($sandbox['total'] == 0) {
		$sandbox['#finished'] = 1;
	  } else {
		$sandbox['#finished'] = ($sandbox['current'] / $sandbox['total']);
	  }

  }

}
