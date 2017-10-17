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
   * {@inheritdoc}
   */
  protected function getMarkup($name, $key, $format = 'full_html') {
    // Key is not needed for state.
    return $this->state->get($name) ?? ['value' => NULL, 'format' => $format];
  }

}

