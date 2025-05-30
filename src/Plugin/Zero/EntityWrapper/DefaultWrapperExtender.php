<?php

namespace Drupal\zero_entitywrapper\Plugin\Zero\EntityWrapper;

use Drupal\Core\Annotation\Translation;
use Drupal\zero_entitywrapper\Annotation\ZeroPluginBuilder;
use Drupal\zero_entitywrapper\Base\BaseWrapperExtensionInterface;
use Drupal\zero_entitywrapper\Base\BaseWrapperInterface;
use Drupal\zero_entitywrapper\Base\WrapperExtenderInterface;
use Drupal\zero_entitywrapper\Base\ZeroPluginBuilderInterface;
use Drupal\zero_entitywrapper\Content\ContentDisplayCollectionWrapper;
use Drupal\zero_entitywrapper\Content\ContentDisplayWrapper;
use Drupal\zero_entitywrapper\Content\ContentViewWrapper;
use Drupal\zero_entitywrapper\Content\ContentWrapper;
use Drupal\zero_entitywrapper\Wrapper\BaseWrapper;
use Drupal\zero_entitywrapper\Wrapper\RenderContextWrapper;


/**
 * @ZeroPluginBuilder(
 *   id = "default_wrapper_extender",
 *   label = "DefaultWrapperExtender"
 * )
 */
class DefaultWrapperExtender implements ZeroPluginBuilderInterface {

  public function getExtension(BaseWrapperInterface $wrapper, string $name, array $args = []): ?BaseWrapperExtensionInterface {
    switch ($name) {
      case 'view':
        if ($wrapper instanceof ContentWrapper) {
          return new ContentViewWrapper();
        }
        break;
      case 'display':
        if ($wrapper instanceof ContentWrapper) {
          return new ContentDisplayWrapper();
        }
        break;
      case 'display.collection':
        if ($wrapper instanceof ContentWrapper) {
          return new ContentDisplayCollectionWrapper();
        }
        break;
      case 'render_context':
        if ($wrapper->parent() === NULL) {
          return new RenderContextWrapper();
        } else {
          return $wrapper->root()->getExtension('render_context');
        }
    }
    return NULL;
  }

}
