This module is combination of wincachedrupal and coockie_aware_page_cache.

TO INSTALL

Add Cookie-Aware Page Cache to the list of available cache backends by adding
these lines to the settings.php:

$conf['cache_backends'][] = 'sites/all/modules/contrib/cookie_aware_page_cache/drupal_win_cache.inc';
$conf['cache_backends'][] = 'sites/all/modules/custom/cookie_aware_page_cache/AtjWincacheCoockieAwareCache.inc';

$conf['cache_default_class'] = 'AtjWincacheCoockieAwareCache';
;$conf['cache_class_cache_page'] = 'AtjWincacheCoockieAwareCache';

 # Keep forms in persistent storage.
$conf['cache_class_cache_form'] = 'DrupalDatabaseCache';
 # I don't see any point in keeping the module update information in external cache.
$conf['cache_class_cache_update'] = 'DrupalDatabaseCache';