<?php

namespace Drupal\zero_entitywrapper\Base;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\zero_entitywrapper\Service\EntitywrapperService;
use Symfony\Component\HttpFoundation\Request;

interface BaseWrapperInterface {

  /**
   * Set the render context array for cache control
   *
   * @param array $vars
   * @return self
   */
  public function setRenderContext(array &$vars): self;

  /**
   * Get the render context of this wrapper
   *
   * @see BaseWrapperInterface::root()
   *
   * @return array|null
   */
  public function &getRenderContext(): ?array;

  /**
   * Get the render context wrapper to edit cache control
   *
   * @return RenderContextWrapperInterface
   */
  public function renderContext(): RenderContextWrapperInterface;

  /**
   * Set the parent wrapper, transmit config from parent to child
   *
   * @see BaseWrapperInterface::getConfig()
   *
   * @param BaseWrapperInterface|NULL $parent
   * @return self
   */
  public function setParent(BaseWrapperInterface $parent = NULL): self;

  /**
   * Get the parent wrapper
   *
   * @return BaseWrapperInterface|null
   */
  public function parent(): ?BaseWrapperInterface;

  /**
   * Get the root parent
   *
   * @return BaseWrapperInterface
   */
  public function root(): BaseWrapperInterface;

  /**
   * Get the entity of this wrapper
   *
   * @return EntityInterface
   */
  public function entity(): EntityInterface;

  /**
   * Get the type of the entity
   *
   * @return string
   */
  public function type(): string;

  /**
   * Get the bundle of the entity
   *
   * @return string
   */
  public function bundle(): string;

  /**
   * Get the bundle object
   *
   * @return ConfigEntityBundleBase
   */
  public function getBundle(): ConfigEntityBundleBase;

  /**
   * Get the id of the entity
   *
   * @return mixed
   */
  public function id();

  /**
   * Call a preprocess file of another template
   *
   * @param string $template
   * @return self
   */
  public function extendPreprocess(string $template): self;

  /**
   * Get the extension wrapper for a givin function
   *
   * @param string $name
   * @param ...$args
   * @return BaseWrapperExtensionInterface
   */
  public function getExtension(string $name, ...$args): BaseWrapperExtensionInterface;

  /**
   * Render the entity in a givin view mode
   *
   * @param string $view_mode
   * @param array $options = [
   *     'langcode' => 'en',
   * ]
   * @return array
   */
  public function render(string $view_mode = 'full', array $options = []): array;

  /**
   * Get the EntityWrapper service
   *
   * @return EntitywrapperService
   */
  public function getService(): EntitywrapperService;

  /**
   * Get the config with the givin name
   *
   * @param string $config
   * @return mixed
   */
  public function getConfig(string $config);

  /**
   * Get all configs
   *
   * @return array
   */
  public function getConfigs(): array;

  /**
   * Set the given config
   *
   * @param string $config
   * @param mixed $value
   * @return self
   */
  public function setConfig(string $config, $value = TRUE): self;

  /**
   * Set all configs
   *
   * @param array $configs
   * @return self
   */
  public function setConfigs(array $configs): self;

  /**
   * Clone the wrapper and apply given config
   *
   * @param string $config
   * @param $value
   * @return $this
   */
  public function config(string $config, $value = TRUE): static;

  /**
   * Get entity meta data to rebuild state
   *
   * @return array = [
   *     'entity_type' => $this->type(),
   *     'entity_bundle' => $this->bundle(),
   *     'entity_id' => $this->id(),
   * ]
   */
  public function getEntityMeta(): array;

  /**
   * Get the language object of the entity
   *
   * @return LanguageInterface
   */
  public function language(): LanguageInterface;

  /**
   * Get the langcode as string
   *
   * @see BaseWrapperInterface::language()
   *
   * @return string|null
   */
  public function langcode(): ?string;

  /**
   * Set language of the entity
   *
   * @see TranslatableInterface::getTranslation()
   * @see LanguageInterface::getId()
   *
   * @param LanguageInterface|string $language
   * @return self
   */
  public function setLanguage($language): self;

  /**
   * Set the current language
   *
   * @see BaseWrapperInterface::setLanguage()
   * @see \Drupal::languageManager()->getCurrentLanguage()
   *
   * @return self
   */
  public function setCurrentLanguage(): self;

  /**
   * @param Request|NULL $request
   * @return string
   */
  public function getMultiSite(Request $request = NULL): string;

}
