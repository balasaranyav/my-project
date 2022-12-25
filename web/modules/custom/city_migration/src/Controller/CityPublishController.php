<?php

namespace Drupal\city_migration\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Url;
use Drupal\city_migration\Entity\City;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class CityPublishController.
 */
class CityPublishController extends ControllerBase {

  /**
   * Render publish state.
   */
  public function renderContent(City $city) {
    // We set the moderation to completed.
    $new_state = 'published';
    $city->set('moderation_state', $new_state);
    if ($city instanceof RevisionLogInterface) {
      $city->setRevisionLogMessage('Changed moderation state to Done.');
      $city->setRevisionUserId($this->currentUser()->id());
    }
    $city->save();
    // $publishedCity = Url::fromRoute('entity.city.canonical', ['city' => $city->id()]);
    \Drupal::messenger()->addMessage($city->label() . ' is Completed.');
    return new RedirectResponse(Url::fromRoute('entity.city.collection')->toString());
  }

  /**
   * Setting correct access.
   */
  public function access(City $city) {
    // Securing no one is trying to publish other people's cities.
    $access = AccessResult::allowedIf($city->access('view'));
    // Make sure state is draft.
    if ($city->get('moderation_state')->getString() != 'draft') {
      $access = AccessResult::forbidden();
    }
    return $access;
  }

}
