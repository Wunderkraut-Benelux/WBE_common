<?php

/**
 * @file
 * Contains \Drupal\wkbe_common\Plugin\Block\MainNavigationBlock.
 */

namespace Drupal\wkbe_common\Plugin\Block;

use Drupal\Core\Menu\MenuActiveTrailInterface;
use Drupal\Core\Menu\MenuLinkTreeInterface;

/**
 * Provides a language aware main navigation block.
 *
 * @Block(
 *   id = "main_navigation_block",
 *   admin_label = @Translation("Language aware main navigation"),
 *   category = @Translation("Menus"),
 * )
 */
class MainNavigationBlock extends NavigationBlockBase {

  /**
   * Constructs a new MainNavigationBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param array $plugin_definition
   *   The plugin implementation definition.
   * @param MenuLinkTreeInterface $menu_tree
   *   The menu tree service.
   * @param MenuActiveTrailInterface $menu_active_trail
   *   The active menu trail service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MenuLinkTreeInterface $menu_tree, MenuActiveTrailInterface $menu_active_trail) {
    $current_language = \Drupal::languageManager()->getCurrentLanguage();
    $this->menuName = 'main-navigation-' . $current_language->getId();
    parent::__construct($configuration, $plugin_id, $plugin_definition, $menu_tree, $menu_active_trail);
  }
}
