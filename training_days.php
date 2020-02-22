<?php
/*
 * Good code examples.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * {@inheritdoc}
 */
public function loadArticlesForStore($limit = NULL) {
    $langcode = $this->languageManager->getCurrentLanguage()->getId();
    $store_id = $this->preferredShop->getCurrentShop()->id();
    $cid  = __FUNCTION__;
    $cid .= '-';
    $cid .= $langcode;
    $cid .= ':';
    $cid .= $store_id;

    if ($cache_data = $this->cache->get($cid)) {
        return $cache_data->data['articles'];
    }
    else {

        $query = $this->endPointEntities->getEntityTypeManager()->getStorage('node')->getQuery();
        $query->condition('type', 'editorial');
        $query->condition(static::STORE_FIELD, $store_id);
        $query->condition('status', 1);
        $query->sort('changed', 'DESC');
        $query->range(0, $limit ?? static::DEFAULT_ARTICLES_CNT);
        $nids =  $query->execute();

        if (empty($nids)) {
            return [];
        }

        $related_articles = $this->endPointEntities
            ->getEntityTypeManager()
            ->getStorage('node')
            ->loadMultiple($nids);
        foreach ($related_articles as &$article) {
            if ($article->hasTranslation($langcode)) {
                $article = $article->getTranslation($langcode);
            }
        }

        $this->cache->set($cid, ['articles' => $related_articles], Cache::PERMANENT, ['node:editorial']);

        return $related_articles;
    }
}
