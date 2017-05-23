<?php

namespace Drupal\wkbe_common\Utility;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Utility\Token;

/**
 * Config markup utility service.
 */
class ConfigMarkup extends MarkupBase {

  /**
   * @var ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * ConfigMarkup constructor.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   * @param Token $token
   */
  public function __construct(ConfigFactoryInterface $configFactory, Token $token) {
    $this->configFactory = $configFactory;
    parent::__construct($token);
  }

  /**
   * Gets the config markup object.
   *
   * @param string $name
   *   The name of the configuration object to use.
   *
   * @param string $key
   *   The key of the config item to use.
   *
   * @param string $format
   *   The text format to use.
   *
   * @return array
   */
  protected function getMarkup($name, $key, $format) {
    /** @var ImmutableConfig $config */
    $config = $this->configFactory->get($name);
    return $config->get($key) ?? ['value' => NULL, 'format' => $format];
  }

}

