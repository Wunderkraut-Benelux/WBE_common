<?php

namespace Drupal\wkbe_common\Utility;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Utility\Token;

/**
 * Markup utility Base class.
 */
abstract class MarkupBase {

  use StringTranslationTrait;


  /**
   * @var Token
   */
  protected $token;

  /**
   * MarkupBase constructor.
   * @param \Drupal\Core\Utility\Token $token
   */
  public function __construct(Token $token) {
    $this->token = $token;
  }

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
  public function getFormElement($title, $name, $key = NULL, $format = 'full_html') {
    $markup = $this->getMarkup($name, $key, $format);

    return [
      '#type' => 'text_format',
      '#title' => $this->t($title),
      '#default_value' => $markup['value'],
      '#format' => $markup['format'],
    ];
  }

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
  public function getElement($name, $key, $format = 'full_html', $data = []) {
    $markup = $this->getMarkup($name, $key, $format);

    return [
      '#markup' => $this->token->replace(check_markup($markup['value'], $markup['format']), $data),
    ];
  }


}