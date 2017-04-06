<?php

namespace Drupal\wkbe_common\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Subscriber on routes.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {

    // Add a separate permission on the admin/structure page
    //(instead of the general access administration pages).
    $structureRoute = $collection->get('system.admin_structure');
    $structureRoute->addRequirements([
      '_permission' => 'access structure page'
    ]);

    // Add a separate permission on the admin/config page
    //(instead of the general access administration pages).
    $configurationRoute = $collection->get('system.admin_config');
    $configurationRoute->addRequirements([
      '_permission' => 'access configuration page'
    ]);

  }
}
