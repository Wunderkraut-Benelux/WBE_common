<?php

namespace Drupal\wkbe_common\Utility;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Utility\Token;

/**
 * Config markup utility service.
 */
class ConfigMarkup {

  use StringTranslationTrait;

  /**
   * @var ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * @var Token
   */
  protected $token;

  /**
   * ConfigMarkup constructor.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   * @param \Drupal\Core\Utility\Token $token
   */
  public function __construct(ConfigFactoryInterface $configFactory, Token $token) {
    $this->configFactory = $configFactory;
    $this->token = $token;
  }

  /**
   * Gets the config markup form element.
   *
   * @param string $title
   *   The title of the form element.
   *
   * @param string $name
   *   The name of the configuration object to use.
   *
   * @param string $key
   *   The key of the config item to use.
   *
   * @param string $format
   *   Optional format. Defaults to full_html.
   *
   * @return array
   */
  public function getFormElement($title, $name, $key, $format = 'full_html') {
    $markup = $this->getConfigMarkup($name, $key, $format);

    return [
      '#type' => 'text_format',
      '#title' => $this->t($title),
      '#default_value' => $markup['value'],
      '#format' => $markup['format'],
    ];
  }

  /**
   * Gets the formatted and token replaced config markup element.
   *
   * @param string $name
   *   The name of the configuration object to use.
   *
   * @param string $key
   *   The key of the config item to use.
   *
   * @param string $format
   *   Optional format. Defaults to full_html.
   *
   * @param array $data
   *   Optional data to pass in for the token replacement to use (for instance a node object).
   *
   * @return array
   */
  public function getElement($name, $key, $format = 'full_html', $data = []) {
    $markup = $this->getConfigMarkup($name, $key, $format);

    return [
      '#markup' => $this->token->replace(check_markup($markup['value'], $markup['format']), $data),
    ];
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
  private function getConfigMarkup($name, $key, $format) {
    /** @var ImmutableConfig $config */
    $config = $this->configFactory->get($name);
    return $config->get($key) ?? ['value' => NULL, 'format' => $format];
  }

}