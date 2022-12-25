<?php

namespace Drupal\city_migration\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the city entity edit forms.
 *
 * @ingroup city entity.
 */
class CityAddFormStep3 extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\city_migration\Entity\City $entity */
    $form = parent::buildForm($form, $form_state);
    $form['actions']['submit']['#value'] = t('Save and proceed');
    return $form;
  }

  /**
   * Actions of step 3.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['go_back'] = [
      '#type' => 'submit',
      '#value' => $this->t('Back to step 2'),
      '#submit' => ['::goBack'],
      '#weight' => 90,
      '#limit_validation_errors' => [],
    ];
    if (array_key_exists('delete', $actions)) {
      unset($actions['delete']);
    }
    $actions['#prefix'] = '<i>Step 3 of 3</i>';
    return $actions;
  }

  /**
   * Go back.
   */
  public function goBack(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $id = $entity->id();
    $form_state->setRedirect('city.step2', ['city' => $id]);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Redirect to city overview after save.
    $form_state->setRedirect('entity.city.collection');
    \Drupal::messenger()->addMessage('Your Task is added to your To-Do list.');
    $entity = $this->getEntity();
    $entity->save();
  }

}
