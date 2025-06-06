<?php

declare(strict_types=1);

namespace Drupal\pnx_ds_nsw;

use PreviousNext\Ds\Nsw\Lists\NswLists;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Service provider.
 */
final class PnxDsNswCompilerPass implements CompilerPassInterface {

  public function process(ContainerBuilder $container): void {
    $pintoLists = $container->getParameter('pinto.lists');
    \array_push($pintoLists, ...NswLists::Lists);
    $container->setParameter('pinto.lists', $pintoLists);
  }

}
