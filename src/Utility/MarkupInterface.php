<?php

namespace Drupal\wkbe_common\Utility;

/**
 * Provides an interface for markup helpers.
 */
interface MarkupInterface {

  /**
   * Gets the markup form element.
   *
   * @param string $title
   *   The title of the form element.
   *
   * @param string $name
   *   The name of the object to use.
   *
   * @param string $key
   *   The key of the item to use.
   *
   * @param string $format
   *   Optional format. Defaults to full_html.
   *
   * @return array
   */
  public function getFormElement($title, $name, $key = NULL, $format = 'full_html');

  /**
   * Gets the formatted and token replaced markup element.
   *
   * @param string $name
   *   The name of the object to use.
   *
   * @param string $key
   *   The key of the item to use.
   *
   * @param string $format
   *   Optional format. Defaults to full_html.
   *
   * @param array $data
   *   Optional data to pass in for the token replacement to use (for instance a node object).
   *
   * @return array
   */
  public function getElement($name, $key = '', $format = 'full_html', $data = []);

}