<?php

namespace Drupal\city_migration;

use Drupal\views\EntityViewsData;

/**
 * Provides views data for city entities.
 */
class CityViewsData extends EntityViewsData {

  /**
   * Returns the Views data for the entity.
   */
  public function getViewsData() {
    $data = parent::getViewsData();
    return $data;
  }

}
