<?php

declare(strict_types=1);

namespace Drupal\pnx_ds_nsw;

use PreviousNext\Ds\Nsw\Lists;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Service provider.
 */
final class PnxDsNswCompilerPass implements CompilerPassInterface {

  public function process(ContainerBuilder $container): void {
    $pintoLists = $container->getParameter('pinto.lists');
    $pintoLists[] = Lists\NswAtoms::class;
    $pintoLists[] = Lists\NswComponents::class;
    $pintoLists[] = Lists\NswGlobal::class;
    $pintoLists[] = Lists\NswLayouts::class;
    $container->setParameter('pinto.lists', $pintoLists);
  }

}
