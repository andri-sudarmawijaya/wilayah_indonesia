<?php

namespace Drupal\wilayah_indonesia_vilage\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Vilage entities.
 *
 * @ingroup wilayah_indonesia_vilage
 */
interface VilageInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Vilage name.
   *
   * @return string
   *   Name of the Vilage.
   */
  public function getName();

  /**
   * Sets the Vilage name.
   *
   * @param string $name
   *   The Vilage name.
   *
   * @return \Drupal\wilayah_indonesia_vilage\Entity\VilageInterface
   *   The called Vilage entity.
   */
  public function setName($name);

  /**
   * Gets the Vilage creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Vilage.
   */
  public function getCreatedTime();

  /**
   * Sets the Vilage creation timestamp.
   *
   * @param int $timestamp
   *   The Vilage creation timestamp.
   *
   * @return \Drupal\wilayah_indonesia_vilage\Entity\VilageInterface
   *   The called Vilage entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Vilage published status indicator.
   *
   * Unpublished Vilage are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Vilage is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Vilage.
   *
   * @param bool $published
   *   TRUE to set this Vilage to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\wilayah_indonesia_vilage\Entity\VilageInterface
   *   The called Vilage entity.
   */
  public function setPublished($published);

}
