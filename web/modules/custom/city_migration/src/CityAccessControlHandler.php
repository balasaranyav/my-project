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

    $access = AccessResult::forbidden();

    switch ($operation) {
      case 'view':
        if ($account->hasPermission('administer own entity')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())->cachePerUser()->addCacheableDependency($entity);
        }
        break;

      // Shows the edit buttons in operations.
      case 'update':
        if ($account->hasPermission('administer own entity')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())->cachePerUser()->addCacheableDependency($entity);
        }
        break;

      // Lets me in on the edit-page of the entity.
      case 'edit':
        if ($account->hasPermission('administer own entity')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())->cachePerUser()->addCacheableDependency($entity);
        }
        break;

      // Shows the delete buttons + access to delete this entity.
      case 'delete':
        if ($account->hasPermission('administer own entity')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())->cachePerUser()->addCacheableDependency($entity);
        }
        break;
    }

    return $access;
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
