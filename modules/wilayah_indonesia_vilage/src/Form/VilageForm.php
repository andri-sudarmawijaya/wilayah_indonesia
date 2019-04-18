<?php

namespace Drupal\wilayah_indonesia_vilage\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

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
