<?php

/**
 * @file
 * Contains \Drupal\wkbe_common\Plugin\CKEditorPlugin\Embed.
 */

namespace Drupal\wkbe_common\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "embed" plugin.
 *
 * @CKEditorPlugin(
 *   id = "embed",
 *   label = @Translation("Embed"),
 *   module = "ckeditor"
 * )
 */
class Embed extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'wkbe_common') . '/ckeditor_plugins/embed/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return ['embedbase', 'notificationaggregator', 'notification'];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [
      'embed_enabled' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      'Embed' => [
        'label' => t('Media embed'),
        'image' => drupal_get_path('module', 'wkbe_common') . '/ckeditor_plugins/embed/icons/embed.png',
      ],
    ];
  }

}