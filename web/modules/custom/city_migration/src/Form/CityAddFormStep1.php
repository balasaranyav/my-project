<?php

namespace Drupal\city_migration\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the city entity edit forms.
 *
 * @ingroup city entity.
 */
class CityAddFormStep1 extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\city_migration\Entity\City $entity */
    $form = parent::buildForm($form, $form_state);
    $form['actions']['submit']['#value'] = $this->t('Save and proceed');
    return $form;
  }

  /**
   * Actions of step 1.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['cancel'] = [
      '#type' => 'submit',
      '#value' => $this->t('Cancel'),
      '#submit' => ['::cancelSubmit'],
      '#weight' => 90,
      '#limit_validation_errors' => [],
    ];
    if (array_key_exists('delete', $actions)) {
      unset($actions['delete']);
    }
    $actions['#prefix'] = '<i>Step 1 of 3</i>';
    return $actions;
  }

  /**
   * Cancel Submit.
   */
  public function cancelSubmit(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.city.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Redirect to step 2.
    $entity = $this->getEntity();
    // $entity->save();
    parent::save($form, $form_state);
    $id = $entity->id();
    $form_state->setRedirect('city.step2', ['city' => $id]);

  }

}
