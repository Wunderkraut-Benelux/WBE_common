<?php

namespace Drupal\wkbe_common\Utility;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Utility\Token;

/**
 * Markup utility Base class.
 */
abstract class MarkupBase implements MarkupInterface {

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
   * {@inheritdoc}
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
   * {@inheritdoc}
   */
  public function getElement($name, $key = '', $format = 'full_html', $data = []) {
    $markup = $this->getMarkup($name, $key, $format);

    return [
      '#markup' => $this->token->replace(check_markup($markup['value'], $markup['format']), $data),
    ];
  }

  abstract protected function getMarkup($name, $key, $format = 'full_html');
}