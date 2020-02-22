<?php
function pnt_front_preprocess_widget__event_display__default(&$variables, $hook) {
    $variables['#cache']['tags'][] = 'node:event';

    $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();

    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {
        $store_nid = $node->id();
    }
    else {
        return;
    }

    $all_store_floors = \Drupal::service('pnt_common.floors_with_description_helper')->getAllDescriptionRevisionsByStoreId($store_nid);

    $now = new DrupalDateTime('now');
    $events_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

    $events = $events_query->condition('type', 'event')
        ->condition('status', NodeInterface::PUBLISHED)
        ->condition('field_event_floor', $all_store_floors, 'IN')
        ->condition('field_dates.end_value', $now->format(DateTimeItemInterface::DATETIME_STORAGE_FORMAT), '>')
        ->execute();

    if (!empty($events)) {
        $events = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadMultiple($events);
        $variables['events'] = \Drupal::entityTypeManager()
            ->getViewBuilder('node')
            ->viewMultiple($events, 'store_widget_event_teaser');
    }

}
