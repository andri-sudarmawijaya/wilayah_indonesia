<?php

namespace Drupal\wilayah_indonesia_province;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Province entity.
 *
 * @see \Drupal\wilayah_indonesia_province\Entity\Province.
 */
class ProvinceAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\wilayah_indonesia_province\Entity\ProvinceInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished province entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published province entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit province entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete province entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add province entities');
  }

}
