<?php

namespace Drupal\wilayah_indonesia_district\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

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

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

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
