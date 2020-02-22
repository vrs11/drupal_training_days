<?php
/*
 * Good code examples.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * NewsLetters constructor.
 */
public function __construct($configuration, $plugin_id, $plugin_definition, LanguageManagerInterface $language_manager, ConfigFactoryInterface $configFactory, EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->languageManager = $language_manager;
    $this->configFactory = $configFactory;
    $this->entityTypeManager = $entityTypeManager;
}