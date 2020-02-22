<?php

/**
 * Implemented hook_preprocess_node().
 */
function pnt_front_preprocess_node__event__homepage_widget_event_teaser(&$variables, $hook) {
    $node = $variables['node'];

    $floor = \Drupal::service('entity_type.manager')->getStorage('paragraph')->loadRevision($node->field_event_floor->value);
    $variables['floor'] = $floor->field_floor->value;
    $variables['universe'] = $floor->field_floor_description->value;

    $from_date = strtotime($node->field_dates->value);
    $to_date = strtotime($node->field_dates->end_value);

    $dateFormatter = \Drupal::service('date.formatter');
    $variables['from_date'] = $dateFormatter->format($from_date, 'custom', 'd') . ' ' . t($dateFormatter->format($from_date, 'custom', 'F'));
    $variables['to_date'] = $dateFormatter->format($to_date, 'custom', 'd') . ' ' . t($dateFormatter->format($to_date, 'custom', 'F'));

    $from_date = $dateFormatter->format($from_date, 'custom', 'Ymd');
    $to_date = $dateFormatter->format($to_date, 'custom', 'Ymd');

    $current_shop_id = \Drupal::service('pnt_common.floors_with_description_helper')->getStoreByFloorParagraphRevisionId($node->field_event_floor->value);
    $place_string = '';
    if (!empty($current_shop_id)) {
        $current_shop = \Drupal::service('entity_type.manager')
            ->getStorage('node')
            ->load(reset($current_shop_id));
        if ($current_shop && $current_shop instanceof NodeInterface) {
            $place_string = $current_shop->getTitle();
        }
    }

    $description = preg_replace('/\s\s+/', '', strip_tags($node->field_description->value));
    $variables['google_event_string'] = "https://www.google.com/calendar/render?action=TEMPLATE&text={$node->getTitle()}&dates=$from_date/$to_date&details=$description&location=$place_string&sf=true&output=xml";

}
