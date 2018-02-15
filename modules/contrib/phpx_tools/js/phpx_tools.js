/**
 * @file
 * Defining behaviour for the user scripts and history entries table.
 */

(function ($) {
  'use strict';

  /**
   * Helper function to hide/show elements.
   */
  function phpxToolsSwitchVisibility(elements) {
    $(elements).each(function (index, value) {
      if ($(value).hasClass('element-hidden')) {
        $(value).removeClass('element-hidden');
      }
      else {
        $(value).addClass('element-hidden');
      }
    });
  }

  /**
   * Helper function to hide/show elements by direction.
   */
  function phpxToolsSwitchElementByDirection(elements) {
    $(elements).each(function (index, value) {
      if (value['direction'] === 'show') {
        $(value['element']).removeClass('element-hidden');
      }
      else if (value['direction'] === 'hide') {
        $(value['element']).addClass('element-hidden');
      }
    });
  }

  Drupal.behaviors.phpx_tools = {
    attach: function (context, settings) {
      $('.phpx-tools a.script-load').once('phpx-load').click(function (e) {
        e.preventDefault();
        var $editSave = $('#edit-save');
        var $editUpdate = $('#edit-update');
        var $editSaveExecute = $('#edit-saveandexecute');
        var $editUpdateExecute = $('#edit-updateandexecute');
        var $unloadScript = $('#edit-unload-script');
        // Show update buttons.
        phpxToolsSwitchVisibility([$editSave, $editUpdate, $editSaveExecute, $editUpdateExecute]);

        if ($unloadScript.length) {
          $unloadScript.removeClass('element-hidden');
        }

        var $parent = $(this).parents('tr').eq(0);
        var $loadLink = $('.script-load', $parent);
        var $codeCell = $('#' + $loadLink.attr('rel'), $parent);
        if (typeof Drupal.settings.phpxtools != 'undefined' &&
          typeof Drupal.settings.phpxtools.editors['code'] != 'undefined') {
          Drupal.settings.phpxtools.editors['code'].setValue($codeCell.text());
        }
        else {
          $('#edit-code').val($codeCell.text());
        }

        var $scriptName = $('#edit-script-name');
        var $load = $('#' + $loadLink.attr('rel') + '-name', $parent);

        if ($scriptName.length > 0 && $load.length > 0) {
          $('#active-script-name').val($load.text());
          $scriptName.val($load.text());
        }
      });
    }
  };

  Drupal.behaviors.phpxToolsInputEventHandler = {
    attach: function (context, settings) {
      var $editSave = $('#edit-save');
      var $editUpdate = $('#edit-update');
      var $editSaveExecute = $('#edit-saveandexecute');
      var $editUpdateExecute = $('#edit-updateandexecute');
      var $scriptName = $('#edit-script-name');
      var $activeScriptName = $('#active-script-name');
      var $unloadScript = $('#edit-unload-script');
      $scriptName.bind('input', function () {
        // Show 'Save' button pack only when there are different names
        // or names are same but one of them is empty.
        var elements = [];
        if ($scriptName.val().trim() !== $activeScriptName.val().trim()
          || ($scriptName.val().trim() === $activeScriptName.val().trim() && $activeScriptName.val().trim() === '')) {
          elements = [
            {direction: 'show', element: $editSave},
            {direction: 'hide', element: $editUpdate},
            {direction: 'show', element: $editSaveExecute},
            {direction: 'hide', element: $editUpdateExecute},
            {direction: 'hide', element: $unloadScript}
          ];
          phpxToolsSwitchElementByDirection(elements);
        }
        else {
          elements = [
            {direction: 'hide', element: $editSave},
            {direction: 'show', element: $editUpdate},
            {direction: 'hide', element: $editSaveExecute},
            {direction: 'show', element: $editUpdateExecute},
            {direction: 'show', element: $unloadScript}
          ];
          phpxToolsSwitchElementByDirection(elements);
        }
      });
    }
  };

  Drupal.behaviors.phpxToolsInitialize = {
    attach: function (context, settings) {
      var $activeScriptName = $('#active-script-name');
      var $editSave = $('#edit-save');
      var $editUpdate = $('#edit-update');
      var $unloadScript = $('#edit-unload-script');
      var $editSaveExecute = $('#edit-saveandexecute');
      var $editUpdateExecute = $('#edit-updateandexecute');
      if ($activeScriptName.length && $activeScriptName.val() !== '') {
        // Show update buttons.
        phpxToolsSwitchVisibility([$editSave, $editUpdate, $editSaveExecute, $editUpdateExecute, $unloadScript]);
      }
    }
  };

  Drupal.behaviors.phpxToolsUnloadScriptEventHandler = {
    attach: function (context, settings) {
      var $editSave = $('#edit-save');
      var $editUpdate = $('#edit-update');
      var $unloadScript = $('#edit-unload-script');
      var $editSaveExecute = $('#edit-saveandexecute');
      var $editUpdateExecute = $('#edit-updateandexecute');
      // Just remove all values (restore form to clean state).
      $unloadScript.mousedown(function (e) {
        e.preventDefault();
        $(this).addClass('element-hidden');
        $('#active-script-name').val(null);
        $('#edit-code').val(null);
        $('#edit-script-name').val(null);
        // Show save buttons.
        phpxToolsSwitchVisibility([$editSave, $editUpdate, $editSaveExecute, $editUpdateExecute]);
      });
    }
  };

})(jQuery);
