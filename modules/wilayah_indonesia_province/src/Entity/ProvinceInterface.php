<?php

namespace Drupal\wilayah_indonesia_province\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Province entities.
 *
 * @ingroup wilayah_indonesia_province
 */
interface ProvinceInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Province name.
   *
   * @return string
   *   Name of the Province.
   */
  public function getName();

  /**
   * Sets the Province name.
   *
   * @param string $name
   *   The Province name.
   *
   * @return \Drupal\wilayah_indonesia_province\Entity\ProvinceInterface
   *   The called Province entity.
   */
  public function setName($name);

  /**
   * Gets the Province creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Province.
   */
  public function getCreatedTime();

  /**
   * Sets the Province creation timestamp.
   *
   * @param int $timestamp
   *   The Province creation timestamp.
   *
   * @return \Drupal\wilayah_indonesia_province\Entity\ProvinceInterface
   *   The called Province entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Province published status indicator.
   *
   * Unpublished Province are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Province is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Province.
   *
   * @param bool $published
   *   TRUE to set this Province to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\wilayah_indonesia_province\Entity\ProvinceInterface
   *   The called Province entity.
   */
  public function setPublished($published);

}
