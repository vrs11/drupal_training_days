<?php
function pnt_front_preprocess_node__service_landing__full(&$variables, $hook) {
    $node = $variables['node'];
    $current_service_tid = $node->field_service_type->target_id;
    if (!empty($current_service_tid)) {
        $term_storage = \Drupal::service('entity_type.manager')
            ->getStorage('taxonomy_term');
        $children = $term_storage->loadChildren($current_service_tid, 'service_type');
        if (!empty($children)) {
            $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
            $parameters = \Drupal::request()->query->all();
            $variables['active_filter'] = $parameters['service_filter'];
            foreach ($children as $tid => $child) {
                if ($child->hasTranslation($variables['current_language'])) {
                    $child = $child->getTranslation($variables['current_language']);
                }
                $variables['filters'][$tid] = $child->getName();
                asort($variables['filters']);
                if (!empty($parameters['service_filter']) && $parameters['service_filter'] !== 'all' && $parameters['service_filter'] != $tid) {
                    continue;
                }
                $related_service_details[$tid] = \Drupal::service('printemps_sl.related_services.loader')
                    ->loadServiceDetailsPagesByServiceType($tid);
                if (empty($related_service_details[$tid])) {
                    continue;
                }

                $variables['related_service_details'][$tid] = $view_builder->viewMultiple($related_service_details[$tid], 'teaser_on_service_landing');
            }

            array_push($variables['#cache']['contexts'], 'url.query_args:service_filter');

            array_push($variables['#cache']['tags'],
                'node:service_details',
                'node:service_landing'
            );
        }
    }
}
