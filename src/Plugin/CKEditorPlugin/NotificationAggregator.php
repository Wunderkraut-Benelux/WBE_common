<?php

/**
 * @file
 * Contains \Drupal\wkbe_common\Plugin\CKEditorPlugin\NotificationAggregator.
 */

namespace Drupal\wkbe_common\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "notificationaggregator" plugin.
 *
 * @CKEditorPlugin(
 *   id = "notificationaggregator",
 *   label = @Translation("Notification Aggregator"),
 *   module = "ckeditor"
 * )
 */
class NotificationAggregator extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'wkbe_common') . '/ckeditor_plugins/notificationaggregator/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return ['notification'];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [];
  }

}