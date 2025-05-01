<?php

declare(strict_types=1);

namespace Drupal\pnx_ds_nsw;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderInterface;

/**
 * Service provider.
 */
final class PnxDsNswServiceProvider implements ServiceProviderInterface {

  public function register(ContainerBuilder $container): void {
    $container->addCompilerPass(new PnxDsNswCompilerPass(), priority: 100);
  }

}
