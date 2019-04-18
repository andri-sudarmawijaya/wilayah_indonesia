<?php

namespace Drupal\wilayah_indonesia_vilage;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Vilage entity.
 *
 * @see \Drupal\wilayah_indonesia_vilage\Entity\Vilage.
 */
class VilageAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\wilayah_indonesia_vilage\Entity\VilageInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished vilage entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published vilage entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit vilage entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete vilage entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add vilage entities');
  }

}
