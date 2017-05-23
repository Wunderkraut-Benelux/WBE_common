<?php

namespace Drupal\wkbe_common\Utility;

use Drupal\Core\State\StateInterface;
use Drupal\Core\Utility\Token;

/**
 * State markup utility service.
 */
class StateMarkup extends MarkupBase {

  /**
   * @var StateInterface
   */
  protected $state;

  /**
   * StateMarkup constructor.
   * @param \Drupal\Core\State\StateInterface $state
   * @param Token $token
   */
  public function __construct(StateInterface $state, Token $token) {
    $this->state = $state;
    parent::__construct($token);
  }

  /**
   * Gets the state markup object.
   *
   * @param string $name
   *   The name of the state object to use.

   * @param string $format
   *   Optional format. Defaults to full_html.
   *
   * @return array
   */
  protected function getMarkup($name, $format = 'full_html') {
    return $this->state->get($name) ?? ['value' => NULL, 'format' => $format];
  }

}

