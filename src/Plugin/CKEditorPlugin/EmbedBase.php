<?php

/**
 * @file
 * Contains \Drupal\wkbe_common\Plugin\CKEditorPlugin\EmbedBase.
 */

namespace Drupal\wkbe_common\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "embed" plugin.
 *
 * @CKEditorPlugin(
 *   id = "embedbase",
 *   label = @Translation("Embed Base"),
 *   module = "ckeditor"
 * )
 */
class EmbedBase extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'wkbe_common') . '/ckeditor_plugins/embedbase/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return ['notificationaggregator'];
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