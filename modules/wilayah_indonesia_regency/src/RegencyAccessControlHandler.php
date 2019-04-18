<?php

namespace Drupal\wilayah_indonesia_regency;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Regency entity.
 *
 * @see \Drupal\wilayah_indonesia_regency\Entity\Regency.
 */
class RegencyAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\wilayah_indonesia_regency\Entity\RegencyInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished regency entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published regency entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit regency entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete regency entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add regency entities');
  }

}
