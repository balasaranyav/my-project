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
    $data['city']['city_entity_date_views_field'] = [
      'title' => $this->t('Date'),
      'field' => [
        'title' => $this->t('Date'),
        'help' => $this->t('Shows the Date of the city entity'),
        'id' => 'city_entity_date_views_field',
      ],
    ];
    $data['city']['city_entity_priority_level_views_field'] = [
      'title' => $this->t('Priority Level'),
      'field' => [
        'title' => $this->t('Priority Level'),
        'help' => $this->t('Shows the priority level of the city entity'),
        'id' => 'city_entity_priority_level_views_field',
      ],
    ];
    $data['city']['city_entity_moderation_state_views_field'] = [
      'title' => $this->t('Moderation status'),
      'field' => [
        'title' => $this->t('Moderation status'),
        'help' => $this->t('Shows the status of the city entity'),
        'id' => 'city_entity_moderation_state_views_field',
      ],
    ];
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
