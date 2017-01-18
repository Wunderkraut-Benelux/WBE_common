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
    $structure_route = $collection->get('system.admin_structure');
    $structure_route->addRequirements([
      '_permission' => 'access structure page'
    ]);

  }
}
