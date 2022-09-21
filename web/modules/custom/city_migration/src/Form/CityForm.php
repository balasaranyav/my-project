<?php

namespace Drupal\city_migration\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the city entity edit forms.
 *
 * @ingroup city entity.
 */
class CityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\city_migration\Entity\City $entity */
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Redirect to city list after save.
    $form_state->setRedirect('entity.city.collection');
    $entity = $this->getEntity();
    $entity->save();
  }

}
