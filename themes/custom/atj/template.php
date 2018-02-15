<?php

/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */

define('ATJ_DONATION_MESSEGE_NID', 411);
define('__THEME_PATH', drupal_get_path('theme', 'atj'));
define('ATJ_NEWS_LANDING_NID', 9);
define('ATJ_PRESS_LANDING_NID', 271);
define('ATJ_PRESS_LIST_NID', 272);
define('ATJ_RESOURCES_LIST_NID', 199);
define('SIGNUP_URL', 'email-updates');
define('ATJ_CATALOG_ULR', 'onlinecatalog');
define('ATJ_MY_JOURNEY_URL', 'https://myjourney.asiatranspacific.com/public/log-in');
define('ATJ_PARTNERS_LOGOS_NID', 242);
define('ATJ_TRAVEL_RESOURCES_NID', 199);
define('ATJ_PARTNERS_PARENT_NID', 236);
define('ATJ_CATALOG_NID', 22);
define('ATJ_CONTACT_NID', 233);
define('ATJ_RESOURCES_SUBNAVIGATION_BID', 4);
define('ATJ_DONATIONS_WEBFORM_NAME_CID', 1);
define('ATJ_DONATIONS_WEBFORM_CITY_CID', 2);
define('ATJ_DONATIONS_WEBFORM_STATE_CID', 3);
define('ATJ_DONATIONS_WEBFORM_MESSAGE_CID', 4);

/**
 * Implements template_preprocess_html().
 */
function atj_preprocess_html(&$vars) {

  $HandheldFriendly = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'HandheldFriendly',
      'content' => 'false',
    ),
    '#weight' => -900,
  );

  drupal_add_html_head($HandheldFriendly, 'HandheldFriendly');

  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1',
    ),
    '#weight' => -899,
  );

  drupal_add_html_head($viewport, 'viewport');

  if ($node = menu_get_object()) {

//    $vars['classes_array'][] = 'page';
//    $vars['classes_array'][] = 'page-' . $node->type;

    switch ($node->type) {
      case 'webform_donation':
      case 'webform_donation_message':
      case 'donation_success':
      case 'donation_share':
      case 'donation':
        $vars['classes_array'][] = 'page-foundation';
        break;
      case 'wanderlust':
      case 'map':
        $vars['classes_array'][] = 'page-' . $node->type;
        break;
      case 'travel_experts':
        $vars['classes_array'][] = 'page-tour-guides';
        break;
      case 'home':
//        $vars['classes_array'][] = 'page-30years';
        break;
      case 'news':
      case 'news_top_destinations':
      case 'news_gallery_bottom':
        $vars['classes_array'][] = 'page-news';
        break;
      case '30_years':
        $vars['classes_array'][] = 'page-30years-slider';
        break;
      case 'resources':
      case 'collection':
        $vars['classes_array'][] = 'page-resources';
        break;
    }

    if(!empty($node->field_common_hide_top_section[LANGUAGE_NONE][0]['value'])) {
      $vars['classes_array'][] = 'page-type-a';
    }

    if ($node->nid == ATJ_NEWS_LANDING_NID) {
      $vars['classes_array'][] = 'page-news';
    }
  }

  $vars['telephone'] = variable_get('telephone', '');

  if(in_array('html__itinerary', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-online-itinerary';
  }

  if (!empty($vars['page']['sticky']) && !empty($vars['page']['sticky']['bean_start-your-adventure'])) {
    $vars['classes_array'][] = 'with-form-start-adventure';
  }
}

/**
 * Implements template_preprocess_page().
 */
function atj_preprocess_page(&$vars) {
  $vars['content_wrapper_class'] = array();
  $vars['content_inner_class'] = array();
  if(isset($vars['node'])) {
    $node = $vars['node'];
  } else {
    //try load webform node
    $node = menu_get_object('webform_menu');
  }
  $vars['content_wrapper_class'][] = 'container';
  $vars['content_wrapper_class'][] = 'content-wrapper';
  $vars['before_titles'] = array();
  $vars['after_titles'] = array();

  if (!empty($node)) {
    if(!empty($node->field_common_hide_top_section[LANGUAGE_NONE][0]['value'])) {
      $vars['logo'] = url(path_to_theme('atj') . '/images/logo-a.png');
      $vars['hide_top_section'] = TRUE;
    }

    $top_fields_value_override = array();

    $top_fields = array(
      'field_common_top_image',
      'field_common_title_image',
      'field_common_subtitle',
      'field_common_video_mp4',
      'field_common_video_webm',
    );

    $region_section_title_prefix = '<h4>';
    $region_section_title_suffix = '</h4>';
    $region_section_show_form = TRUE;

    switch ($node->type) {
      case 'webform_donation_message':
      case 'donation_success':
      case 'donation_share':
        $vars['theme_hook_suggestions'][] = 'page__without_top_section';
        atj_preprocess_page_add_lantern_values_settings(
          ATJ_DONATION_MESSEGE_NID
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
        atj_preprocess_page_add_lantern_values_settings(
          ATJ_DONATION_MESSEGE_NID
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
      case 'featured_destination':

        if(!empty($node->field_f_dest_date[LANGUAGE_NONE][0]['value'])) {
          $date = new DateTime($node->field_f_dest_date[LANGUAGE_NONE][0]['value']);
          $vars['before_titles'][] = array(
            '#markup' => '<div class="subtitle style-a">' . $date->format('F Y') . '</div>',
          );
        }
        if(!empty($node->field_f_dest_top_subtitle[LANGUAGE_NONE][0]['value'])) {
          $vars['before_titles'][] = array(
            '#markup' => '<div class="subtitle style-b">' . check_plain($node->field_f_dest_top_subtitle[LANGUAGE_NONE][0]['value']) . '</div>',
          );
        }
        break;
      case 'page':
      case 'accommodations':
      case 'regions':
      case 'group_trip_detail':
      case 'tailored_trips':
      case 'team':
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
          $parent_node = count($node_path) ? node_load($node_path[1]) : '';
          $top_fields_value_override = _atj_get_rows_from_node($node, $top_fields);
        }
        if ($node->nid == ATJ_PRESS_LIST_NID) {
          $parent_node = node_load(ATJ_PRESS_LANDING_NID);
        }
        if ($node->nid == ATJ_RESOURCES_LIST_NID) {
          $vars['min_style_top'] = TRUE;
        }
        if ($node->nid == ATJ_NEWS_LANDING_NID) {
          $top_fields[] = 'body';
        }
        break;
      case 'news':
      case 'news_top_destinations':
      case 'news_gallery_bottom':
        $parent_node = node_load(ATJ_NEWS_LANDING_NID);
        $vars['parent_node'] = $parent_node;
        $vars['theme_hook_suggestions'][] = 'page__news__inner';
        $vars['content_inner_class'][] = 'clearfix';
        break;
      case 'press':
        $parent_node = node_load(ATJ_PRESS_LANDING_NID);
        break;
      case 'travel_asia':
        $top_fields[] = 'body';
        break;
      case 'wanderlust':
        $top_fields[] = 'body';

        $region_section_title_prefix = '<h3>';
        $region_section_title_suffix = '</h3>';
        $region_section_show_form = FALSE;

        $destination_generator_block = block_load('bean', 'destination-generator-wanderlust');
        $destination_generator_render_array = _block_get_renderable_array(_block_render_blocks(array($destination_generator_block)));
        if (isset($destination_generator_render_array) && !empty($destination_generator_render_array)) {
          $vars['destination_generator'] = drupal_render($destination_generator_render_array);
        }
        break;
      case 'travel_experts':
        $vars['content_wrapper_class'] = array();
        break;
      case '30_years':
        $vars['theme_hook_suggestions'][] = 'page__30_years';
        $vars['content_inner_class'][] = 'b-slider';
        break;
      case 'resources':
      case 'collection':
        $parent_node = node_load(ATJ_TRAVEL_RESOURCES_NID);
        break;
      case 'partners':
        $parent_node = node_load(ATJ_PARTNERS_PARENT_NID);
        $vars['min_style_top'] = TRUE;
        break;
      case 'webform_love_language':
        if (empty($vars['page']['subnavigation'])) {
          $vars['page']['subnavigation'] = array(
            '#markup' => '',
          );
        }
        break;
    }

    if (isset($parent_node) && !empty($parent_node)) {
      $top_fields_value = _atj_get_rows_from_node($parent_node, $top_fields);
    }
    else {
      $top_fields_value = _atj_get_rows_from_node($node, $top_fields);
    }

    if (isset($top_fields_value) && !empty($top_fields_value)) {
      $vars['top_image'] = '';
      if (isset($top_fields_value_override['field_common_top_image'])) {
        $vars['top_image'] = file_create_url($top_fields_value_override['field_common_top_image']['uri']);
      }
      else if (isset($top_fields_value['field_common_top_image'])) {
        $vars['top_image'] = file_create_url($top_fields_value['field_common_top_image']['uri']);
        $vars['top_img_alt'] = !empty($top_fields_value['field_common_top_image']['alt']) ?
          $top_fields_value['field_common_top_image']['alt'] : t('guided tours');
      }
      $vars['subtitle'] = '';
      if (isset($top_fields_value_override['field_common_subtitle'])) {
        $vars['subtitle'] = $top_fields_value_override['field_common_subtitle'];
      }
      else if (isset($top_fields_value['field_common_subtitle'])) {
        $vars['subtitle'] = $top_fields_value['field_common_subtitle'];
      }
      if (isset($top_fields_value_override['field_common_title_image'])) {
        $title_image = $top_fields_value_override['field_common_title_image'];
      }
      else if (isset($top_fields_value['field_common_title_image'])) {
        $title_image = $top_fields_value['field_common_title_image'];
      }
      if (isset($title_image) && $title_image) {
        $image = array(
          'path' => $title_image['uri'],
          'alt' => $title_image['alt'],
          'title' => $title_image['title'],
          'attributes' => array('class' => array()),
        );
        $vars['title_image'] = theme('image', $image);
      }
      if (isset($top_fields_value['body'])) {
        $vars['body'] = $top_fields_value['body']['safe_value'];
      }

      //Video
      if (isset($top_fields_value_override['field_common_video_mp4'])) {
        $vars['video_mp4'] = file_create_url($top_fields_value_override['field_common_video_mp4']['uri']);
      }
      else if (isset($top_fields_value['field_common_video_mp4'])) {
        $vars['video_mp4'] = file_create_url($top_fields_value['field_common_video_mp4']['uri']);
      }

      if (isset($top_fields_value_override['field_common_video_webm'])) {
        $vars['video_webm'] = file_create_url($top_fields_value_override['field_common_video_webm']['uri']);
      }
      else if (isset($top_fields_value['field_common_video_webm'])) {
        $vars['video_webm'] = file_create_url($top_fields_value['field_common_video_webm']['uri']);
      }

    }

    $top_fields = array(
      'field_country_map',
      'field_region_title',
      'field_region_text',
      'field_region_background',
    );
    $top_fields_value = _atj_get_rows_from_node($node, $top_fields);

    if (isset($top_fields_value) && !empty($top_fields_value)) {
      $map = isset($top_fields_value['field_country_map']) ?
        theme('image', array('path' => file_create_url($top_fields_value['field_country_map']['uri']))) : '';
      $background_img = isset($top_fields_value['field_region_background']) ?
        file_create_url($top_fields_value['field_region_background']['uri']) : '';
      $title = isset($top_fields_value['field_region_title']) ?
        $top_fields_value['field_region_title'] : '';
      $text = isset($top_fields_value['field_region_text']) ?
        $top_fields_value['field_region_text']['value'] : '';
      $vars['region_section'] = theme('atj_region__section', array(
        'map' => $map,
        'background_img' => $background_img,
        'title_prefix' => $region_section_title_prefix,
        'title' => $title,
        'title_suffix' => $region_section_title_suffix,
        'text' => $text,
        'show_form' => !empty($region_section_show_form) ? atj_get_planner_link() : '',
      ));
    }

    $vars['seo_elements'] = _atj_get_seo_elements($node->nid);
  }

  if (isset($vars['page']['subnavigation']['atj_custom_atj_custom_social_share_block'])) {
    $vars['share_block'] = drupal_render($vars['page']['subnavigation']['atj_custom_atj_custom_social_share_block']);
    $vars['page']['subnavigation']['atj_custom_atj_custom_social_share_block']['#access'] = FALSE;
  }
  if (in_array('page__search', $vars['theme_hook_suggestions'])) {
    $vars['top_image'] = file_create_url(path_to_theme() . '/images/tmp/section-img-25.jpg');
    $vars['title_image'] = theme('image', array('path' => path_to_theme() . '/images/titles/title-results.png'));
    $vars['subtitle'] = t('Search');
  }
  if (in_array('page__itinerary', $vars['theme_hook_suggestions'])) {
    $vars['top_image'] = file_create_url(path_to_theme() . '/images/tmp/section-top-img-21.jpg');
    $vars['page_info'] = 'page-itinerary';
  }
  $telephone = variable_get('telephone', '');
  $vars['telephone'] = '';
  if (!empty($telephone)) {
    $vars['telephone'] = l('', 'tel:' . $telephone, array('html' => TRUE, 'attributes' => array('class' => array('ico', 'ss-icon', 'ss-glyphish-outlined', 'ss-phone', 'phone-track', 'phone-track-link-only'))));
    $vars['telephone_tablet'] = l($telephone, 'tel:' . $telephone, array('html' => TRUE, 'attributes' => array('class' => array('tel-link', 'phone-track'))));

    $mobile_menu_telephone_title = $telephone . '<span class="ico ss-icon ss-glyphish-outlined ss-phone"></span>';
    $vars['mobile_menu_telephone'] = l($mobile_menu_telephone_title, 'tel:' . $telephone, array('html' => TRUE, 'attributes' => array('class' => array('phone-track'))));
  }
  $vars['main_email'] = variable_get('main_email', '');
  if (!empty($vars['main_email'])) {
    $vars['main_email'] = l('', 'mailto:' . $vars['main_email'], array('html' => TRUE, 'attributes' => array('class' => array('ico', 'ss-icon', 'ss-glyphish-outlined', 'ss-mail'))));
  }

  $social_block = module_invoke('atj_custom', 'block_view', 'atj_custom_social_block');
  $vars['social_block'] = render($social_block['content']);

  $mobile_menu_logo = array(
    'path' => __THEME_PATH . '/images/logo-mobile.png',
    'alt' => t('Asia Transpacific Journeys'),
  );
  $vars['mobile_menu_logo'] = theme('image', $mobile_menu_logo);


  $vars['page_top_section'] = theme('page_top_section', $vars);

  $obapi_js = array(
    '#type' => 'markup',
    '#weight' => '-99',
    '#markup' => <<<'CODE'
<script data-obct type="text/javascript">
/** DO NOT MODIFY THIS CODE**/
!function(_window, _document) {
var OB_ADV_ID='0001b078d11d5a0fbc94ef8e62eeb5db95';
if (_window.obApi) { return; }
var api = _window.obApi = function() {api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);};api.version = '1.0';api.loaded = true;api.marketerId = OB_ADV_ID;api.queue = [];var tag = _document.createElement('script');tag.async = true;tag.src = '//amplify.outbrain.com/cp/obtp.js';tag.type = 'text/javascript';var script = _document.getElementsByTagName('script')[0];script.parentNode.insertBefore(tag, script);}(window, document);
obApi('track', 'PAGE_VIEW');
</script>
CODE
,
  );

  drupal_add_html_head($obapi_js, 'atj_obapi');
}

/**
 * Preprocess function for header top section.
 *
 * @param array $vars
 *   copy of preprocess_pages $vars
 */
function atj_preprocess_page_top_section(&$vars) {
  $vars['title'] = drupal_get_title();
  $section_additional_classes = array();
  $title_wrap_classes = array();
  if(!empty($vars['node'])) {
    $node = $vars['node'];
    $vars['theme_hook_suggestions'][] = 'page_top_section__node__' . $node->type;

    switch($node->type) {
      case 'donation':
        $section_additional_classes[] = 'style-f';
        $vars['theme_hook_suggestions'][] = 'page_top_section__style_f';
        $vars['body'][] = field_view_field('node', $node, 'field_donation_link',array('label'=>'hidden'));
        $vars['body'][] = field_view_field('node', $node, 'field_donation_top_text',array('label'=>'hidden'));
        break;
      case 'webform_donation':
        $section_additional_classes[] = 'style-f';
        $vars['theme_hook_suggestions'][] = 'page_top_section__style_f';
        $vars['body'] = field_view_field('node', $node, 'field_w_donation_top_text',array('label'=>'hidden'));
        atj_preprocess_page_add_lantern_values_settings(
          ATJ_DONATION_MESSEGE_NID
        );
        break;
      case 'travel_asia':
        $vars['theme_hook_suggestions'][] = 'page_top_section__style_a';

        $vars['subnavigation_not_supported'] = field_view_field('node', $node, 'field_home_top_items',
          array(
            'label'=>'hidden',
            'type' => 'field_collection_fields',
            'settings' => array('view_mode' => 'for_not_supported'))
        );
        $vars['subnavigation'] = field_view_field('node', $node, 'field_home_top_items',
          array(
            'label'=>'hidden',
            'type' => 'field_collection_fields',)
        );
        break;
      case 'news':
      case 'news_top_destinations':
      case 'news_gallery_bottom':
        $parent_node = !empty($vars['parent_node']) ? $vars['parent_node'] : $node;
        $vars['title'] = $parent_node->title;
        $seo_title = _atj_get_seo_title($node->nid);
        if (!empty($seo_title)) {
          $vars['title'] = $seo_title;
        }
        if (!empty($parent_node->body)) {
          $vars['body'] = $parent_node->body['und'][0]['safe_value'];
        }

        $vars['theme_hook_suggestions'][] = 'page_top_section__style_d';

        $vars['subnavigation_not_supported'] = field_view_field('node', $parent_node, 'field_home_top_items',
          array(
            'label'=>'hidden',
            'type' => 'field_collection_fields',
            'settings' => array('view_mode' => 'for_not_supported'))
        );
        $vars['subnavigation'] = field_view_field('node', $parent_node, 'field_home_top_items',
          array(
            'label'=>'hidden',
            'type' => 'field_collection_fields',)
        );
        break;
    }

    if ($node->nid == ATJ_NEWS_LANDING_NID) {
      $vars['theme_hook_suggestions'][] = 'page_top_section__style_d';

      $vars['subnavigation_not_supported'] = field_view_field('node', $node, 'field_home_top_items',
        array(
          'label'=>'hidden',
          'type' => 'field_collection_fields',
          'settings' => array('view_mode' => 'for_not_supported'))
      );
      $vars['subnavigation'] = field_view_field('node', $node, 'field_home_top_items',
        array(
          'label'=>'hidden',
          'type' => 'field_collection_fields',)
      );
    }
  }
  if (!empty($vars['page_info'])) {
    if($vars['page_info'] = 'page-itinerary') {
      $section_additional_classes[] = 'style-min';
      $title_wrap_classes[] = 'style-a';
    }
  }

  $vars['section_additional_classes'] = !empty($section_additional_classes) ? ' ' . implode(' ', $section_additional_classes) : '';
  $vars['title_wrap_classes'] = !empty($title_wrap_classes) ? ' ' . implode(' ', $title_wrap_classes) : '';

}


/**
 * Implements template_preprocess_node().
 */
function atj_preprocess_node(&$vars) {
  $node = $vars['node'];
  if (!$vars['page']) {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
  }

  if (isset($vars['content']['field_common_top_image'])) {
    $vars['content']['field_common_top_image']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_common_title_image'])) {
    $vars['content']['field_common_title_image']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_common_subtitle'])) {
    $vars['content']['field_common_subtitle']['#access'] = FALSE;
  }

  if (isset($vars['content']['field_common_video_mp4'])) {
    $vars['content']['field_common_video_mp4']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_common_video_webm'])) {
    $vars['content']['field_common_video_webm']['#access'] = FALSE;
  }

  switch ($node->type) {
    case 'donation_success':
      if(!empty($node->field_common_top_image[LANGUAGE_NONE][0]['uri'])) {
        $vars['top_image'] = file_create_url($node->field_common_top_image[LANGUAGE_NONE][0]['uri']);
      }
      if(!empty($_GET['n']) && !empty($_GET['s'])) {
        $webform_node = node_load($_GET['n']);
        if($webform_node->type =='webform_donation_message') {
          $submission = webform_menu_submission_load($_GET['s'], $_GET['n']);
          $vars['donation'] = theme(
            'atj_lantern_submission',
            array('content' =>
              array(
                'name' => !empty($submission->data[ATJ_DONATIONS_WEBFORM_NAME_CID][0]) ? check_plain($submission->data[ATJ_DONATIONS_WEBFORM_NAME_CID][0]) : '',
                'city' => !empty($submission->data[ATJ_DONATIONS_WEBFORM_CITY_CID][0]) ? check_plain($submission->data[ATJ_DONATIONS_WEBFORM_CITY_CID][0]) : '',
                'state' => !empty($submission->data[ATJ_DONATIONS_WEBFORM_STATE_CID][0]) ? check_plain($submission->data[ATJ_DONATIONS_WEBFORM_STATE_CID][0]) : '',
                'message' => !empty($submission->data[ATJ_DONATIONS_WEBFORM_MESSAGE_CID][0]) ? check_plain($submission->data[ATJ_DONATIONS_WEBFORM_MESSAGE_CID][0]) : '',
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
    case 'group_trip_detail':
      if($vars['view_mode'] == 'second_teaser') {
        if(!empty($node->field_country[LANGUAGE_NONE][0]['target_id'])) {
          $vars['planner_link'] = atj_filemaker_get_planner_link('Download planner', $node->field_country[LANGUAGE_NONE][0]['target_id'], $node->nid, array('attributes' => array('class' => array('link', 'style-purple', 'type-read-more-a'))));
        }
      }

      break;
    case 'webform_catalog':
      $vars['top_figure_classes'] = 'b-figcaption';
      if($node->nid == ATJ_WEBFORM_CATALOG_REQUEST2_NID) {
        $vars['top_figure_classes'] .= ' style-b';
        _atj_disable_access($vars['content']['field_catalog_preview_image']);
      }
      break;
    case 'travel_asia':
      _atj_disable_access($vars['content']['body']);
      _atj_disable_access($vars['content']['field_home_top_items']);
      break;
    case 'featured_destination':
      if (isset($vars['content']['field_f_dest_date'])) {
        $vars['content']['field_f_dest_date']['#access'] = FALSE;
      }
      if (isset($vars['content']['field_f_dest_top_subtitle'])) {
        $vars['content']['field_f_dest_top_subtitle']['#access'] = FALSE;
      }
      break;
    case 'trip_landing':
      if(!empty($node->field_trip_land_planner_selector[LANGUAGE_NONE][0]['value'])) {
        module_load_include('inc','atj_custom', '/includes/atj_custom.helpers');
        $custom_planers_source = atj_custom_views_retrieve('custom_trip_planner_select_source');

        $options = array(
          'none' => t('GET YOUR CUSTOM TRIP PLANNER'),
        );
        $base_path = base_path();
        foreach ($custom_planers_source as $item) {
          if(!empty($_COOKIE['planner'])) {
            if(!empty($item->fid)) {
              $options[$base_path . 'get-planner-file/' . $item->fid] = $item->country;
            }
          } else {
            if(!empty($item->nid)) {
              $options[url('node/' . ATJ_WEBFORM_PLANNER_NID, array('query'=> array('country' => $item->nid)))] = $item->country;
            }
          }
        }

        $planners_select = array(
          '#prefix' => '<div class="form-item form-type-select">',
          '#suffix' => '</div>',
          '#type' => 'select',
          '#required' => FALSE,
          '#title' => t(''),
          '#empty_value' => 'none',
          '#options' => $options,
          '#attributes' => array('class' => array('form-select', 'redirect-select')),
        );
        $planners_select['#attributes']['data-gacategory'] = 'travel-asia';
        $planners_select['#attributes']['data-gaaction'] = 'get custom trip planner';

        $planners_select['#weight'] = $vars['content']['field_trip_land_planner_selector']['#weight'];
        //replace field checkbox with select
        $vars['content']['field_trip_land_planner_selector'] = $planners_select;
      }
      break;
    case 'map':
      $vars['mobile'] = views_embed_view('map', 'list');
      break;
    case 'home':
      if (isset($vars['content']['field_flipbook'])) {
        drupal_add_js(__THEME_PATH . '/js/lib/bookblock/modernizr.custom.js');
        drupal_add_js(__THEME_PATH . '/js/lib/bookblock/jquerypp.custom.js');
        drupal_add_js(__THEME_PATH . '/js/lib/bookblock/jquery.bookblock.js');
      }
      if (isset($vars['content']['field_group_trips_item'])) {
        drupal_add_js(__THEME_PATH . '/js/lib/jquery.flexslider-min.js');
      }

      if (isset($vars['content']['field_home_top_bl_link'])) {
        $icon_class = array();
        $link_field = $vars['content']['field_home_top_bl_link']['#items'][0];
        $section_top_type = (isset($vars['content']['field_home_top_bl_type']) && !empty($vars['content']['field_home_top_bl_type']['#items'])) ?
          $vars['content']['field_home_top_bl_type']['#items'][0]['value'] : 'defaultstyle';
        if ($section_top_type == 'style-c') {
          $link_class = array('link style-purple type-read-more-a');
        } else {
          $link_class = array('link type-read-more style-white');
          $icon_class = array('ico ss-icon ss-stand);ard ss-navigateright');
        }
        $vars['top_bl_link'] = _atj_get_link_with_icon($link_field, $link_class, $icon_class);
      }
      if (isset($vars['content']['field_content_sec_link'])) {
        $link_field = $vars['content']['field_content_sec_link']['#items'][0];
        $link_class = array('link type-read-more style-white');
        $icon_class = array('ico ss-icon ss-standard ss-navigateright');
        $vars['content_sec_link'] = _atj_get_link_with_icon($link_field, $link_class, $icon_class);
      }
      if (isset($vars['content']['field_con_tour_sec_link'])) {
        $link_field = $vars['content']['field_con_tour_sec_link']['#items'][0];
        $link_class = array('link type-read-more style-white');
        $icon_class = array('ico ss-icon ss-standard ss-navigateright');
        $vars['tour_sec_link'] = _atj_get_link_with_icon($link_field, $link_class, $icon_class);
      }
      if (isset($vars['content']['field_home_dest_link'])) {
        $link_field = $vars['content']['field_home_dest_link']['#items'][0];
        $link_class = array('link type-read-more style-white');
        $icon_class = array('ico ss-icon ss-standard ss-navigateright');
        $vars['featured_dest_link'] = _atj_get_link_with_icon($link_field, $link_class, $icon_class);
      }
      $vars['news_block'] = views_embed_view('news_homepage', 'block');
      $link_title = t('SEE ALL');
      $vars['news_block_link'] = l($link_title, 'node/' . ATJ_NEWS_LANDING_NID, array(
        'attributes' => array('class' => array('link type-read-more-a style-orange')),
        'html' => TRUE
      ));
      $block = block_load('webform', 'client-block-8');
      $block = _block_render_blocks(array($block));
      if ($block) {
        $block_build = _block_get_renderable_array($block);
        $vars['newsletter_block'] = drupal_render($block_build);
      }

      if (!empty($vars['content']['field_home_top_items'])) {
        $vars['top_items_for_not_supported'] = field_view_field('node', $node, 'field_home_top_items',
          array(
            'label'=>'hidden',
            'type' => 'field_collection_fields',
            'settings' => array('view_mode' => 'for_not_supported'))
        );
      }

      $fc_slider_items = field_get_items('node', $node, 'field_home_top_slider');
      $fc_slider_items = !empty($fc_slider_items) ? $fc_slider_items : array();

      $bg_img_list = array();
      $bg_img_svg_list = array();
      foreach ($fc_slider_items as $fc_slider_item) {
        $fc_item = field_collection_item_load($fc_slider_item['value']);
        $bg_img_item = field_view_field('field_collection_item', $fc_item, 'field_home_top_image', 'teaser');
        $bg_img_svg_item = field_view_field('field_collection_item', $fc_item, 'field_home_top_image', 'full');

        $bg_mob_img_item = field_view_field('field_collection_item', $fc_item, 'field_home_top_mob_image', 'teaser');
        $bg_mob_img_svg_item = field_view_field('field_collection_item', $fc_item, 'field_home_top_mob_image', 'full');

        $block_type = (!empty($fc_item->field_home_top_bl_type) && !empty($fc_item->field_home_top_bl_type[LANGUAGE_NONE])) ?
          $fc_item->field_home_top_bl_type[LANGUAGE_NONE][0]['value'] : '';
        $special_items = array('style-season-giving',);
        $special_content = '';

        if (in_array($block_type, $special_items)) {
          $special_content = theme('atj_background__special', array('type' => $block_type));
        }

        if (!empty($bg_img_item)) {
          $bg_img_list[] = '<li>' . drupal_render($bg_mob_img_item) . drupal_render($bg_img_item) . $special_content . '</li>';
        }
        if (!empty($bg_img_svg_item)) {
          $bg_img_svg_list[] = '<li>' . drupal_render($bg_mob_img_svg_item) . drupal_render($bg_img_svg_item) . $special_content . '</li>';
        }
      }
      if (!empty($bg_img_list)) {
        $vars['bg_img_list'] = '<ul class="bgs">' . implode($bg_img_list) .  '</ul>';
      }
      if (!empty($bg_img_svg_list)) {
        $vars['bg_img_svg_list'] = '<ul class="bgs">' . implode($bg_img_svg_list) .  '</ul>';
      }

      $featured_type = !empty($vars['content']['field_home_dest_type']) ?
        $vars['content']['field_home_dest_type']['#items'][0]['value'] : '';
      $featured_special_items = array('season_giving',);

      if (in_array($featured_type, $featured_special_items)) {
        $vars['featured_special_content'] = theme('atj_background__special', array(
          'type' => $featured_type,
          'content' => $vars['content'],
        ));

        hide($vars['content']['field_home_dest_title_image']);
        hide($vars['content']['field_home_dest_title']);
        hide($vars['content']['field_home_dest_description']);
        hide($vars['content']['field_home_dest_link']);
        hide($vars['content']['field_home_dest_bg_image']);
        hide($vars['content']['field_home_dest_type']);
        hide($vars['content']['field_home_dest_top_text']);
        hide($vars['content']['field_home_dest_top2_text']);
        hide($vars['content']['field_home_dest_subtitle']);
      }
      break;
    case 'news':
    case 'news_gallery_bottom':
    $vars['title'] = html_entity_decode($vars['title']);
    $back_link_title = t('LATEST NEWS') . ' <span class="ico ss-icon ss-standard ss-navigateleft"></span>';
      $vars['back_link'] = l($back_link_title, 'node/' . ATJ_NEWS_LANDING_NID, array(
        'attributes' => array('class' => array('link type-back')),
        'html' => TRUE
      ));

      if (($node->type == 'news_gallery_bottom') && ($vars['view_mode'] == 'teaser')) {
        $vars['theme_hook_suggestions'][] = 'node__news__teaser';
      }
      break;
    case 'news_top_destinations':
      $vars['title'] = html_entity_decode($vars['title']);
      $back_link_title = t('LATEST NEWS') . ' <span class="ico ss-icon ss-standard ss-navigateleft"></span>';
      $vars['back_link'] = l($back_link_title, 'node/' . ATJ_NEWS_LANDING_NID, array(
        'attributes' => array('class' => array('link type-back')),
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

      if ($vars['view_mode'] === 'teaser') {
        $items = field_get_items('node', $node, 'field_news_td_items');
        if(!empty($items[0]['value'])) {
          $field_collection_item = field_collection_item_load($items[0]['value']);
          $fc_fields = array(
            'field_news_td_items_image',
//            'field_news_td_items_desc',
          );
          foreach ($fc_fields as $fc_field) {
            $vars['content'][$fc_field] = field_view_field('field_collection_item', $field_collection_item, $fc_field, 'teaser');
          }
        }
      }
      break;
    case 'resources':
    case 'partners':
      if ($vars['view_mode'] === 'teaser') {
        $vars['title'] = '';
      }
      break;
    case 'travel_expert':
      if ($vars['view_mode'] == 'teaser') {
        $vars['background_url'] = (isset($vars['content']['field_travel_expert_photo']) &&
          !empty($vars['content']['field_travel_expert_photo']['#items'])) ?
          file_create_url($vars['content']['field_travel_expert_photo']['#items'][0]['uri']) : '';
      }
      break;
    case 'country_overview':
      if ($vars['view_mode'] == 'destination_generator') {
        $background = _atj_get_rows_from_node($node, array('field_region_background'));
        $vars['background'] = isset($background['field_region_background']) ?
          file_create_url($background['field_region_background']['uri']) : '';

        $menu_item = menu_link_get_preferred('node/' . $node->nid, 'main-menu');
        if ($menu_item) {
          $menu_parent_item = _menu_link_find_parent($menu_item);
          if ($menu_parent_item && isset($menu_parent_item['link_title'])) {
            $vars['title'] = $menu_parent_item['link_title'];

            $map = trim($vars['title']);
            $map = strtolower($map);
            $map = str_replace(' ', '-', $map);
            $vars['map'] = __THEME_PATH . '/images/maps/map-' . $map . '.png';
          }
        }
      }
      break;
    case 'weather':
      $vars['classes_array'][] = 'b-chart';
      $path = drupal_get_path('theme', 'atj');
      drupal_add_js($path . '/js/lib/d3.v3.min.js');
      drupal_add_js($path . '/js/weather.js');
      break;
    case '30_years':
      if (isset($vars['content']['field_country_content_type'])) {
        $vars['content']['field_country_content_type']['#access'] = FALSE;
      }
      break;
    case 'awards':
      if (isset($vars['content']['field_awards_subtitle_link']) &&
        !empty($vars['content']['field_awards_subtitle_link']['#items'])) {
        $vars['subtitle_url'] = $vars['content']['field_awards_subtitle_link']['#items'][0]['url'];
      }
      break;
    case 'page':
      if ($node->nid == ATJ_NEWS_LANDING_NID) {
        _atj_disable_access($vars['content']['body']);
      }
      _atj_disable_access($vars['content']['field_home_top_items']);
      break;
  }
}

/**
 * Implements hook_preprocess_field().
 */
function atj_preprocess_field(&$vars, $hook) {
  $element = $vars['element'];
  switch ($element['#field_name']) {
    case 'field_group_trips_item_desc':
      $vars['classes_array'][] = 'text';
      $vars['theme_hook_suggestions'][] = 'field__main_wrapper';
      break;
    case 'field_flipbook_link':
    case 'field_flipbook_content':
    case 'field_group_trips_item_link':
      $vars['theme_hook_suggestions'][] = 'field__no_wrappers';
      break;
    case 'field_trip_landing_links':

      if(!empty($element['#object']->nid) && $element['#object']->nid == ATJ_CUSTOM_TRAVEL_ASIA_NID) {

        foreach ($vars['items'] as $delta => $item) {
          if(isset($vars['items'][$delta]['#element']['attributes'])) {
            $vars['items'][$delta]['#element']['attributes']['data-gacategory'] = 'travel-asia';
            $vars['items'][$delta]['#element']['attributes']['data-gaaction'] = 'click';
            $vars['items'][$delta]['#element']['attributes']['data-galabel'] = strtolower(check_plain($vars['items'][$delta]['#element']['title']));
          }
        }
      }
      break;
    case 'field_block_links':
      $vars['classes_array'][] = 'items';
      break;
    case 'field_donation_link':
      $vars['classes_array'][] = 'btn-wrap';
      break;
    case 'field_news_image':
    case 'field_reg_highl_image':
    case 'field_group_trip_detail_img':
      $host_entity = !empty($element['#object']) ? $element['#object'] : '';
      $host_entity_type = !empty($host_entity->type) ? $host_entity->type : '';
      if ($host_entity_type != 'news_gallery_bottom') {
        foreach ($vars['items'] as $key => $item) {
          $vars['items'][$key]['#item']['attributes']['class'][] = 'without-adaptive-styles';
        }
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
    case 'field_accommodations':
      $vars['classes_array'][] = 'b-articles';
      break;
    case 'field_accommodations_photo':
      $vars['classes_array'][] = 'photo';
      foreach ($vars['items'] as $key => $item) {
        $vars['items'][$key]['#item']['attributes']['class'][] = 'without-adaptive-styles';
      }
      break;
    case 'field_terms_logo':
      $vars['classes_array'][] = 'logo';
      break;
    case 'field_departure_land_cost':
      $vars['classes_array'][] = 'item-desc';
      break;
    case 'field_block_links':
      $vars['classes_array'][] = 'items';
      $vars['theme_hook_suggestions'][] = 'field__field_block_links_main';
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

      $attributes = array('class' => array( 'link', 'type-read-more', 'style-red'));
      $attributes['data-gacategory'] = !empty($vars['group']) ? 'group planner': 'custom planner';
      $attributes['data-gaaction'] = 'click';
      $attributes['data-galabel'] =  !empty($vars['group']) ? $group_name : $country_name;

      $vars['planer_pdf_link'] = atj_filemaker_get_planner_link(
        $vars['link_text'] . '<span class="ico ss-icon ss-standard ss-navigateright"></span>',
        $vars['country'],
        !empty($vars['group']) ? $vars['group'] : NULL ,
        array('html' => TRUE, 'attributes' => $attributes,)
      );
      break;
    case 'field_team_links':
      $items = !empty($element['#items']) ? $element['#items'] : array();
      $link_class = array('link', 'type-read-more', 'style-red');
      $icon_class = array('ico', 'ss-icon', 'ss-standard', 'ss-navigateright');
      $vars['team_links'] = array();
      foreach ($items as $item) {
        $vars['team_links'][] = _atj_get_link_with_icon($item, $link_class, $icon_class);
      }
      break;
    case 'field_team_back_link':
      $items = !empty($element['#items']) ? $element['#items'] : array();
      $link_class = array('link', 'type-back-b', 'style-red');
      $icon_class = array('ico', 'ss-icon', 'ss-standard', 'ss-navigateleft');
      $vars['team_links'] = array();
      foreach ($items as $item) {
        $vars['team_links'][] = _atj_get_link_with_icon($item, $link_class, $icon_class);
      }
      break;
    case 'field_dest_gen_destinations':
      $dest_back_images = _atj_rows_from_field_collection($vars, array('field_region_background'));
      $back_images = array();
      foreach ($dest_back_images as $key => $image) {
        $url = isset($image['field_region_background']['uri']) ?
          file_create_url($image['field_region_background']['uri']) : '';
        if ($url) {
          $back_images[$key] = $url;
        }
      }
      $vars['back_images'] = $back_images;
      break;
    case 'field_dest_gen_dest_link':
      $items = !empty($element['#items']) ? $element['#items'] : array();
      $link_class = array('link', 'type-read-more', 'style-purple');
      $icon_class = array('ico', 'ss-icon', 'ss-standard', 'ss-navigateright');
      $vars['dest_links'] = array();
      foreach ($items as $item) {
        $vars['dest_links'][] = _atj_get_link_with_icon($item, $link_class, $icon_class);
      }
      break;
    case 'field_part_con_files_files':
      $logos_page = FALSE;
      if ((arg(0) == 'node') && is_numeric(arg(1)) && (arg(1) == ATJ_PARTNERS_LOGOS_NID)) {
        $logos_page = TRUE;
      }

      foreach ($element['#items'] as $delta => $item) {
        $file = isset($item['fid']) ? file_load($item['fid']) : '';

        if ($file) {
          if ($logos_page) {
            $image = array(
              'path' => $file->uri,
              'width' => '',
              'height' => '',
              'style_name' => 'partners__logo',
            );
            $vars['download_urls'][$delta] = '<div class="logo-img">' . theme('image_style', $image) . '</div>';
            $vars['list_class'] = 'with-images';
          }
          else {
            $vars['download_urls'][$delta] = '';
          }

          $file_name = isset($item['description']) ? $item['description'] : $file->filename;
          $file_name .= '<span class="ico ss-icon ss-glyphish-filled ss-download"></span>';
          $uri = file_entity_download_uri($file);
          $vars['download_urls'][$delta] .= l($file_name, $uri['path'], array(
            'attributes' => array(
              'class' => array('link', 'type-download')),
            'query' => $uri['options']['query'],
            'html' => TRUE,)
          );
        }
      }
      break;
    case 'field_30_year_slider_date':
      if (!empty($element['#items'])) {
        $value = $element['#items'][0]['value'];
        $dates = explode("|", $value, 2);
        $first_date = isset($dates[0]) ? '<span class="date-1">' . $dates[0] . '</span>' : '';
        $second_date = isset($dates[1]) ? '<span class="date-2">' . $dates[1] . '</span>' : '';
        $vars['dates'] = $first_date . '<span class="separator"></span>' . $second_date;
      }
      break;
    case 'field_news_tags':
      $host_entity = !empty($element['#object']) ? $element['#object'] : '';
      $node_type = (!empty($host_entity) && !empty($host_entity->type)) ?
        $host_entity->type : '';
      if ($node_type == 'news_gallery_bottom') {
        if (!empty($vars['items'])) {
          foreach ($vars['items'] as $key => $item) {
            $title = !empty($item['#title']) ? $item['#title'] : '';
            $vars['items'][$key]['#href'] = 'news';
            $vars['items'][$key]['#options'] = array('query' =>
              array('tags' => $title)
            );
          }
        }
      }
      break;
    case 'field_home_top_items':
      if (!empty($vars['items'])) {
        $items = $vars['items'];
        $fc_item = !empty($items[0]['entity']['field_collection_item']) ?
          current($items[0]['entity']['field_collection_item']) : array();
        $view_mode = !empty($fc_item['#view_mode']) ? $fc_item['#view_mode'] : '';

        if ($view_mode == 'for_not_supported') {
          $icon_items = array();

          foreach ($items as $fc_key => $fc_item) {
            $item = !empty($fc_item['entity']['field_collection_item']) ?
              array_shift($fc_item['entity']['field_collection_item']) : array();
            if (!empty($item['field_home_top_items_icon'])) {
              if (!empty($item['field_home_top_items_icon'][0])) {
                $item['field_home_top_items_icon'][0]['#tag'] = 'a';
                $item['field_home_top_items_icon'][0]['#attributes']['href'] = '#';
              }

              $icon_items[] = drupal_render($item['field_home_top_items_icon']);
            }
          }

          if (!empty($icon_items)) {
            $vars['icon_list'] = theme('item_list', array('items' => $icon_items));
          }
        }
      }
      break;
    case 'field_home_top_mob_sec_title':
      if (!empty($vars['items'])) {
        $vars['items'][0]['#markup'] = html_entity_decode($vars['items'][0]['#markup']);
      }
      break;
    case 'field_home_top_image':
    case 'field_home_top_mob_image':
      $vars['theme_hook_suggestions'][] = "field__" . $element['#field_name'] . "__" . $element['#view_mode'];
      break;
    case 'field_f_dest_paragraphs':
      $custom_planers_key = array();
      $paragraphs_items = !empty($vars['items']) ? $vars['items'] : array();
      $source = _atj_get_custom_planer_source_from_paragraphs($paragraphs_items);

      if (!empty($source)) {
        module_load_include('inc','atj_custom', '/includes/atj_custom.helpers');
        $custom_planers_source = atj_custom_views_retrieve('custom_trip_planner_select_source');

        $options = array(
          'none' => t('Check Out Our Custom Planner'),
        );
        $base_path = base_path();

        foreach ($custom_planers_source as $key => $item) {
          if (!empty($item->nid)) {
            $custom_planers_key[$item->nid] = $custom_planers_source[$key];
          }
        }

        foreach ($source as $first_level_key => &$first_level_value) {
          $cp_options = array();
          $planners_select = array();

          foreach ($first_level_value as $second_level_key => &$second_level_value) {
            $nid = !empty($second_level_value['nid']) ? $second_level_value['nid'] : '';
            if (!empty($custom_planers_key[$nid])) {
              $second_level_value['fid'] = !empty($custom_planers_key[$nid]->fid) ?
                $custom_planers_key[$nid]->fid : '';

              if (!empty($_COOKIE['planner'])) {
                if (!empty($second_level_value['fid'])) {
                  $cp_options[$base_path . 'get-planner-file/' . $second_level_value['fid']] = $second_level_value['title'];
                }
              } else {
                if (!empty($second_level_value['nid'])) {
                  $cp_options[url('node/' . ATJ_WEBFORM_PLANNER_NID, array('query'=> array('country' => $second_level_value['nid'])))] = $second_level_value['title'];
                }
              }
            }
            else {
              unset($first_level_value[$second_level_key]);
            }
          }

          if (!empty($cp_options)) {
            $cp_options = $options + $cp_options;

            $planners_select = array(
              '#prefix' => '<div class="form-item form-type-select">',
              '#suffix' => '</div>',
              '#type' => 'select',
              '#required' => FALSE,
              '#title' => t(''),
              '#empty_value' => 'none',
              '#options' => $cp_options,
              '#attributes' => array('class' => array('form-select', 'redirect-select', 'select-pick-destination')),
            );
            $planners_select['#attributes']['data-gacategory'] = 'travel-asia';
            $planners_select['#attributes']['data-gaaction'] = 'get custom trip planner';
            $source[$first_level_key]['select'] = $planners_select;
          }
        }

        $vars['custom_planers_select'] = !empty($source) ? $source : array();
      }
      break;
    case 'field_home_top_items_link':
      $fc_item = !empty($element['#object']) ? $element['#object'] : '';
      $node = (!empty($fc_item) && !empty($fc_item->hostEntity())) ? $fc_item->hostEntity() : '';
      if (!empty($node) && ($node->nid == ATJ_NEWS_LANDING_NID)) {
        $catalog = url('node/' . ATJ_CATALOG_NID, array('absolute' => TRUE));
        $contact = url('node/' . ATJ_CONTACT_NID, array('absolute' => TRUE));

        foreach ($vars['items'] as &$item) {
          $url = !empty($item['#element']['url']) ? $item['#element']['url'] : '';
          $cta_class = '';

          if ($url == $catalog) {
            $cta_class = 'cta-news-catalog';
          }
          if ($url == $contact) {
            $cta_class = 'cta-news-contact';
          }
          $item['#element']['attributes']['class'] = $item['#element']['attributes']['class'] . ' ' . $cta_class;
        }
      }
      break;
    case 'field_rewards_images':
      $vars['classes_array'][] = 'img-wrap';
      $vars['theme_hook_suggestions'][] = 'field__main_wrapper';
      break;
  }
//  $vars['theme_hook_suggestions'][] = "field__" . $element['#field_name'] . "__" . $element['#view_mode'];
}

function atj_get_planner_link() {
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

  $attributes = array('class' => array( 'link', 'type-read-more', 'style-red'));
  $attributes['data-gacategory'] = 'custom planner';
  $attributes['data-gaaction'] = 'click';
  $attributes['data-galabel'] = $country_name;

  return atj_filemaker_get_planner_link(
    'GET YOUR CUSTOM PLANNER <span class="ico ss-icon ss-standard ss-navigateright"></span>',
    $country_nid,
    NULL,
    array('html' => TRUE, 'attributes' => $attributes)
  );
}

/**
 * Get planner file url. Node should have field_common_itinerary_pdf field.
 * @param $nid
 * @return string file url
 */
function atj_get_planner_file_url($nid) {
  $node = !empty($nid) ? node_load($nid) : NULL;
  $url = '';
  if(!empty($node)) {
    $fields = _atj_get_rows_from_node($node, array('field_common_itinerary_pdf'));
    if(!empty($fields['field_common_itinerary_pdf']['uri'])) {
       $url = url('get-planner-file/' . $fields['field_common_itinerary_pdf']['fid']);
    }
  }
  return $url;
}

/**
 * Implements hook_preprocess_webform_form().
 */
function atj_preprocess_webform_form(&$vars) {
  $node = $vars['form']['#node'];
  //dsm($vars);

}

/**
 * Implements hook_preprocess_views_view().
 * @param $vars
 */
function atj_preprocess_views_view(&$vars) {
  switch ($vars['name']) {
    case "news":

      break;
  }
}

/**
 * Implements template_preprocess_block().
 */
function atj_preprocess_block(&$vars) {

  switch ($vars['block']->delta) {
    case 'form':
      if ($vars['block']->module == 'search') {
        $vars['classes_array'][] = 'form form-search';
      }
      break;
    case 'destination-generator-wanderlust':
      $content = isset($vars['elements']['bean']['destination-generator-wanderlust']) ?
        $vars['elements']['bean']['destination-generator-wanderlust'] : '';
      $vars['default_background'] = isset($content['field_region_background']) ?
        file_create_url($content['field_region_background']['#items'][0]['uri']) : '';
      $vars['default_desc'] = isset($content['field_dest_gen_desc']) ?
        $content['field_dest_gen_desc']['#items'][0]['safe_value'] : '';
      $destination_generator_block = module_invoke('views', 'block_view', 'destination_generator-block');
      $vars['destinatinations_list'] = isset($destination_generator_block['content']) ?
        $destination_generator_block['content'] : '';
//      $vars['destinatinations_list'] = isset($content['field_dest_gen_destinations']) ?
//        $content['field_dest_gen_destinations'] : '';
      break;
    case ATJ_RESOURCES_SUBNAVIGATION_BID:
      if ($vars['block']->module == 'menu_block') {
        $vars['classes_array'][] = 'list';
      }
      break;
  }
}

/**
 * Implements hook_form_alter().
 */
function atj_form_alter(&$form, &$form_state, $form_id) {
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
      case 'contact_us':
        $form['#attributes']['class'][] = 'form';
        $form['#attributes']['class'][] = 'form-contact';
        break;
      case 'webform_love_language':
        $form['submitted']['name_of_the_person_youre_sending_this_to']['#attributes']['autocomplete'] = 'off';
        break;
      case 'webform_catalog':
        $form['#attributes']['class'][] = 'form-type-a';
        $form['#attributes']['class'][] = 'form';
        if($node->nid == ATJ_WEBFORM_CATALOG_REQUEST2_NID) {
          $form['#attributes']['class'][] = 'style-a';
        }
        break;
      case 'webform_trip_application':
        $form['#attached']['js'][] = drupal_get_path('theme', 'atj') . '/js/custom/trip_application_webform.js';
        $form['#attributes']['class'][] = 'trip-application-form';
        if(!empty($form['actions']['next'])) {
          $form['actions']['next']['#suffix'] = '<div class=pull-center><i class="style-red">' .t('and continue to Traveler Information') . '</i></div>';

        }
        // Get the value of step number and the total number of steps in form.
        $page_num = $form['details']['page_num']['#value'];
        $page_count = $form['details']['page_count']['#value'];

        // Check if its not the last step and captcha present in form.
        if (($page_num != $page_count) && (!empty($form['captcha']))) {
          // Remove the captcha from the form.
          unset($form['captcha']);
        }
        break;
    }
  }

}

/**
 * Custom checkboxes process function. Attach terms images to checkboxes.
 *
 * @param $element
 * @return mixed
 */
function atj_taxonomy_checkboxes_process($element) {
//  dsm($element);
  foreach ($element['#related_terms'] as $key => $term_info) {
    if(!empty($element[$term_info->tid]) && !empty($term_info->image)) {
      $element[$term_info->tid]["#title"] = '<img src="' . $term_info->image . '">' . '<span class="title">' . $element[$term_info->tid]["#title"] . '</span>';
      $element[$term_info->tid]['#suffix'] = '<span class="ico">+</span>';
      $element[$term_info->tid]['#attributes']['class'] = array();
      atj_wrap_item($element[$term_info->tid], 'item');
    }
  }

  return $element;
}

/**
 * Custom checkboxes process function.
 *
 * @param $element
 * @return mixed
 */
function atj_flexlider_checkboxes_process($element) {

  foreach (element_children($element) as $key) {
    $element[$key]['#prefix'] = $element[$key]['#title'];
    $element[$key]['#title_display'] = 'none';
    atj_wrap_item($element[$key], '', 'li');
  }
  return $element;
}

function _atj_get_link_with_icon($link_field, array $link_class = array(), array $icon_class = array()) {
  $url = isset($link_field['url']) ? $link_field['url'] : '';
  $title = isset($link_field['title']) ? $link_field['title'] : '';
  $link_class = implode(' ', (array) $link_class);
  $icon_class = implode(' ', (array) $icon_class);

  if ($url) {
    if (!empty($icon_class)) {
      $title .= ' <span class="' . $icon_class . '"></span>';
    }
    return l($title, $url, array(
      'attributes' => array('class' => $link_class),
      'html' => TRUE
    ));
  }
}


/**
 * Implements hook_theme().
 */
function atj_theme($existing, $type, $theme, $path) {
  return array(
    'atj_region__section' => array(
      'template' => 'atj-region--section',
      'variables' => array(
        'title_prefix' => '',
        'title' => '',
        'title_suffix' => '',
        'text' => '',
        'background_img' => '',
        'map' => '',
        'show_form' => '',
      ),
      'path' => drupal_get_path('theme', 'atj') . '/templates/theme',
    ),
    'atj_background__special' => array(
      'template' => 'atj-background--special',
      'variables' => array(
        'type' => '',
        'content' => '',
      ),
      'path' => drupal_get_path('theme', 'atj') . '/templates/theme',
    ),
    'atj_lantern_submission' => array(
      'template' => 'atj-lantern-submission',
      'variables' => array(
        'content' => array(),
      ),
      'path' => drupal_get_path('theme', 'atj') . '/templates/theme',
    ),
//    'atj_top_section' => array(
//      'template' => 'atj-top-section',
//      'variables' => array(),
//      'path' => drupal_get_path('theme', 'atj') . '/templates/theme',
//    ),
  );
}

/* main ul */
function atj_menu_tree__main_menu($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

/* inner ul */
function atj_menu_tree__main_menu_inner($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

/* inner li */
function atj_menu_link__main_menu_inner($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/* main li */
function atj_menu_link__main_menu(array $variables) {
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
 * Implements theme_form_element_label().
 * move required mark to first place
 */
function atj_form_element_label($variables) {
  $element = $variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if ((!isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
    return '';
  }

  // If the element is required, a required marker is appended to the label.
  $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';

  $title = filter_xss_admin($element['#title']);

  $attributes = array();
  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'] = 'option';
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }

  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $t('!required !title', array('!title' => $title, '!required' => $required)) . "</label>\n";
}

/**
 * Implements hook_preprocess_entity().
 */
function atj_preprocess_entity(&$variables, $hook) {
  $function = 'atj_preprocess_' . $variables['entity_type'];
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}

/**
 * Implements hook_preprocess_paragraphs_item().
 */
function atj_preprocess_paragraphs_item(&$vars) {

  switch($vars['paragraphs_item']->bundle) {
    case 'catalog_button':

      $vars['classes_array'][] = 'links-wrapper';

      if (!empty($vars['elements']['field_par_catalog_country']['#items'][0]['target_id'])
        && !empty($vars['field_par_catalog_btn_title'][0]['value'])
      ) {

        $vars['content']['field_par_catalog_btn_title']['#access'] = FALSE;
        $vars['content']['field_par_catalog_country']['#access'] = FALSE;

        $vars['content']['catalog_link']['#markup'] = atj_filemaker_get_planner_link(
          $vars['field_par_catalog_btn_title'][0]['value'],
          $vars['elements']['field_par_catalog_country']['#items'][0]['target_id'],
          NULL,
          array(
            'html' => TRUE,
            'attributes' => array('class' => array('link type-btn'))
          )
        );
      }

      break;
  }
}

/**
 * Field Collection-specific implementation of template_preprocess_entity().
 */
function atj_preprocess_field_collection_item(&$vars) {
  $elements = $vars['elements'];
  $vars['wrapper_cl'] = '';
  switch ($elements['#bundle']) {
    case 'field_accommodations':
      if (!isset($vars['field_accommodations_photo'])) {
        $vars['wrapper_cl'] = 'without-img';
      }
      if(!empty($vars['field_accommodations_desc'][0]['value'])) {
        //get title from description field
        preg_match('/<h\d>(.*?)<\/h\d>/', $vars['field_accommodations_desc'][0]['value'], $matches);
        if(!empty($matches[1])) {
          $host_entity = $vars['field_collection_item']->hostEntity();
          $vars['content']['field_accommodations_link'][0]['#element']['attributes']['data-gacategory'] = 'accomodations';
          $vars['content']['field_accommodations_link'][0]['#element']['attributes']['data-gaaction'] = 'click';
          $vars['content']['field_accommodations_link'][0]['#element']['attributes']['data-galabel'] = (!empty($host_entity) ? check_plain($host_entity->title) . ': ' : '' ) . check_plain($matches[1]);
        }
      }
      break;
    case 'field_block_links':
      if (isset($vars['content']['field_block_links_link']) && !empty($vars['content']['field_block_links_link'])) {
        $vars['content']['link'] = $vars['content']['field_block_links_link']['#items'][0]['url'];
        $vars['content']['link_title'] = $vars['content']['field_block_links_link']['#items'][0]['title'];
      }
      break;
    case 'field_group_trip_content':
      $vars['classes_array'][] = 'item-desc';
      break;
    case 'field_regions_highlights':
    case 'field_regions_adventures':
      //attach country name
      /** @var FieldCollectionItemEntity $fc */
      if (!isset($vars['field_reg_highl_image'])) {
        $vars['wrapper_cl'] = 'without-img';
      }
      $fc = $vars['field_collection_item'];
      if(!empty($fc->country)) {
        $vars['content']['country'] = array(
          //'#markup' => atj_custom_get_node_country_name($fc->hostEntityId()),
          '#markup' => $fc->country,
        );
      }
      break;
    case 'field_30_year_slider':
      $entity = isset($elements['#entity']) ? $elements['#entity'] : '';
      if ($entity && is_object($entity)) {
        $host_entity = $entity->hostEntity();
        if (isset($host_entity)) {
          $nid = $host_entity->nid;
          $node = node_load($nid);
          if (isset($node) && !empty($node)) {
            node_build_content($node);
            if (isset($node->content['field_country_content_type'])) {
              $vars['main_title'] = drupal_render($node->content['field_country_content_type']);
            }
            if (isset($node->content['field_common_subtitle'])) {
              $vars['subtitle'] = drupal_render($node->content['field_common_subtitle']);
            }
          }
        }
      }
      break;
    case 'field_home_top_items':
      $type = !empty($vars['content']['field_home_top_items_type']) ?
        $vars['content']['field_home_top_items_type']['#items'][0]['value'] : '';
      switch ($type) {
        case 'custom_planner':
        case 'custom_planner_small':
          module_load_include('inc','atj_custom', '/includes/atj_custom.helpers');
          $custom_planers_source = atj_custom_views_retrieve('custom_trip_planner_select_source');

          $options = array(
            'none' => t('PICK A DESTINATION'),
          );
          $base_path = base_path();
          foreach ($custom_planers_source as $item) {
            if(!empty($_COOKIE['planner'])) {
              if(!empty($item->fid)) {
                $options[$base_path . 'get-planner-file/' . $item->fid] = $item->country;
              }
            } else {
              if(!empty($item->nid)) {
                $options[url('node/' . ATJ_WEBFORM_PLANNER_NID, array('query'=> array('country' => $item->nid)))] = $item->country;
              }
            }
          }

          $planners_select = array(
            '#prefix' => '<div class="form-item form-type-select">',
            '#suffix' => '</div>',
            '#type' => 'select',
            '#required' => FALSE,
            '#title' => t(''),
            '#empty_value' => 'none',
            '#options' => $options,
            '#attributes' => array('class' => array('form-select', 'select-pick-destination', 'redirect-select')),
          );
          $planners_select['#attributes']['data-gacategory'] = drupal_get_path_alias(current_path());
          $planners_select['#attributes']['data-gaaction'] = 'get custom trip planner';

          $vars['custom_planner'] = $planners_select;
          break;
      }
      break;
    case 'field_news_td_items':
      $entity = isset($elements['#entity']) ? $elements['#entity'] : '';
      if ($entity && is_object($entity)) {
        $host_entity = $entity->hostEntity();
        $host_entity_type = (!empty($host_entity) && !empty($host_entity->type)) ?
          $host_entity->type : '';
        $last_item_id = end($host_entity->field_news_td_items[LANGUAGE_NONE]);
        $last_item_id = !empty($last_item_id['value']) ? $last_item_id['value'] : '';
        $current_item_id = !empty($entity->item_id) ? $entity->item_id : '';

        if (($host_entity_type == 'news_top_destinations') && ($current_item_id == $last_item_id)) {
          $mPath = url('node/' . $host_entity->nid, array('absolute' => TRUE));
          $mTitle = $host_entity->title;
          $data_options = sharethis_get_options_array();

          $sharethis = theme('sharethis', array('data_options' => $data_options, 'm_path' => $mPath, 'm_title' => $mTitle));
          $sharethis = strip_tags($sharethis, '<span>');

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

          $vars['sharethis'] = array(
            '#tag' => 'div',
            '#type' => 'html_tag',
            '#attributes' => array('class' => 'sharethis-buttons'),
            '#value' => $sharethis,
            '#weight' => intval(variable_get('sharethis_weight', 10)),
          );
        }
      }
      break;
    case 'field_home_top_slider':
      $section_top_type = (isset($vars['content']['field_home_top_bl_type']) && !empty($vars['content']['field_home_top_bl_type']['#items'])) ?
        $vars['content']['field_home_top_bl_type']['#items'][0]['value'] : 'defaultstyle';
      $special_items = array('style-season-giving', 'style-new-year');

      if(!empty($vars['content']['field_home_top_link_type']['#items'][0]['value'])
        && $vars['content']['field_home_top_link_type']['#items'][0]['value'] == 'slide') {

        if(!empty($vars['content']['field_home_top_slide_link'][0]['#element']['url'])) {
          $vars['slide_url'] = $vars['content']['field_home_top_slide_link'][0]['#element']['url'];
        }
      } else if (isset($vars['content']['field_home_top_bl_link'])) {
        $icon_class = array();
        $link_field = $vars['content']['field_home_top_bl_link']['#items'][0];

        if ($section_top_type == 'style-c') {
          $link_class = array('link style-purple type-read-more-a');
        }
        elseif (($section_top_type == 'style-season-giving') || ($section_top_type == 'style-new-year')) {
          $link_class = array('link style-purple type-read-more-a');
        }
        else {
          $link_class = array('link type-read-more style-white');
          $icon_class = array('ico ss-icon ss-standard ss-navigateright');
        }
        $vars['top_bl_link'] = _atj_get_link_with_icon($link_field, $link_class, $icon_class);
      }

      if (in_array($section_top_type, $special_items)) {
        $vars['theme_hook_suggestions'][] = 'field_collection_item__field_home_top_slider__special';
      }
      break;
  }
}

/**
 * Implements hook_preprocess_views_view_unformatted().
 */
function atj_preprocess_views_view_unformatted(&$vars) {
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
function _atj_rows_from_field_collection(&$vars, $field_array) {
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
      watchdog('atj', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
    }
  }

  return $rows;
}

/**
 * Theme helper function
 */
function _atj_disable_access(&$element) {
  if(!empty($element)) {
    $element['#access'] = FALSE;
  }
}

/**
 * Bean implementation of template_preprocess_entity().
 */
function atj_preprocess_bean(&$vars) {
  $bean = $vars['bean'];

  switch ($bean->type) {
    case 'menu_bottom':
      $view = views_get_view('main_menu_featured_destination');
      if (!empty($view) && $view->display['block']->display_options['enabled'] == TRUE) {
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
function atj_wrap_item(&$element, $classes, $tag = 'div') {
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
function atj_add_classes(&$element, $classes) {
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
function _atj_get_custom_planer_source_from_paragraphs($paragraphs_items){
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
function atj_preprocess_page_add_lantern_values_settings($nid) {

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

  drupal_add_js(array('atj_lanterns' => $values), 'setting');
}

/**
 * Get donation lantern submissions. Ad put to js settings.
 *
 * @param $nid
 *  Webform node nid with submissions.
 */
function _atj_get_seo_elements($nid) {
  $seo_elements = '';
  $map = array(
    '200' => array(
      'h2' => array(
        'attributes' => array('class' => array('element-invisible'),),
        'value' => t('Travel Resources'),
      ),
    ),
    '47' => array(
      'h2' => array(
        'attributes' => array('class' => array('element-invisible'),),
        'value' => t('Map of Asia'),
      ),
    ),
    '350' => array(
      'h2' => array(
        'attributes' => array('class' => array('element-invisible'),),
        'value' => t('Asia and The Pacific'),
      ),
    ),
    '349' => array(
      'h2' => array(
        'attributes' => array('class' => array('element-invisible'),),
        'value' => t('Solo Travel'),
      ),
    ),
    '340' => array(
      'h2' => array(
        'attributes' => array('class' => array('element-invisible'),),
        'value' => t('Travel News'),
      ),
    ),
    '368' => array(
      'h2' => array(
        'attributes' => array('class' => array('element-invisible'),),
        'value' => t('Travel News'),
      ),
    ),
  );

  if (!empty($map[$nid])) {
    foreach($map[$nid] as $tag => $content) {
      $attributes = !empty($content['attributes']) ? $content['attributes'] : array();
      $value = !empty($content['value']) ? $content['value'] : '';

      $seo_elements .= theme('html_tag', array(
        'element' => array(
          '#tag' => $tag,
          '#attributes' => $attributes,
          '#value' => $value,
        ),
      ));
    }
  }

  return $seo_elements;
}

/**
 * SEO title.
 */
function _atj_get_seo_title($nid) {
  $seo_title = '';

  $map = array(
    '385' => t('India Travel Experience | Luxury Travel News'),
    '340' => t('ATJ - LUXURY TRAVEL NEWS'),
    '368' => t('Family Travel in Asia'),
  );

  if (!empty($map[$nid])) {
    $seo_title = $map[$nid];
  }
  return $seo_title;
}