<?php
/*
 * Good code examples.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * Early return and cognitive complexity.
 */

//not good example
function some_function() {
    if ($this->configFactory->get('some config')->get('some value')) {
        $unsubscribe_nid = $this->configFactory->get('some config')->get('some nid');
        $unsubscribe = $this->entityTypeManager->getStorage('node')->load($unsubscribe_nid);
        if (!empty($unsubscribe)) {
            $node = $unsubscribe;

            if ($unsubscribe->hasTranslation($langcode)) {
                $unsubscribe = $unsubscribe->getTranslation($langcode);
                return [
                    'body' => $this->entityTypeManager->getViewBuilder('node')->view($node),
                ];
            }
        }
    }

    if (empty($node)) {
        $routeName = '<front>';
        $routeParameters = [];

        return $this->redirect($routeName, $routeParameters);
    }
}

//refactoring
CONST FRONT_ROUT_NAME = '<front>';
CONST FRONT_ROUT_PARAMS = [];

function some_function() {
    if (
        empty($unsubscribe_nid = $this->configFactory->get('some config')->get('some nid')) || //check if there is some nid value
        empty($unsubscribe = $this->entityTypeManager->getStorage('node')->load($unsubscribe_nid)) || //check if there is a node with this id
        $unsubscribe->hasTranslation($langcode) == FALSE //check if node has a translation
    ) {
        return $this->redirect(FRONT_ROUT_NAME, FRONT_ROUT_PARAMS);
    }

    $unsubscribe = $unsubscribe->getTranslation($langcode);
    return ['body' => $this->entityTypeManager->getViewBuilder('node')->view($unsubscribe)];
}
