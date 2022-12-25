<?php

namespace Drupal\city_migration\Entity;

use Drupal\Core\Entity\EditorialContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the city entity.
 *
 * @ingroup city
 *
 * @ContentEntityType(
 *   id = "city",
 *   label = @Translation("City"),
 *   base_table = "city",
 *   data_table = "city_field_data",
 *   revision_table = "city_revision",
 *   revision_data_table = "city_field_revision",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "title",
 *     "revision" = "vid",
 *     "status" = "status",
 *     "published" = "status",
 *   },
 *   revision_metadata_keys = {
 *     "revision_user" = "revision_uid",
 *     "revision_created" = "revision_timestamp",
 *     "revision_log_message" = "revision_log"
 *   },
 *   handlers = {
 *     "access" = "Drupal\city_migration\CityAccessControlHandler",
 *     "views_data" = "Drupal\city_migration\CityViewsData",
 *     "form" = {
 *       "add" = "Drupal\city_migration\Form\CityForm",
 *       "step_1" = "Drupal\city_migration\Form\CityAddFormStep1",
 *       "step_2" = "Drupal\city_migration\Form\CityAddFormStep2",
 *       "step_3" = "Drupal\city_migration\Form\CityAddFormStep3",
 *       "edit" = "Drupal\city_migration\Form\CityForm",
 *       "delete" = "Drupal\city_migration\Form\CityDeleteForm",
 *     }
 *   },
 *   links = {
 *     "canonical" = "/cities/{city}",
 *     "delete-form" = "/city/{city}/delete",
 *     "edit-form" = "/city/{city}/edit",
 *     "create" = "/city/create",
 *   },
 *   field_ui_base_route = "entity.city.settings"
 * )
 */
class City extends EditorialContentEntityBase {

  /**
   * Create base fields definitions.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    // Provides id and uuid fields.
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the Task'))
      ->setSettings([
        'max_length' => 150,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the City entity is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
