<?php

/**
 * @file
 * Contains \Drupal\wkbe_common\Form\ConfigFormBase.
 */

namespace Drupal\wkbe_common\Form;

use Drupal\Core\Form\ConfigFormBase as CoreConfigFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\State\StateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Abstract, helper class.
 */
abstract class ConfigFormBase extends CoreConfigFormBase {

  /**
   * The storage type to be used when saving to the State API.
   */
  const CONFIG_TYPE_STATE = 'state';

  /**
   * The storage type to be used when saving to the Config API.
   */
  const CONFIG_TYPE_CONFIG = 'config';

  /**
   * State.
   *
   * @var StateInterface
   */
  protected $state;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory, StateInterface $state) {
    parent::__construct($config_factory);
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('state')
    );
  }

  /**
   * Get config name.
   */
  abstract protected function getConfigName();

  /**
   * Get state prefix.
   */
  abstract protected function getStatePrefix();

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [$this->getConfigName()];
  }

  /**
   * Get state.
   * @param $key
   * @return mixed
   */
  protected function getState($key) {
    return $this->state->get($this->getStatePrefix() . '.' . $key);
  }

  /**
   * Set state.
   * @param $key
   * @param $value
   * @return
   */
  protected function setState($key, $value) {
    return $this->state->set($this->getStatePrefix() . '.' . $key, $value);
  }

  /**
   * Set state.
   * @param array $settings
   * @return mixed
   */
  protected function setStateMultiple(array $settings) {
    $prefixed_settings = [];
    foreach ($settings as $key => $value) {
      $prefixed_settings[$this->getStatePrefix() . '.' . $key] = $value;
    }

    return $this->state->setMultiple($prefixed_settings);
  }

  /**
   * Get setting.
   * @param $key
   * @param string $type
   * @return $this
   */
  protected function getSetting($key, $type = ConfigFormBase::CONFIG_TYPE_STATE) {
    if ($type === ConfigFormBase::CONFIG_TYPE_STATE) {
      return $this->getState($key);
    }
    else {
      return $this->config($this->getConfigName())->get($key);
    }
  }

  /**
   * Set setting.
   * @param $key
   * @param $value
   * @param string $type
   * @return $this
   */
  protected function setSetting($key, $value, $type = ConfigFormBase::CONFIG_TYPE_STATE) {
    if ($type === ConfigFormBase::CONFIG_TYPE_STATE) {
      return $this->setState($key, $value);
    }
    else {
      return $this->config($this->getConfigName())->set($key, $value)->save();
    }
  }

  /**
   * Set setting.
   * @param array $settings
   * @param string $type
   * @return $this
   */
  protected function setSettings(array $settings, $type = ConfigFormBase::CONFIG_TYPE_STATE) {
    if ($type === ConfigFormBase::CONFIG_TYPE_STATE) {
      return $this->setStateMultiple($settings);
    }
    else {
      return $this->config($this->getConfigName())->setData($settings)->save();
    }
  }

}
