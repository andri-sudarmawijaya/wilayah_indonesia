<?php

namespace Drupal\wilayah_indonesia_regency\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Regency entities.
 *
 * @ingroup wilayah_indonesia_regency
 */
interface RegencyInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Regency name.
   *
   * @return string
   *   Name of the Regency.
   */
  public function getName();

  /**
   * Sets the Regency name.
   *
   * @param string $name
   *   The Regency name.
   *
   * @return \Drupal\wilayah_indonesia_regency\Entity\RegencyInterface
   *   The called Regency entity.
   */
  public function setName($name);

  /**
   * Gets the Regency creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Regency.
   */
  public function getCreatedTime();

  /**
   * Sets the Regency creation timestamp.
   *
   * @param int $timestamp
   *   The Regency creation timestamp.
   *
   * @return \Drupal\wilayah_indonesia_regency\Entity\RegencyInterface
   *   The called Regency entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Regency published status indicator.
   *
   * Unpublished Regency are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Regency is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Regency.
   *
   * @param bool $published
   *   TRUE to set this Regency to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\wilayah_indonesia_regency\Entity\RegencyInterface
   *   The called Regency entity.
   */
  public function setPublished($published);

}
