<?php

namespace Drupal\city_migration\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * @file
 * Contains \Drupal\city_migration\Form\CityDeleteForm.
 */

/**
 * Provides a form for deleting a city entity.
 *
 * @ingroup city
 */
class CityDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?',
    ['%name' => $this->entity->label()]);
  }

  /**
   * {@inheritdoc}
   *
   * If the delete command is canceled, return to the city.
   */
  public function getCancelUrl() {
    return Url::fromRoute('entity.city.edit_form', ['city' => $this->entity->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   *
   * Delete the entity.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();
    $this->logger('city')->notice('deleted %title.', ['%title' => $this->entity->label()]);
    // Redirect to city list after delete.
    $form_state->setRedirect('entity.city.collection');
  }

}
