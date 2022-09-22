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

    $data['city']['city_dynamic_operation_links'] = [
      'title' => $this->t('Dynamic operations'),
      'field' => [
        'title' => $this->t('Dynamic operations'),
        'help' => $this->t('Shows a dropdown with dynamic operations for city'),
        'id' => 'city_dynamic_operation_links',
      ],
    ];
    return $data;
  }

}
