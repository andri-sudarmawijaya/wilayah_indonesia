<?php

namespace Drupal\wilayah_indonesia_district\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining District entities.
 *
 * @ingroup wilayah_indonesia_district
 */
interface DistrictInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the District name.
   *
   * @return string
   *   Name of the District.
   */
  public function getName();

  /**
   * Sets the District name.
   *
   * @param string $name
   *   The District name.
   *
   * @return \Drupal\wilayah_indonesia_district\Entity\DistrictInterface
   *   The called District entity.
   */
  public function setName($name);

  /**
   * Gets the District creation timestamp.
   *
   * @return int
   *   Creation timestamp of the District.
   */
  public function getCreatedTime();

  /**
   * Sets the District creation timestamp.
   *
   * @param int $timestamp
   *   The District creation timestamp.
   *
   * @return \Drupal\wilayah_indonesia_district\Entity\DistrictInterface
   *   The called District entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the District published status indicator.
   *
   * Unpublished District are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the District is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a District.
   *
   * @param bool $published
   *   TRUE to set this District to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\wilayah_indonesia_district\Entity\DistrictInterface
   *   The called District entity.
   */
  public function setPublished($published);

}
