<?php

namespace Drupal\city_migration\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the city entity edit forms.
 *
 * @ingroup city entity.
 */
class CityAddFormStep2 extends ContentEntityForm {

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
   * Actions of step 2.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['go_back'] = [
      '#type' => 'submit',
      '#value' => $this->t('Back to step 1'),
      '#submit' => ['::goBack'],
      '#weight' => 90,
      '#limit_validation_errors' => [],
    ];
    if (array_key_exists('delete', $actions)) {
      unset($actions['delete']);
    }
    $actions['#prefix'] = '<i>Step 2 of 3</i>';
    return $actions;
  }

  /**
   * Go back.
   */
  public function goBack(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $id = $entity->id();
    $form_state->setRedirect('city.step1', ['city' => $id]);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Redirect step 3 after save.
    $entity = $this->getEntity();
    $this->entity->save();
    $id = $entity->id();
    $form_state->setRedirect('city.step3', ['city' => $id]);
  }

}
