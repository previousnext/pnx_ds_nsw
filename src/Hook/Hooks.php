<?php

declare(strict_types=1);

namespace Drupal\pnx_ds_nsw\Hook;

use Drupal\Core\Extension\Extension;
use Drupal\Core\Hook\Attribute\Hook;
use PreviousNext\Ds\Nsw\Utility\Twig;

final class Hooks {

  public const RENDER_ARRAY_KEY_TO_TWIG_TYPE = '__twigTypeVar';

  #[Hook('system_info_alter')]
  public function systemInfoAlter(array &$info, Extension $file, string $type): void {
    if ('pnx_ds_nsw' === $file->getName()) {
      $dir = \Safe\realpath(\sprintf('%s/../components/design-system/nswds/', \DRUPAL_ROOT));

      // In components/ComponentsRegistry, ltrim disallows absolute dirs, so we
      // must recompute where vendor is in relation to the DrupalRoot, even if
      // it means navigating below Drupal.
      // '/' indicates relative to DRUPAL_ROOT, not disk-root.
      // https://www.drupal.org/project/components/issues/3210853
      $info['components']['namespaces'][Twig::NAMESPACE] = '/' . \PreviousNext\Ds\Common\Utility\Twig::computePathFromDrupalRootTo($dir);

      $info['components']['namespaces']['nswds'] = '/' . \PreviousNext\Ds\Common\Utility\Twig::computePathFromDrupalRootTo($dir);
    }
  }

  /**
   * Implements hook_preprocess().
   *
   * @phpstan-param array<string, mixed> $variables
   */
  #[Hook('preprocess')]
  public function preprocess(array &$variables): void {
    if (\array_key_exists(static::RENDER_ARRAY_KEY_TO_TWIG_TYPE, $variables) && ($variables['type'] ?? NULL) === NULL) {
      // Can't set '#type' on render array so we juggle variable names.
      $variables['type'] = $variables[static::RENDER_ARRAY_KEY_TO_TWIG_TYPE];
    }
  }

}
