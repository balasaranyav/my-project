<?php

namespace Drupal\city_migration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CitySettingsForm to build settings form.
 *
 * @package Drupal\city_migration\Form
 *
 * @ingroup city_migration
 */
class CitySettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'city_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['city_settings']['#markup'] = 'Settings form for city. We don\'t need additional entity settings. Manage field settings with the tabs above.';
    return $form;
  }

}
