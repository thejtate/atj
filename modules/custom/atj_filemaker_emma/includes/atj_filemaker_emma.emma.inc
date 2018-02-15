<?php

atj_composer_loader_include();
module_load_include('php', 'atj_filemaker_emma', '/classes/OhMyEmmaResult');
module_load_include('php', 'atj_filemaker_emma', '/classes/OhMyEmma/EmmaOverrided');
module_load_include('php', 'atj_filemaker_emma', '/classes/OhMyEmma/SearchesOverrided');
//module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.test');

//use Kite\OhMyEmma\Emma;
//use MarkRoland\Emma\Client;

/**
 * Return emma client object.
 *
 * @return \MarkRoland\Emma\Client
 */
function atj_filemaker_emma_get_client() {

  $account_id = variable_get('atj_filemaker_emma_account_id');
  $public_api_key = variable_get('atj_filemaker_public_api_key');
  $private_api_key = variable_get('atj_filemaker_private_api_key');

  return new MarkRoland\Emma\Client($account_id, $public_api_key, $private_api_key);
}

function atj_filemaker_emma_ohmyemma_client() {

  $account_id = variable_get('atj_filemaker_emma_account_id');
  $public_api_key = variable_get('atj_filemaker_public_api_key');
  $private_api_key = variable_get('atj_filemaker_private_api_key');

  return new EmmaOverrided($account_id, $public_api_key, $private_api_key);
}

function atj_filemaker_emma_ohmyemma_add_webhooks($webhook_url) {
  $events = _atj_filemaker_emma_ohmyemma_get_webbhooks_events();
  $emma = atj_filemaker_emma_ohmyemma_client();
  $public_key = variable_get('atj_filemaker_public_api_key');

  foreach ($events as $event) {
    $emma->Webhooks->createUpdateWebhook(
      array(
        'event' => $event,
        'url' => $webhook_url,
        'method' => 'method',
        'public_key' => $public_key,
      )
    );
  }
}

function atj_filemaker_emma_ohmyemma_remove_webhooks($webhook_url) {
  $events = _atj_filemaker_emma_ohmyemma_get_webbhooks_events();
  $emma = atj_filemaker_emma_ohmyemma_client();


  $webhooks = atj_filemaker_emma_ohmyemma_get_all_webhooks();
  foreach ($webhooks as $webhook) {
    if ($webhook->url == $webhook_url && in_array($webhook->event, $events)) {
      $emma->Webhooks->removeWebhook($webhook->webhook_id);
    }
  }
}

function atj_filemaker_emma_ohmyemma_get_all_webhooks() {
  $emma = atj_filemaker_emma_ohmyemma_client();
  $response = atj_filemaker_emma_ohmyemma_results($emma->Webhooks->getWebhooks());

  return ($response->is_valid ? $response->data : array());
}

function _atj_filemaker_emma_ohmyemma_get_webbhooks_events() {
  return array(
    'member_update',
    'member_add',
  );
}

/**
 * Get wrapper emma results
 *
 * @param $data
 *  data from OhMyEmma client requests
 * @return \OhMyEmmaResult
 */
function atj_filemaker_emma_ohmyemma_results($data) {
  return new OhMyEmmaResult($data);
}