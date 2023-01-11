<?php

namespace Drupal\tablepress\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements table configuration form.
 */
class TableConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tablepress_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['tablepress.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['rows'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How many Rows?'),
      '#size' => 3,
      '#maxlength' => 3,
      '#required' => TRUE,
      '#default_value' => $this->config('tablepress.settings')->get('rows'),
    ];

    $form['cols'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How many Columns?'),
      '#size' => 2,
      '#maxlength' => 2,
      '#required' => TRUE,
      '#default_value' => isset($cols_value) ? 2 : $cols_value,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('tablepress.settings')
      ->set('rows', $form_state->getValue('rows'))
      ->set('cols', $form_state->getValue('cols'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
