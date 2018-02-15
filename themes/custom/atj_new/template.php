<?php
/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */

define('__THEME_ATJ_NEW_PATH', drupal_get_path('theme', 'atj_new'));
define('ATJ_NEW_NEWS_LANDING_NID', 9);
define('ATJ_404_NID', 243);
define('ATJ_NEW_PRESS_LIST_NID', 272);
define('ATJ_NEW_PRESS_LANDING_NID', 271);
define('ATJ_NEW_DESTINATIONS_LANDING_NID', 357);
define('ATJ_NEW_DOWNLOAD_CUSTOM_PLANNER_LANDING_NID', 414);
define('ATJ_NEW_DONATION_MESSAGE_NID', 411);
define('ATJ_NEW_DONATIONS_WEBFORM_NAME_CID', 1);
define('ATJ_NEW_DONATIONS_WEBFORM_CITY_CID', 2);
define('ATJ_NEW_DONATIONS_WEBFORM_STATE_CID', 3);
define('ATJ_NEW_DONATIONS_WEBFORM_MESSAGE_CID', 4);
define('ATJ_NEW_CATALOG_ULR', 'onlinecatalog');

/**
 * Implements template_preprocess_html().
 */
function atj_new_preprocess_html(&$vars) {

  $HandheldFriendly = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'HandheldFriendly',
      'content' => 'false',
    ),
    '#weight' => -900,
  );
  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1',
    ),
    '#weight' => -899,
  );

  drupal_add_html_head($HandheldFriendly, 'HandheldFriendly');
  drupal_add_html_head($viewport, 'viewport');

  if ($node = menu_get_object()) {
    switch ($node->type) {
      case 'news':
      case 'news_top_destinations':
      case 'news_gallery_bottom':
        $vars['classes_array'][] = 'page-news';
        break;
      case 'country_overview':
      case 'regions':
      case 'accommodations':
      case 'weather':
      case 'tailored_trips':
        $vars['classes_array'][] = 'without-parallax';
        break;
      case 'page':
        $menuParent = menu_get_active_trail();
        array_pop($menuParent);
        $menuParent = end($menuParent);
        if (!empty($menuParent) && $menuParent['link_path'] !== '') {
          $node_path = explode('/', $menuParent['href']);
          $parent_node = count($node_path) ? node_load($node_path[1]) : $node;
          if ($parent_node->type == 'country_overview') {
            $vars['classes_array'][] = 'without-parallax';
          }
        }
        break;
      case 'webform_donation_message':
      case 'donation':
        $vars['classes_array'][] = 'page-foundation';
        break;
      case 'wanderlust':
      case 'map':
        $vars['classes_array'][] = 'page-' . $node->type;
        break;
    }
  }

  $vars['telephone'] = variable_get('telephone', '');
}

/**
 * Implements template_preprocess_page().
 */
function atj_new_preprocess_page(&$vars) {
  $vars['content_wrapper_class'] = array();
  $vars['content_inner_class'] = array();
  if(isset($vars['node'])) {
    $node = $vars['node'];
  } else {
    //try load webform node
    $node = menu_get_object('webform_menu');
  }
  $parent_node = $node;

  $vars['content_wrapper_class'][] = 'container';
  $vars['content_wrapper_class'][] = 'content-wrapper';

  $top_fields = array(
    'field_common_top_image',
    'field_common_top_desc',
    'field_common_bg_image',
  );

  $region_section_title_prefix = '<h4>';
  $region_section_title_suffix = '</h4>';
  $region_section_show_form = TRUE;

  if (!empty($node)) {

    switch ($node->type) {
      case 'home_new':
        $vars['content_wrapper_class'] = array();
        break;
      case 'news':
      case 'news_top_destinations':
      case 'news_gallery_bottom':
        $parent_node = node_load(ATJ_NEW_NEWS_LANDING_NID);
        $vars['parent_node'] = $parent_node;
        $top_fields[] = 'body';

        $vars['content_inner_class'][] = 'clearfix';
        break;
      case 'travel_asia':
        $top_fields[] = 'body';
        $vars['field_hn_plan_items'] = field_view_field('node', $parent_node, 'field_hn_plan_items', array(
          'label'=>'hidden',
          'type' => 'field_collection_fields',
        ));
        break;
      case 'country_overview':
        $vars['content_wrapper_class'] = array();
        break;
      case 'page':
      case 'accommodations':
      case 'regions':
      case 'group_trip_detail':
      case 'tailored_trips':
      case 'stewardship':
      case 'weather':
        $menuParent = menu_get_active_trail();
        array_pop($menuParent);
        if ($node->type === 'group_trip_detail') {
          array_pop($menuParent);
        }
        $menuParent = end($menuParent);
        if (!empty($menuParent) && $menuParent['link_path'] !== '') {
          $node_path = explode('/', $menuParent['href']);
          $parent_node = count($node_path) ? node_load($node_path[1]) : $node;
          $vars['parent_node'] = $parent_node;
          $top_fields_value_override = _atj_get_rows_from_node($node, $top_fields);
        }
        if ($node->nid == ATJ_NEW_PRESS_LIST_NID) {
          $parent_node = node_load(ATJ_NEW_PRESS_LANDING_NID);
        }
        if ($node->nid == ATJ_NEW_NEWS_LANDING_NID) {
          $top_fields[] = 'body';
        }
        if ($node->type == 'regions') {
          $vars['content_wrapper_class'] = array();
          $vars['content_wrapper_class'][] = 'content-wrapper';
        }
      break;
      case 'webform_donation_message':
      case 'donation_success':
      case 'donation_share':
        $vars['theme_hook_suggestions'][] = 'page__without_top_section';
        atj_new_preprocess_page_add_lantern_values_settings(
          ATJ_NEW_DONATION_MESSAGE_NID
        );
        $vars['page']['popups'][] = array(
          '#markup' => '<div id="tooltip-donation-1" class="donation-tooltip">
              <div class="title">
                <div class="name">
                </div>
                <div class="address">
                </div>
              </div>
              <div class="text">
              </div></div>',
        );
        break;
      case 'donation':
        atj_new_preprocess_page_add_lantern_values_settings(
          ATJ_NEW_DONATION_MESSAGE_NID
        );
        $vars['page']['popups'][] = array(
          '#markup' => '<div id="tooltip-donation-1" class="donation-tooltip">
              <div class="title">
                <div class="name">
                </div>
                <div class="address">
                </div>
              </div>
              <div class="text">
              </div></div>',
        );
        break;
      case 'webform_donation':
        $vars['page']['popups'][] = array(
          '#markup' => '<div id="tooltip-donation-1" class="donation-tooltip">
            <div class="title">
              <div class="name">
              </div>
              <div class="address">
              </div>
            </div>
            <div class="text">
            </div></div>',
        );
        break;
      case 'wanderlust':
        $destination_generator_block = block_load('bean', 'destination-generator-wanderlust');
        $destination_generator_render_array = _block_get_renderable_array(_block_render_blocks(array($destination_generator_block)));
        if (isset($destination_generator_render_array) && !empty($destination_generator_render_array)) {
          $vars['destination_generator'] = drupal_render($destination_generator_render_array);
        }

        $vars['content_wrapper_class'] = array();
        $vars['content_wrapper_class'][] = 'content-wrapper';
        $vars['content_inner_class'][] = 'container';
        break;
    }
  }

  if (isset($vars['page']['subnavigation']['atj_custom_atj_custom_social_share_block'])) {
    $vars['share_block'] = drupal_render($vars['page']['subnavigation']['atj_custom_atj_custom_social_share_block']);
    $vars['page']['subnavigation']['atj_custom_atj_custom_social_share_block']['#access'] = FALSE;
  }

  $top_fields_value = _atj_get_rows_from_node($parent_node, $top_fields);
  if (!empty($top_fields_value_override['field_common_top_image'])) {
    $vars['top_image'] = file_create_url($top_fields_value_override['field_common_top_image']['uri']);
  }
  else if (!empty($top_fields_value['field_common_top_image'])) {
    $vars['top_image'] = file_create_url($top_fields_value['field_common_top_image']['uri']);
  }
  if (!empty($top_fields_value['field_common_top_desc'])) {
    $vars['body'] = $top_fields_value['field_common_top_desc']['safe_value'];
  }
  if (!empty($top_fields_value['body'])) {
    $vars['body'] = $top_fields_value['body']['safe_value'];
  }
  if (!empty($top_fields_value['field_common_bg_image'])) {
    $vars['field_common_bg_image'] = file_create_url($top_fields_value['field_common_bg_image']['uri']);
  }
  if (in_array('page__search', $vars['theme_hook_suggestions'])) {
    $vars['top_image'] = file_create_url(path_to_theme() . '/images/tmp/section-top-img-20.jpg');
    $vars['search_top'] = $vars['page']['content']['system_main']['search_form'];
    $vars['hide_title'] = 'TRUE';
    $vars['page']['content']['system_main']['search_form']['#access'] = FALSE;
  }
  $vars['page_top_section'] = theme('page_top_section', $vars);

  $top_fields = array(
    'field_region_title',
    'field_region_text',
    'field_region_background',
  );
  $top_fields_value = _atj_get_rows_from_node($node, $top_fields);

  if (isset($top_fields_value) && !empty($top_fields_value)) {
    $background_img = !empty($top_fields_value['field_region_background']) ?
      file_create_url($top_fields_value['field_region_background']['uri']) : '';
    $title = !empty($top_fields_value['field_region_title']) ?
      $top_fields_value['field_region_title'] : '';
    $text = !empty($top_fields_value['field_region_text']) ?
      $top_fields_value['field_region_text']['value'] : '';
    $vars['region_section'] = theme('atj_new_region__section', array(
      'background_img' => $background_img,
      'title_prefix' => $region_section_title_prefix,
      'title' => $title,
      'title_suffix' => $region_section_title_suffix,
      'text' => $text,
      'show_form' => !empty($region_section_show_form) ? atj_new_get_planner_link() : '',
    ));
  }

  $obapi_js = array(
    '#type' => 'markup',
    '#weight' => '-99',
    '#markup' => "<script data-obct type=\"text/javascript\">
      /** DO NOT MODIFY THIS CODE**/
      !function(_window, _document) {
      var OB_ADV_ID='0001b078d11d5a0fbc94ef8e62eeb5db95';
      if (_window.obApi) { return; }
      var api = _window.obApi = function() {api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);};api.version = '1.0';api.loaded = true;api.marketerId = OB_ADV_ID;api.queue = [];var tag = _document.createElement('script');tag.async = true;tag.src = '//amplify.outbrain.com/cp/obtp.js';tag.type = 'text/javascript';var script = _document.getElementsByTagName('script')[0];script.parentNode.insertBefore(tag, script);}(window, document);
      obApi('track', 'PAGE_VIEW');
      </script>",);

  drupal_add_html_head($obapi_js, 'atj_obapi');
}

/**
 * Preprocess function for header top section.
 *
 * @param array $vars
 *   copy of preprocess_pages $vars
 */
function atj_new_preprocess_page_top_section(&$vars) {

  if (!isset($vars['hide_title'])) {
    $vars['title'] = drupal_get_title();
  }

  if(!empty($vars['node'])) {
    $node = $vars['node'];
    $vars['theme_hook_suggestions'][] = 'page_top_section__node__' . $node->type;

    switch($node->type) {
      case 'news':
      case 'news_top_destinations':
      case 'news_gallery_bottom':
      case 'page':
      case 'accommodations':
      case 'regions':
      case 'group_trip_detail':
      case 'tailored_trips':
      case 'team':
      case 'stewardship':
      case 'weather':
        $parent_node = !empty($vars['parent_node']) ? $vars['parent_node'] : $node;
        $vars['title'] = $parent_node->title;
        break;
      case 'donation':
        $section_additional_classes[] = 'style-f';
        $vars['theme_hook_suggestions'][] = 'page_top_section__style_f';
        $vars['donation_link'] = field_view_field('node', $node, 'field_donation_link',array('label'=>'hidden'));
        $vars['body'][] = field_view_field('node', $node, 'field_donation_top_text',array('label'=>'hidden'));
        break;
      case 'webform_donation':
        $section_additional_classes[] = 'style-f';
        $vars['theme_hook_suggestions'][] = 'page_top_section__style_f';
        $vars['body'] = field_view_field('node', $node, 'field_w_donation_top_text',array('label'=>'hidden'));
        atj_new_preprocess_page_add_lantern_values_settings(
          ATJ_NEW_DONATION_MESSAGE_NID
        );
        break;
    }
  }

}

/**
 * Implements template_preprocess_node().
 */
function atj_new_preprocess_node(&$vars) {
  $node = $vars['node'];
  if (!$vars['page']) {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
  }

  _atj_new_disable_access($vars['content']['field_common_top_image']);
  _atj_new_disable_access($vars['content']['field_common_top_desc']);
  _atj_new_disable_access($vars['content']['field_common_bg_image']);

  switch ($node->type) {
    case 'home_new':
      $vars['news_block'] = views_embed_view('news_homepage', 'block');
      break;
    case 'travel_experts':
      $vars['body_wrap_classes'] = 'container-with-57';
      $vars['theme_hook_suggestions'][] = 'node__body_wrapped';
      break;
    case 'contact_us':
      $vars['body_wrap_classes'] = 'container-with-61 container-style-c';
      $vars['theme_hook_suggestions'][] = 'node__body_wrapped';
      break;
    case 'news':
    case 'news_gallery_bottom':
      $back_link_title = t('SEE ALL OUR LUXURY TRAVEL ARTICLERS');
      $vars['back_link'] = l($back_link_title, 'node/' . ATJ_NEW_NEWS_LANDING_NID, array(
        'attributes' => array('class' => array('link style-burgundy')),
        'html' => TRUE
      ));

      $sharethis = !empty($vars['content']['sharethis']) ? $vars['content']['sharethis']['#value'] : '';
      $mPath = url('node/' . $vars['nid'], array('absolute' => TRUE));
      $mTitle = $vars['title'];
      $sharethis = strip_tags($sharethis, '<span>');

      if (!empty($sharethis)) {
        $sharethis .= theme('html_tag', array(
          'element' => array(
            '#tag' => 'span',
            '#attributes' => array(
              'st_url' => $mPath,
              'st_title' => $mTitle,
              'class' => array('st_email_hcount', 'link-mail ss-icon ss-glyphish-outlined ss-mail'),
            ),
            '#value' => '',
          ),
        ));

        $vars['content']['sharethis']['#value'] = $sharethis;
      }
      break;
    case 'news_top_destinations':
      $vars['title'] = html_entity_decode($vars['title']);
      $back_link_title = t('SEE ALL OUR LUXURY TRAVEL ARTICLERS');
      $vars['back_link'] = l($back_link_title, 'node/' . ATJ_NEW_NEWS_LANDING_NID, array(
        'attributes' => array('class' => array('link style-burgundy')),
        'html' => TRUE
      ));

      $sharethis = !empty($vars['content']['sharethis']) ? $vars['content']['sharethis']['#value'] : '';
      $mPath = url('node/' . $vars['nid'], array('absolute' => TRUE));
      $mTitle = $vars['title'];
      $sharethis = strip_tags($sharethis, '<span>');

      if (!empty($sharethis)) {
        $sharethis .= theme('html_tag', array(
          'element' => array(
            '#tag' => 'span',
            '#attributes' => array(
              'st_url' => $mPath,
              'st_title' => $mTitle,
              'class' => array('st_email_hcount', 'link-mail ss-icon ss-glyphish-outlined ss-mail'),
            ),
            '#value' => '',
          ),
        ));

        $vars['content']['sharethis']['#value'] = $sharethis;
      }

      if ($vars['view_mode'] == 'teaser') {
        $items = field_get_items('node', $node, 'field_news_td_items');
        if(!empty($items[0]['value'])) {
          $field_collection_item = field_collection_item_load($items[0]['value']);
          $fc_fields = array(
            'field_news_td_items_image',
          );
          foreach ($fc_fields as $fc_field) {
            $vars['content'][$fc_field] = field_view_field('field_collection_item', $field_collection_item, $fc_field, 'teaser');
          }
        }
      }
      break;
    case 'page':
      if ($node->nid == ATJ_NEW_NEWS_LANDING_NID) {
        _atj_new_disable_access($vars['content']['body']);
      }
      if ($node->nid == ATJ_404_NID) {
        $vars['body_wrap_classes'] = 'b-container container-style-c';
        $vars['theme_hook_suggestions'][] = 'node__body_wrapped';
      }
      break;
    case 'travel_asia':
      _atj_new_disable_access($vars['content']['body']);
      _atj_new_disable_access($vars['content']['field_hn_plan_items']);
      break;
    case 'weather':
      $path = drupal_get_path('theme', 'atj_new');
      drupal_add_js($path . '/js/lib/d3.v3.min.js');
      drupal_add_js($path . '/js/weather.js');
      break;
    case 'regions':
      $vars['classes_array'][] = 'container';
      break;
    case 'group_trip_detail':
      $menuParent = menu_get_active_trail();
      if (count($menuParent) > 4) {
        $parent_title = !empty($menuParent['3']['link_title']) ? $menuParent['3']['link_title'] : '';
        $parent_url = !empty($menuParent[3]['link_path']) ? $menuParent[3]['link_path'] : '';
        if ($parent_title === t('Group Trips')){
          $vars['back_link'] = l(t('BACK TO GROUP TRIPS'), $parent_url, array(
            'attributes' => array('class' => array('link', 'style-burgundy')))
          );
        }
      }
      break;
    case 'country_overview':
      if ($vars['view_mode'] == 'destination_generator') {
        $background = _atj_get_rows_from_node($node, array('field_region_background'));
        $vars['background'] = !empty($background['field_region_background']) ?
          file_create_url($background['field_region_background']['uri']) : '';

        $menu_item = menu_link_get_preferred('node/' . $node->nid, 'main-menu');
        if ($menu_item) {
          $menu_parent_item = _menu_link_find_parent($menu_item);
          if ($menu_parent_item && isset($menu_parent_item['link_title'])) {
            $vars['title'] = $menu_parent_item['link_title'];

            $map = trim($vars['title']);
            $map = strtolower($map);
            $map = str_replace(' ', '-', $map);
            $vars['map'] = __THEME_ATJ_NEW_PATH . '/images/maps/map-' . $map . '.png';
          }
        }

        $contextual_link = array_search('contextual-links-region', $vars['classes_array']);
        if (!empty($contextual_link)) {
          unset($vars['classes_array'][$contextual_link]);
        }
      }
      break;
    case 'donation_success':
      if(!empty($node->field_common_top_image[LANGUAGE_NONE][0]['uri'])) {
        $vars['top_image'] = file_create_url($node->field_common_top_image[LANGUAGE_NONE][0]['uri']);
      }
      if(!empty($_GET['n']) && !empty($_GET['s'])) {
        $webform_node = node_load($_GET['n']);
        if($webform_node->type =='webform_donation_message') {
          $submission = webform_menu_submission_load($_GET['s'], $_GET['n']);
          $vars['donation'] = theme(
            'atj_new_lantern_submission',
            array('content' =>
              array(
                'name' => !empty($submission->data[ATJ_NEW_DONATIONS_WEBFORM_NAME_CID][0]) ? check_plain($submission->data[ATJ_NEW_DONATIONS_WEBFORM_NAME_CID][0]) : '',
                'city' => !empty($submission->data[ATJ_NEW_DONATIONS_WEBFORM_CITY_CID][0]) ? check_plain($submission->data[ATJ_NEW_DONATIONS_WEBFORM_CITY_CID][0]) : '',
                'state' => !empty($submission->data[ATJ_NEW_DONATIONS_WEBFORM_STATE_CID][0]) ? check_plain($submission->data[ATJ_NEW_DONATIONS_WEBFORM_STATE_CID][0]) : '',
                'message' => !empty($submission->data[ATJ_NEW_DONATIONS_WEBFORM_MESSAGE_CID][0]) ? check_plain($submission->data[ATJ_NEW_DONATIONS_WEBFORM_MESSAGE_CID][0]) : '',
              )
            )
          );
        }
      }
      break;
    case 'webform_donation_message':
    case 'donation_share':
      if(!empty($node->field_common_top_image[LANGUAGE_NONE][0]['uri'])) {
        $vars['top_image'] = file_create_url($node->field_common_top_image[LANGUAGE_NONE][0]['uri']);
      }
      $vars['lantern_image'] = file_create_url(path_to_theme() . '/images/tmp/lanterns-bg.png');
      break;
    case 'map':
      $vars['mobile'] = views_embed_view('map', 'list');
      break;
    case 'webform_catalog':
      $vars['top_figure_classes'] = 'b-figcaption';
      if($node->nid == ATJ_WEBFORM_CATALOG_REQUEST2_NID) {
        $vars['top_figure_classes'] .= ' style-b';
        _atj_disable_access($vars['content']['field_catalog_preview_image']);
      }
      break;
  }
}

/**
 * Implements hook_preprocess_field().
 */
function atj_new_preprocess_field(&$vars, $hook) {
  $element = $vars['element'];
  switch ($element['#field_name']) {
    case 'field_rewards_images':
      $vars['classes_array'][] = 'img-wrap';
      $vars['theme_hook_suggestions'][] = 'field__main_wrapper';
      break;
    case 'field_home_new_top_slider':
      $vars['bg_images'] = array();
      $bg_images = _atj_new_rows_from_field_collection($vars, array('field_home_new_top_slide_bg_img'));
      foreach ($bg_images as $bg_image) {
        $vars['bg_images'][] = !empty($bg_image['field_home_new_top_slide_bg_img']) ?
          file_create_url($bg_image['field_home_new_top_slide_bg_img']['uri']) : '';
      }
      break;
    case 'field_home_new_top_slide_pg_ttl':
    case 'field_hn_top_dest_items_img':
    case 'field_hn_top_dest_items_mob_img':
    case 'field_hn_top_dest_items_hov_img':
    case 'field_hn_top_dest_items_title':
    case 'field_hn_trips_pg_ttl':
    case 'field_f_dest_2_col_desc':
    case 'field_f_dest_2_col_left':
    case 'field_f_dest_2_col_right':
    case 'field_donation_head_text':
      $vars['theme_hook_suggestions'][] = 'field__no_wrappers';
      break;
    case 'field_home_new_top_slide_link':
    case 'field_hn_trips_link':
      $vars['theme_hook_suggestions'][] = 'field__no_wrappers';
      if (!empty($vars['items'])) {
        $vars['items'][0]['#element']['display_url'] = '';
        $vars['items'][0]['#element']['title'] = '';
      }
      break;
    case 'field_hn_plan_items':
      $vars['images'] = array();
      $images = _atj_new_rows_from_field_collection($vars, array('field_hn_plan_items_image'));
      foreach ($images as $key => $image) {
        $vars['images'][$key] = !empty($image['field_hn_plan_items_image']) ?
          file_create_url($image['field_hn_plan_items_image']['uri']) : '';
      }
      break;
    case 'field_hn_trips':
      $vars['bg_images'] = array();
      $bg_images = _atj_new_rows_from_field_collection($vars, array('field_hn_trips_bg_img'));
      foreach ($bg_images as $bg_image) {
        $vars['bg_images'][] = !empty($bg_image['field_hn_trips_bg_img']) ?
          file_create_url($bg_image['field_hn_trips_bg_img']['uri']) : '';
      }
      break;
    case 'field_planning_items_desc':
      $vars['classes_array'][] = 'text';
      $vars['theme_hook_suggestions'][] = 'field__main_wrapper';
      break;
    case 'field_planning_items_link':
      $vars['classes_array'][] = 'btn';
      $vars['theme_hook_suggestions'][] = 'field__main_wrapper';
      break;
    case 'field_news_td_items_image':
      if (!empty($vars['items'])) {
        $item = $vars['items'][0];
        if (!empty($item['#image_style'])) {
          $vars['bg_image'] = image_style_url($item['#image_style'], $item['#item']['uri']);
        }
        else {
          $vars['bg_image'] = file_create_url($item['#item']['uri']);
        }
      }

      if ($element['#view_mode'] == 'teaser') {
        $vars['theme_hook_suggestions'][] = 'field__no_wrappers';
      }
      break;
    case 'field_f_dest_paragraphs':
      if (!empty($vars['items'])) {
        $item = current($vars['items'][0]['entity']['paragraphs_item']);
        $bundle = !empty($item['#bundle']) ? $item['#bundle'] : '';
        $vars['theme_hook_suggestions'][] = 'field__field_f_dest_paragraphs__' . $bundle;
      }
      break;
    case 'field_toll_free':
    case 'field_contact_local':
      $vars['span'] = '<span class="ico ss-icon ss-glyphish-outlined ss-phone"></span>';
      $vars['theme_hook_suggestions'][] = 'field__field_contact_us_phone';
      break;
    case 'field_contact_fax':
      $vars['span'] = '<span class="ico ss-icon ss-glyphish-outlined ss-print"></span>';
      $vars['theme_hook_suggestions'][] = 'field__field_contact_us_phone';
      break;
    case 'field_itenerary_text':
      // Malo vremeni
      $vars['link_text'] = t('GET YOUR CUSTOM PLANNER ');
      $menuParent = menu_get_active_trail();
      if (count($menuParent) > 4) {
        $last_item = array_pop($menuParent);
        $current_page = $menuParent['3']['link_title'];
        if ($current_page === 'Group Trips'){
          $vars['link_text'] = t('Get Your Group Trip Itinerary ');
          $last_item_link = explode('/', $last_item['href']);
          $vars['group'] = count($last_item_link) ? $last_item_link[1] : '';
          $group_name = !empty($last_item['link_title']) ? $last_item['link_title'] : '';
        }
      }
      array_pop($menuParent);
      $menuParent = end($menuParent);
      if (!empty($menuParent) && $menuParent['link_path'] !== '') {
        $node_path = explode('/', $menuParent['href']);
        $vars['country'] = count($node_path) ? $node_path[1] : '';
        $country_name =  !empty($menuParent['link_title']) ? $menuParent['link_title'] : '';
      }

      $attributes = array('class' => array( 'link', 'style-burgundy'));
      $attributes['data-gacategory'] = !empty($vars['group']) ? 'group planner': 'custom planner';
      $attributes['data-gaaction'] = 'click';
      $attributes['data-galabel'] =  !empty($vars['group']) ? $group_name : $country_name;

      $vars['planer_pdf_link'] = atj_filemaker_get_planner_link(
        $vars['link_text'],
        $vars['country'],
        !empty($vars['group']) ? $vars['group'] : NULL ,
        array('html' => TRUE, 'attributes' => $attributes,)
      );
      break;
    case 'field_country_content':
      $vars['theme_hook_suggestions'][] = 'field__no_wrappers';
      break;
    case 'field_country_content_desc':
      $vars['theme_hook_suggestions'][] = 'field__no_wrappers';
      break;
    case 'field_departure_land_cost':
    case 'field_group_trip_group_limit':
      $vars['classes_array'][] = 'item-desc';
      break;
    case 'body':
      $node = !empty($element['#object']) ? $element['#object'] : '';
      $nid = (!empty($node) && !empty($node->nid)) ? $node->nid : '';
      if (($nid == ATJ_NEW_DESTINATIONS_LANDING_NID) ||
        ($nid == ATJ_NEW_DOWNLOAD_CUSTOM_PLANNER_LANDING_NID)) {
        $vars['classes_array'][] = 'b-container container-style-f';
      }
      break;
    case 'field_popup_catalog_button':
      if (!empty($vars['items'])) {
        $title = $vars['items'][0]['#element']['title'];
        $vars['items'][0]['#element']['title'] = '<span>' . $title . '</span>';
      }
      break;
  }
}

/**
 * Implements hook_preprocess_views_view().
 * @param $vars
 */
function atj_new_preprocess_views_view(&$vars) {
  switch ($vars['name']) {
    case "featured_destination_disclaimer":
      $vars['rows'] = trim($vars['rows']);
      break;
  }
}

/**
 * Implements template_preprocess_block().
 */
function atj_new_preprocess_block(&$vars) {
  $delta = $vars['block']->delta;

  if (!empty($vars['elements']['bean'])) {
    $block_name = element_children($vars['elements']['bean']);
    $block_name = !empty($block_name[0]) ? $block_name[0] : $delta;
    $bean = !empty($vars['elements']['bean'][$block_name]) ? $vars['elements']['bean'][$block_name] : '';
    $bean_obj = !empty($bean['#entity']) ? $bean['#entity'] : '';
    $bean_type = !empty($bean_obj) ? $bean_obj->type : '';

    switch ($bean_type) {
      case 'two_ways_to_travel':
        $vars['theme_hook_suggestions'][] = 'block__bean__two_ways_to_travel';
        $vars['bg_image'] = !empty($bean['field_travel_ways_bg_image']) ?
          file_create_url($bean['field_travel_ways_bg_image']['#items'][0]['uri']) : '';

        $url_components = explode('/', request_uri());
        $arg_0 = !empty($url_components[1]) ? $url_components[1] : '';
        $arg_2 = !empty($url_components[3]) ? $url_components[3] : '';
        if (($arg_0 == 'destinations') && ($arg_2 == 'regions')) {
          $vars['classes_array'][] = 'style-a';
        }
        break;
    }
  }

  switch ($delta) {
    case 'form':
      if ($vars['block']->module == 'search') {
        $vars['classes_array'][] = 'form form-search';
      }
      break;
    case 'highlights-highlights':
    case '21a3eef6b277d9b2618ff8268cc157c3':
    case 'adventures-adventures':
    case 'contact-travel-expert-india':
      $url_components = explode('/', request_uri());
      $arg_0 = !empty($url_components[1]) ? $url_components[1] : '';
      $arg_2 = !empty($url_components[3]) ? $url_components[3] : '';
      if (($arg_0 == 'destinations') && ($arg_2 == 'regions')) {
        $vars['theme_hook_suggestions'][] = 'block__container';
      }
      break;
    case 'travel_experts-block':
      $vars['classes_array'][] = 'b-experts';
      break;
    case 'destination-generator-wanderlust':
      $content = !empty($vars['elements']['bean']['destination-generator-wanderlust']) ?
        $vars['elements']['bean']['destination-generator-wanderlust'] : '';
      $vars['default_background'] = !empty($content['field_region_background']) ?
        file_create_url($content['field_region_background']['#items'][0]['uri']) : '';
      $vars['default_desc'] = !empty($content['field_dest_gen_desc']) ?
        $content['field_dest_gen_desc']['#items'][0]['safe_value'] : '';
      $destination_generator_block = module_invoke('views', 'block_view', 'destination_generator-block');
      $vars['destinatinations_list'] = !empty($destination_generator_block['content']) ?
        $destination_generator_block['content'] : '';
      break;
  }
}

/**
 * Implements hook_form_alter().
 */
function atj_new_form_alter(&$form, &$form_state, $form_id) {

  switch ($form_id) {
    case 'search_block_form':
      $form['search_block_form']['#attributes']['placeholder'] = t('SEARCH');
      break;
    case 'search_form':
      $form['#attributes']['class'][] = 'form-search';
      $form['#attributes']['class'][] = 'form';
      $form['#prefix'] = '<div class="b-search">';
      $form['#suffix'] = '</div>';
      $form['basic']['submit']['#prefix'] = '<div class="form-actions">';
      $form['basic']['submit']['#suffix'] = '</div>';
      $form['basic']['keys']['#title'] = '';
      $form['advanced']['#access'] = FALSE;
      break;
  }

  //webforms
  if(strpos($form_id, 'webform_client_form_') !== FALSE) {
    $node = $form['#node'];
    switch($node->type) {
      case 'webform_trip_payment':
        $form['#attributes']['class'][] = 'form';
        $form['#attributes']['class'][] = 'form-type-a';
        if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
          $form['actions']['submit']['#prefix'] = '<div class="form-submit-wrapper">';
          $form['actions']['submit']['#suffix'] = '</div>';
        }
        break;
      case 'contact_us':
        $form['#attributes']['class'][] = 'form';
        $form['#attributes']['class'][] = 'form-contact';

        if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
          $form['actions']['submit']['#prefix'] = '<div class="form-submit-wrapper">';
          $form['actions']['submit']['#suffix'] = '</div>';
        }
        break;
      case 'webform_planner':
        if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
          $form['actions']['submit']['#prefix'] = '<div class="form-submit-wrapper">';
          $form['actions']['submit']['#suffix'] = '</div>';
        }
        break;
      case 'webform_donation_message':
        if (!empty($form['actions']['submit'])) {
          $form['actions']['submit']['#prefix'] = '<div class="form-submit-wrapper">';
          $form['actions']['submit']['#suffix'] = '</div>';
        }
        break;
      case 'webform_catalog':
        $form['#attributes']['class'][] = 'form-type-a';
        $form['#attributes']['class'][] = 'form';
        if ($node->nid == ATJ_WEBFORM_CATALOG_REQUEST2_NID) {
          $form['#attributes']['class'][] = 'style-a';
        }
        if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
          $form['actions']['submit']['#prefix'] = '<div class="form-submit-wrapper">';
          $form['actions']['submit']['#suffix'] = '</div>';
        }
        break;
    }
  }
}

function atj_new_get_planner_link() {
  // Malo vremeni
  //deystvitelno malo

  $menuParent = menu_get_active_trail();
  array_pop($menuParent);
  $menuParent = end($menuParent);
  if (!empty($menuParent) && $menuParent['link_path'] !== '') {
    $node_path = explode('/', $menuParent['href']);
    $country_nid = count($node_path) ? $node_path[1] : '';
  }
  $country_name = !empty($menuParent['link_title']) ? $menuParent['link_title'] : '';

  $options = array(
    'html' => TRUE,
    'attributes' => array(
      'class' => array(
        'link',
        'type-read-more',
        'style-red'
      )
    )
  );

  if(!empty($country_nid)) {
    $options['query']['country'] = $country_nid;
  }

  if(empty($_COOKIE['planner'])) {
    $options['query']['type'] = 'first';
  }

  $attributes = array('class' => array( 'link', 'style-burgundy'));
  $attributes['data-gacategory'] = 'custom planner';
  $attributes['data-gaaction'] = 'click';
  $attributes['data-galabel'] = $country_name;

  return atj_filemaker_get_planner_link(
    t('GET YOUR CUSTOM PLANNER'),
    $country_nid,
    NULL,
    array('html' => TRUE, 'attributes' => $attributes)
  );
}

/**
 * Implements hook_theme().
 */
function atj_new_theme($existing, $type, $theme, $path) {
  return array(
    'atj_new_region__section' => array(
      'template' => 'atj-new-region--section',
      'variables' => array(
        'title_prefix' => '',
        'title' => '',
        'title_suffix' => '',
        'text' => '',
        'background_img' => '',
        'show_form' => '',
      ),
      'path' => drupal_get_path('theme', 'atj_new') . '/templates/theme',
    ),
    'atj_new_lantern_submission' => array(
      'template' => 'atj-new-lantern-submission',
      'variables' => array(
        'content' => array(),
      ),
      'path' => drupal_get_path('theme', 'atj_new') . '/templates/theme',
    ),
  );
}

/* main ul */
function atj_new_menu_tree__main_menu($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

/* inner ul */
function atj_new_menu_tree__main_menu_inner($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

/* inner li */
function atj_new_menu_link__main_menu_inner($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/* main li */
function atj_new_menu_link__main_menu(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  $block_output = '';

  if (isset($element['#localized_options']['menu_attach_block']) &&
    !empty($element['#localized_options']['menu_attach_block']['name'])
    && module_exists('menu_attach_block')) {
    $block = menu_attach_block_load_from_key($element['#localized_options']['menu_attach_block']['name']);
    unset($element['#localized_options']['menu_attach_block']);

    if ($block) {
      $block_output = menu_attach_block_block_render($block['module'], $block['delta']);
    }
  }

  if ($element['#below']) {
    foreach ($element['#below'] as $key => $val) {
      if (is_numeric($key)) {
        $element['#below'][$key]['#theme'] = 'menu_link__main_menu_inner'; // 2 level
      }
    }
    $element['#below']['#theme_wrappers'][0] = 'menu_tree__main_menu_inner';  // 2 level
    $sub_menu = drupal_render($element['#below']);
    $sub_menu = '<div class="menu-inner"><div class="menu-wrapper">' . $sub_menu . '</div>' . $block_output . '</div>';
  }

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements hook_preprocess_entity().
 */
function atj_new_preprocess_entity(&$variables, $hook) {
  $function = 'atj_new_preprocess_' . $variables['entity_type'];
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}

/**
 * Implements hook_preprocess_paragraphs_item().
 */
function atj_new_preprocess_paragraphs_item(&$vars) {

  switch($vars['paragraphs_item']->bundle) {
    case 'f_dest_2_col':
      $vars['position'] = _atj_new_get_item_position($vars, 'field_f_dest_paragraphs');
      break;
  }
}

/**
 * Field Collection-specific implementation of template_preprocess_entity().
 */
function atj_new_preprocess_field_collection_item(&$vars) {
  $elements = $vars['elements'];
  $vars['wrapper_cl'] = '';
  switch ($elements['#bundle']) {
    case 'field_hn_top_dest_items':
    case 'field_news_td_items':
      $vars['position'] = _atj_new_get_item_position ($vars);
      break;
    case 'field_common_content':
    case 'field_country_content':
      $type = (!empty($vars['content']['field_country_content_type']) &&
        !empty($vars['content']['field_country_content_type']['#items'])) ?
        $vars['content']['field_country_content_type']['#items'][0]['value'] : '';
      $vars['columns_classes_array'] = array('b-cols b-container container-with-85');

      $width_53 = array(
        'title-highlights.png',
        'title-hotel-hotspots.png',
        'title-northisland.png',
        'title-adventures.png',
        'title-southIsland.png',
        'title-sample-itinerare.png',
        'title-custom-isnt-complicated.png',
        'title-explore-custom-travel.png',
        'grouptrips.png',
      );

      $width_65 = array(
        'title-closer-look.png',
        'title-activities.png',
        'title-festivals.png',
      );

      $width_62 = array(
        'title-better-together.png',
        'title-whats-included.png',
        'title-simplifying-solo-travel.png',
        'bookearly.png',
      );

      if (in_array($type, $width_53)) {
        $vars['classes_array'][] = 'b-container container-with-53 container-style-b';
      }
      elseif (in_array($type, $width_65)) {
        $vars['classes_array'][] = 'b-container container-with-65';
      }
      elseif ($type == 'title-forcast.png') {
        $vars['classes_array'][] = 'b-container container-with-56';
      }
      elseif (in_array($type, $width_62)) {
        $vars['classes_array'][] = 'b-container container-with-62 container-style-b';
      }
      break;
    case 'field_group_trip_content':
      $vars['classes_array'][] = 'item-desc';
      break;
  }
}

/**
 * Implements hook_preprocess_views_view_unformatted().
 */
function atj_new_preprocess_views_view_unformatted(&$vars) {
  if (in_array($vars['view']->name, array('resources', 'partners', 'map', 'featured_destinations_select'))) {
    $vars['theme_hook_suggestions'][] = 'views_view_unformatted__' . $vars['view']->name . '__' . $vars['view']->current_display;
    $result = $vars['view']->result;
    if (!empty($result)) {
      $resources = [];
      if ($vars['view']->current_display == 'page' || $vars['view']->current_display == 'list') {
        if($vars['view']->name !== 'featured_destinations_select') {
          $resources[''] = t('Select Resource:');
        }
        foreach ($vars['view']->result as $key => $value) {
          switch ($vars['view']->name) {
            case 'featured_destinations_select':
              $path = url('/node/' . $value->nid);
              $resources[$path] = !empty($value->field_field_f_dest_date_1[0]['rendered']['#markup']) ? strip_tags($value->field_field_f_dest_date_1[0]['rendered']['#markup']) : '';
              $default_value = base_path() . current_path();
              break;

            case 'map':
              $path = url('/node/' . $value->nid);
              $resources[$path] = str_replace('Overview ', '', $value->node_title);
              $default_value = request_uri();
              break;

            default:
              $path = url('/node/' . $value->nid);
              $resources[$path] = $value->node_title;
              $default_value = base_path() . current_path();
              break;
          }
        }
        $vars['select'] = theme('select', array('element' => array('#options' => $resources, '#value' => $default_value)));
      }
    }
  }
  else if (($vars['view']->name == 'destinations_landing') &&
    ($vars['view']->current_display == 'block_1')) {
    global $user;
    module_load_include('inc', 'webform', 'includes/webform.submissions');
    $submission_count = webform_get_submission_count(ATJ_WEBFORM_PLANNER_NID, $user->uid);

    $url = 'node/' . ATJ_WEBFORM_PLANNER_NID;
    $results = !empty($vars['view']->result) ? $vars['view']->result : array();
    $vars['items_url'] = array();
    if (empty($submission_count)) {
      foreach ($results as $key => $value) {
        $nid = !empty($value->nid) ? $value->nid : '';
        $options['query']['country'] = $nid;
        $vars['items_url'][$key] = url($url, $options);
      }
    }
    else {
      foreach ($results as $key => $value) {
        $file_url = !empty($value->field_field_common_itinerary_pdf) ?
          file_create_url($value->field_field_common_itinerary_pdf[0]['raw']['uri']) : '';
        $vars['items_url'][$key] = $file_url;
      }
    }
  }
}

/**
 * Creates a simple text rows array from a field collections, to be used in a
 * field_preprocess function.
 *
 * @param $vars
 * An array of variables to pass to the theme template.
 * @param $field_array
 * Array of fields to be turned into rows in the field collection.
 * @return array
 */
function _atj_new_rows_from_field_collection(&$vars, $field_array) {
  $rows = array();
  if (isset($vars['element']['#items'])) {
    $items = $vars['element']['#items'];
  }
  elseif (isset($vars['#items'])) {
    $items = $vars['#items'];
  }
  else {
    $items = array();
  }

  foreach ($items as $key => $item) {
    $entity_id = $item['value'];
    $entity = field_collection_item_load($entity_id);
    try {
      $wrapper = entity_metadata_wrapper('field_collection_item', $entity);
      $row = array();
      $properties = $wrapper->getPropertyInfo();

      foreach($field_array as $field) {
        if (array_key_exists($field, $properties)) {
          $row[$field] = $wrapper->$field->value();
        }
      }
      $rows[] = $row;
    }
    catch (EntityMetadataWrapperException $exc) {
      watchdog('atj_new', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
    }
  }

  return $rows;
}

/**
 * Theme helper function
 */
function _atj_new_disable_access(&$element) {
  if(!empty($element)) {
    $element['#access'] = FALSE;
  }
}

/**
 * Bean implementation of template_preprocess_entity().
 */
function atj_new_preprocess_bean(&$vars) {
  $bean = $vars['bean'];
  $type = !empty($bean->type) ? $bean->type : '';
  $delta = !empty($bean->delta) ? str_replace('-', '_', $bean->delta) : '';

  $vars['theme_hook_suggestions'][] = 'bean__' . $type . '__' . $delta;

  switch ($bean->type) {
    case 'menu_bottom':
      $view = views_get_view('main_menu_featured_destination');

      if (!empty($view) && !empty($view->display['block']->display_options['enabled'])) {
        $view->execute();
        $featured_destination = !empty($view->result) ? $view->result[0] : '';
        $featured_destination_nid = !empty($featured_destination->nid) ? $featured_destination->nid : '';
        $featured_destination_img = !empty($featured_destination->field_field_common_top_image) ?
          $featured_destination->field_field_common_top_image[0] : '';
        if ($featured_destination_nid && $featured_destination_img) {
          $img_style = !empty($featured_destination_img['rendered']['#image_style']) ?
            $featured_destination_img['rendered']['#image_style'] : '';
          $img_uri = !empty($featured_destination_img['rendered']['#item']['uri']) ?
            $featured_destination_img['rendered']['#item']['uri'] : '';

          $img_url = image_style_url($img_style, $img_uri);
          $vars['featured_destination'] = l('<span>' . t('Featured Destination') . '</span>',
            'node/' . $featured_destination_nid,
            array(
              'attributes' => array(
                'class' => array('btn-destination'),
                'style' => array('background: url(' . $img_url . ') no-repeat;')),
              'html' => TRUE
            ));
        }
      }
      break;
  }
}

/**
 * Add wrapper for Rander Array element in prefix and suffix.
 **/
function atj_new_wrap_item(&$element, $classes, $tag = 'div') {
  if (!empty($element)) {
    $element['#prefix'] = '<' . $tag . (!empty($classes) ? ' class="' . $classes . '">' : '>') . (array_key_exists('#prefix', $element) ? $element['#prefix'] : '');
    $element['#suffix'] = (array_key_exists('#suffix', $element) ? $element['#suffix'] : '') . '</'. $tag . '>';
  }
}

/**
 * Add classes to render arrays.
 *
 * @param $element
 * @param array $classes
 */
function atj_new_add_classes(&$element, $classes) {
  if (!empty($element)) {
    $element['#attributes']['class'] = empty($element['#attributes']['class']) ? $classes : array_unique(array_merge($element['#attributes']['class'], $classes));
  }
}

/**
 * Get items for Custom planer select.
 * From 'catalog_button' paragraph.
 *
 * @param $paragraphs_items
 * @return array
 */
function _atj_new_get_custom_planer_source_from_paragraphs($paragraphs_items){
  $source = array();
  $last = 0;

  foreach ($paragraphs_items as $key => $item) {
    $parg_item = !empty($item['entity']['paragraphs_item']) ? $item['entity']['paragraphs_item'] : array();
    $parg_item = current($parg_item);
    $bundle = !empty($parg_item['#bundle']) ? $parg_item['#bundle'] : '';

    if ($bundle == 'catalog_button') {
      $title = (!empty($parg_item['field_par_catalog_btn_title']) && !empty($parg_item['field_par_catalog_btn_title']['#items'])) ?
        $parg_item['field_par_catalog_btn_title']['#items'][0]['safe_value'] : '';
      $nid = (!empty($parg_item['field_par_catalog_country']) && !empty($parg_item['field_par_catalog_country']['#items'])) ?
        $parg_item['field_par_catalog_country']['#items'][0]['target_id'] : '';

      if (empty($source[$last])) {
        $last = $key;
        $source[$last] = array();
      }

      if (!empty($title) && !empty($nid)) {
        $source[$last][$key] = array(
          'title' => $title,
          'nid' => $nid,
        );
      }
    }
    else {
      $last = $key;
    }
  }

  foreach ($source as $source_key => $source_value) {
    if (count($source_value) < 2) {
      unset($source[$source_key]);
    }
  }

  return $source;
}

/**
 * Get donation lantern submissions. Ad put to js settings.
 *
 * @param $nid
 *  Webform node nid with submissions.
 */
function atj_new_preprocess_page_add_lantern_values_settings($nid) {

  module_load_include('inc', 'atj_custom', 'includes/atj_custom.helpers');
  $res = atj_custom_webform_views_retrieve('donations_results_source', 'default', array(), array($nid));
  $values = array();

  foreach ($res as $item) {

    $name = !empty($item->{'well wisher’s name'}) ? $item->{'well wisher’s name'} : '';
    $address = !empty($item->city) ? $item->city : '';
    $address .= !empty($item->city) && !empty($item->state) ? ', ' . $item->state : '';

    $values[] = array(
      'name' => $name,
      'address' => $address,
      'text' => $item->message,
    );
  }

  drupal_add_js(array('atj_new_lanterns' => $values), 'setting');
}

/**
 * Get position of Field collection element.
 */
function _atj_new_get_item_position ($vars, $field_name = '') {
  $elements = !empty($vars['elements']) ? $vars['elements'] : '';
  $position = '';

  if (empty($field_name)) {
    $field_name = !empty($elements['#bundle']) ? $elements['#bundle'] : '';
  }

  $node = !empty($elements['#entity']) ? $elements['#entity']->hostEntity() : '';
  $item_id = !empty($elements['#entity']) ? $elements['#entity']->item_id : '';
  if (!empty($node->$field_name)) {
    $field = $node->$field_name;
    $items = !empty($field[LANGUAGE_NONE]) ? $field[LANGUAGE_NONE] : array();
    foreach ($items as $key => $item) {
      if (!empty($item['value']) && ($item['value'] == $item_id)) {
        $position = $key + 1;
      }
    }
  }

  return $position;
}