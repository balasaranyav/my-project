<?php

namespace Drupal\city_migration;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller Controls create/edit/delete access for entity and fields.
 *
 * @see \Drupal\city_migration\Entity\City.
 */
class CityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   *
   * Link the activities to the permissions. checkAccess is called with the
   * $operation as defined in the routing.yml file.
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    $admin_permission = $this->entityType->getAdminPermission();
    if ($account->hasPermission($admin_permission)) {
      return AccessResult::allowed();
    }
    switch ($operation) {
      case 'view':
        if ($entity->get('moderation_state')->getString() == 'draft') {
          return AccessResult::allowedIfHasPermission($account, 'administer own entity');
        }

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'administer own entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'administer own entity');
    }
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   *
   * Separate from the checkAccess because the entity does not yet exist, it
   * will be created during the 'add' process.
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'administer own entity');
  }

}
