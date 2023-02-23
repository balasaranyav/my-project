<?php

namespace Drupal\gt_feedback\Controller;

use Drupal\views\Views;
use Drupal\Core\Controller\ControllerBase;

/**
 * Close Feedback.
 */
class CloseFeedbackController extends ControllerBase {

  /**
   * A helper function returning results.
   */
  public function closeFeedback() {
    // Load the view.
    $view = Views::getView('requested_feedback');
    $view->execute();
    foreach ($view->result as $row) {
      // dpm($row);
      $message = [
        '#markup' => '<p>' . $this->t('Feedback Closed') . '</p>',
      ];
    }

    return $message;
  }

}
