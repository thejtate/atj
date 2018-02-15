/**
 * ATJ Insurance.
 */
(function ($) {
  Drupal.behaviors.atjInsuranceForm = {
    attach: function (context, settings) {

      if (typeof settings.atj_insurance.form_id !== 'undefined') {
        attach_form_handlers($('#' + settings.atj_insurance.form_id), context, settings)
      }
    }
  };


  function attach_form_handlers($form, context, settings) {
    form_validate($form, settings);

    form_attach_add_more_travelers_handler($form);
    form_attach_remove_travelers_handler($form);

    form_attach_optional_coverages($form, 'exact-care-extra');
    form_attach_optional_coverages($form, 'exact-care-value');
    form_attach_optional_coverages($form, 'exact-care');
    form_attach_optional_coverages($form, 'exact-care-family');
    form_attach_add_flight_handler($form);
    form_attach_remove_flight_handler($form);
    form_attach_airline_flight_handler($form);
  }

  function form_attach_add_more_travelers_handler($form) {
    var $add_btn = $form.find('#add-more-travelers');

    $add_btn.once('add-more-btn').click(function () {
      var $last_travelers_row = $('.atj-insurance-travelers-row', $form).last(),
        $new_travelers_row = $last_travelers_row.clone(),
        $new_row_fields = $new_travelers_row.find('input'),
        last_number = $last_travelers_row.data('travelers-row-number');

      $new_travelers_row.data('travelers-row-number', (last_number + 1));

      $new_row_fields.each(function () {
        $(this).val('');
        $(this).attr('name', $(this).attr('name').replace('row_' + last_number, 'row_' + (last_number + 1)));
        $(this).removeClass('ages-once-processed');
      });

      $last_travelers_row.after($new_travelers_row);

      Drupal.attachBehaviors();
    });
  }

  function form_attach_remove_travelers_handler($form) {
    var $remove_btn = $form.find('.traveler-remove');

    $remove_btn.once('remove-btn').click(function () {
      $(this).closest('.atj-insurance-traveler-row').remove();
      // TODO: rename all attributes 'name' with new numbers.
    });
  }

  function form_attach_add_flight_handler($form) {
    var $add_btn = $form.find('#add-flight');

    $add_btn.once('add-more-btn').click(function () {
      var $last_flight_row = $('.atj-insurance-flight-row', $form).last(),
        $new_flight_row = $last_flight_row.clone(),
        $new_row_fields = $new_flight_row.find('input, select').not('[type="image"], [type="button"]'),
        last_number = $last_flight_row.data('flight-row-number'),
        $datepicker = $new_flight_row.find('input[type="image"]'),
        $remove_button = $new_flight_row.find('.remove-flight');

      $new_flight_row.find('.select2').remove();
      $datepicker.removeClass("hasDatepicker").removeAttr("id");
      $new_flight_row.data('flight-row-number', (last_number + 1));
      $new_flight_row.find('.airline').removeClass('jquery-once-1-processed');
      $new_flight_row.find('.departure-airport-code').removeClass('jquery-once-1-processed');
      $new_flight_row.find('.arrival-airport-code').removeClass('jquery-once-1-processed');
      $new_flight_row.removeClass('jquery-once-1-processed');
      $new_flight_row.removeClass('flight-processed');
      $remove_button.data('flight-row-number', (last_number + 1));
      $remove_button.removeClass("remove-btn-processed element-invisible");
      $new_flight_row.data('flight-row-number', (last_number + 1));

      $new_row_fields.each(function () {
        $(this).val('');
        $(this).attr('name', $(this).attr('name').replace('flight_' + last_number, 'flight_' + (last_number + 1)));
      });

      $last_flight_row.after($new_flight_row);

      Drupal.attachBehaviors();
    });
  }

  function form_attach_airline_flight_handler($form) {
    var $flights = $form.find('.atj-insurance-flight-row'),
      $airlines = $flights.find('.airline'),
      $flight_number = $flights.find('.flight-number'),
      $departure_airport_code = $flights.find('.departure-airport-code'),
      $arrival_airport_code = $flights.find('.arrival-airport-code'),
      providers = {},
      airport_code = {},
      request_term,
      $active_airline_list;

    $airlines.once().each(function () {
      var $airline = $(this);

      $airline.autocomplete({
        open: function (event, ui) {
          $active_airline_list = $(".ui-autocomplete").filter(":visible");
        },
        source: function (request, response) {
          show_throbber($airline);
          request_term = request.term;
          remove_no_result($airline);

          if (providers.hasOwnProperty(request_term)) {
            remove_throbber($airline);
            response($.map(providers[request_term], function (item) {

              return {
                label: item.name,
                providerCode: item.providerCode
              }
            }))
          } else {
            $.ajax({
              url: "https://api.bhtp.com/v1/Eligibility/Provider/StartWithSearch",
              dataType: "json",
              type: "GET",
              data: {
                typeFilter: "Airline",
                query: request_term
              },
              success: function (data) {
                remove_throbber($airline);
                if (data && data.length) {
                  var bhtp_airlines = [];

                  for (var i = 0; i < 10; i++) {
                    if (data[i] && (!data[i].isBlocked)) {
                      bhtp_airlines.push(data[i]);
                    }
                  }

                  if (bhtp_airlines.length) {
                    providers[request_term] = bhtp_airlines;
                    //console.log('In ajax:');
                    //console.log(providers);

                    response($.map(bhtp_airlines, function (item) {
                      return {
                        label: item.name,
                        providerCode: item.providerCode
                      }
                    }));
                  }

                } else {
                  $(".ui-autocomplete").hide().find("li").remove();
                  var $active = $(document.activeElement);

                  if ($airline.is($active) && !$airline.siblings(".no-result").length) {
                    show_no_result($airline);
                  }
                }
              }
            });
          }
        },
        minLength: 3,
        select: function (event, ui) {
          event.preventDefault();
          $(this).val(ui.item.label);
          var $airline_code = $(this).parents(".atj-insurance-flight-row").find(".airline-code");

          if ($airline_code.length) {
            $airline_code.val(ui.item.providerCode);
          }

          if (!(ui.item.label in providers))
            providers[ui.item.label] = [{
              name: ui.item.label,
              providerCode: ui.item.providerCode
            }]
        },
        focus: function (event, ui) {
          return false;
        },
        close: function (event, ui) {
          remove_throbber($airline);
          var current_request_term = $.trim($(this).val()),
            $default_airline;
          if ((current_request_term == request_term) || !current_request_term) {
            if ($active_airline_list && $active_airline_list.find("li").length && current_request_term) {
              $default_airline = $active_airline_list.find("li").eq(0);
              $(this).val($default_airline.text());
              if (!($default_airline.text() in providers))
                providers[$default_airline.text()] = [{
                  name: $default_airline.text(),
                  providerCode: $default_airline.data("code")
                }]
            } else {
              $(this).val('');
            }
          }

        }

      });
    });

    $departure_airport_code.once().each(function () {
      var $dac = $(this);

      $dac.autocomplete({
        open: function (event, ui) {
          $active_airline_list = $(".ui-autocomplete").filter(":visible");
        },
        source: function (request, response) {
          show_throbber($dac);
          request_term = request.term;
          remove_no_result($dac);

          var $flight_row = $dac.parents(".atj-insurance-flight-row"),
            $airline_code = $flight_row.find(".airline-code"),
            $airline_name = $flight_row.find(".airline"),
            $flight_number = $flight_row.find(".flight-number"),
            $flight_date = $flight_row.find(".flight-date"),
            $flight_date_year = $flight_date.find(".year"),
            $flight_date_month = $flight_date.find(".month"),
            $flight_arrival_airport = $flight_row.find(".arrival-airport-code"),
            $flight_date_day = $flight_date.find(".day"),
            airline_code_value = $airline_code.length ? $airline_code.val() : '',
            flight_number_value = $flight_number.length ? $flight_number.val() : '',
            arrival_airport_value = $flight_arrival_airport.length ? $flight_arrival_airport.val() : '',
            year_value = $flight_date_year.length ? $flight_date_year.val() : '',
            month_value = $flight_date_month.length ? $flight_date_month.val() : '',
            day_value = $flight_date_day.length ? $flight_date_day.val() : '',
            flight_date_value = '';

          validate_empty($airline_name);
          validate_empty($flight_number);
          validate_empty($flight_date_year);
          validate_empty($flight_date_month);
          validate_empty($flight_date_day);

          if (year_value && month_value && day_value) {
            if (month_value.length == 1) {
              month_value = "0" + month_value;
            }
            flight_date_value = month_value + "/" + day_value + "/" + year_value;
          }

          if (airline_code_value && flight_number_value && flight_date_value) {
            $.ajax({
              url: "https://api.bhtp.com/Eligibility/Flight/Schedule",
              dataType: "json",
              type: "POST",
              data: {
                airlineCode: airline_code_value,
                departureDate: flight_date_value,
                flightNumber: flight_number_value
              },
              success: function (data) {
                remove_throbber($dac);
                var airports = data.response.length ? data.response : '';
                if (airports) {
                  var bhtp_air_code = [];

                  for (var i = 0; i < airports.length; i++) {
                    if (airports[i] && arrival_airport_value) {
                      var option_arrival_airport = airports[i].arrivalAirportCode;

                      if (option_arrival_airport == arrival_airport_value) {
                        bhtp_air_code.push(airports[i]);
                      }
                    }
                    else if (airports[i]) {
                      bhtp_air_code.push(airports[i]);
                    }
                  }

                  if (bhtp_air_code.length) {
                    airport_code[request_term] = bhtp_air_code;

                    response($.map(bhtp_air_code, function (item) {
                      return {
                        label: item.departureAirportCode,
                        departure: item.departureAirportCode,
                        arrival: item.arrivalAirportCode
                      }
                    }));
                  }

                } else {
                  $(".ui-autocomplete").hide().find("li").remove();
                  var $active = $(document.activeElement);

                  if ($dac.is($active) && !$dac.siblings(".no-result").length) {
                    show_no_result($dac);
                  }
                }
              },
              complete: function () {
                remove_throbber($dac);
              }
            });
          }
          else {
            remove_throbber($dac);
            show_no_result($dac);
          }
        },
        minLength: 1,
        select: function (event, ui) {
          event.preventDefault();
          $(this).val(ui.item.label);

          if (!(ui.item.label in airport_code))
            airport_code[ui.item.label] = [{
              label: ui.item.label,
              departure: ui.item.departureAirportCode,
              arrival: ui.item.arrivalAirportCode
            }]
        },
        focus: function (event, ui) {
          return false;
        },
        close: function (event, ui) {
          remove_throbber($dac);
          var current_request_term = $.trim($(this).val()),
            $default_airline;
          if ((current_request_term == request_term) || !current_request_term) {
            if ($active_airline_list && $active_airline_list.find("li").length && current_request_term) {
              $default_airline = $active_airline_list.find("li").eq(0);
              $(this).val($default_airline.text());
              if (!($default_airline.text() in airport_code))
                airport_code[$default_airline.text()] = [{
                  label: ui.item.label.length ? ui.item.label : '',
                  departure: ui.item.departureAirportCode,
                  arrival: ui.item.arrivalAirportCode
                }]
            } else {
              $(this).val('');
            }
          }
        }

      });
    });

    $arrival_airport_code.once().each(function () {
      var $aac = $(this);

      $aac.autocomplete({
        open: function (event, ui) {
          $active_airline_list = $(".ui-autocomplete").filter(":visible");
        },
        source: function (request, response) {
          show_throbber($aac);
          request_term = request.term;
          remove_no_result($aac);

          var $flight_row = $aac.parents(".atj-insurance-flight-row"),
            $airline_code = $flight_row.find(".airline-code"),
            $airline_name = $flight_row.find(".airline"),
            $flight_number = $flight_row.find(".flight-number"),
            $flight_date = $flight_row.find(".flight-date"),
            $flight_date_year = $flight_date.find(".year"),
            $flight_date_month = $flight_date.find(".month"),
            $flight_departure_airport = $flight_row.find(".departure-airport-code"),
            $flight_date_day = $flight_date.find(".day"),
            airline_code_value = $airline_code.length ? $airline_code.val() : '',
            flight_number_value = $flight_number.length ? $flight_number.val() : '',
            departure_airport_value = $flight_departure_airport.length ? $flight_departure_airport.val() : '',
            year_value = $flight_date_year.length ? $flight_date_year.val() : '',
            month_value = $flight_date_month.length ? $flight_date_month.val() : '',
            day_value = $flight_date_day.length ? $flight_date_day.val() : '',
            flight_date_value = '';

          validate_empty($airline_name);
          validate_empty($flight_number);
          validate_empty($flight_date_year);
          validate_empty($flight_date_month);
          validate_empty($flight_date_day);

          if (year_value && month_value && day_value) {
            if (month_value.length == 1) {
              month_value = "0" + month_value;
            }
            flight_date_value = month_value + "/" + day_value + "/" + year_value;
          }

          if (airline_code_value && flight_number_value && flight_date_value) {
            $.ajax({
              url: "https://api.bhtp.com/Eligibility/Flight/Schedule",
              dataType: "json",
              type: "POST",
              data: {
                airlineCode: airline_code_value,
                departureDate: flight_date_value,
                flightNumber: flight_number_value
              },
              success: function (data) {
                remove_throbber($aac);
                var airports = data.response.length ? data.response : '';
                if (airports) {
                  var bhtp_air_code = [];

                  for (var i = 0; i < airports.length; i++) {
                    if (airports[i] && departure_airport_value) {
                      var option_departure_airport = airports[i].departureAirportCode;

                      if (option_departure_airport == departure_airport_value) {
                        bhtp_air_code.push(airports[i]);
                      }
                    }
                    else if (airports[i]) {
                      bhtp_air_code.push(airports[i]);
                    }
                  }

                  if (bhtp_air_code.length) {
                    airport_code[request_term] = bhtp_air_code;

                    response($.map(bhtp_air_code, function (item) {
                      return {
                        label: item.arrivalAirportCode,
                        departure: item.departureAirportCode,
                        arrival: item.arrivalAirportCode
                      }
                    }));
                  }

                } else {
                  $(".ui-autocomplete").hide().find("li").remove();
                  var $active = $(document.activeElement);

                  if ($aac.is($active) && !$aac.siblings(".no-result").length) {
                    show_no_result($aac);
                  }
                }
              },
              complete: function () {
                remove_throbber($aac);
              }
            });
          }
          else {
            remove_throbber($aac);
            show_no_result($aac);
          }
        },
        minLength: 1,
        select: function (event, ui) {
          event.preventDefault();
          $(this).val(ui.item.label);

          if (!(ui.item.label in airport_code))
            airport_code[ui.item.label] = [{
              label: ui.item.label,
              departure: ui.item.departureAirportCode,
              arrival: ui.item.arrivalAirportCode
            }]
        },
        focus: function (event, ui) {
          return false;
        },
        close: function (event, ui) {
          remove_throbber($aac);
          var current_request_term = $.trim($(this).val()),
            $default_airline;
          if ((current_request_term == request_term) || !current_request_term) {
            if ($active_airline_list && $active_airline_list.find("li").length && current_request_term) {
              $default_airline = $active_airline_list.find("li").eq(0);
              $(this).val($default_airline.text());
              if (!($default_airline.text() in airport_code))
                airport_code[$default_airline.text()] = [{
                  label: ui.item.label.length ? ui.item.label : '',
                  departure: ui.item.departureAirportCode,
                  arrival: ui.item.arrivalAirportCode
                }]
            } else {
              $(this).val('');
            }
          }
        }

      });
    });

    $flights.on("input", ".airline, .departure-airport-code, .arrival-airport-code", function () {
      remove_no_result($(this));
    });

    $flights.once().on("blur", ".airline, .departure-airport-code, .arrival-airport-code", function () {
      var $this = $(this),
        value = $.trim($this.val());
      if ($this.hasClass("ui-autocomplete-input")) {
        $this.autocomplete("close");
      }

      if (value && value.length) {

        if (($this.is($airlines) && (jQuery.isEmptyObject(providers) || !providers.hasOwnProperty(value))) ||
        (($this.is($departure_airport_code) || $this.is($arrival_airport_code)) && (jQuery.isEmptyObject(airport_code) || !airport_code.hasOwnProperty(value)))) {
          $this.val('');
          $(this).addClass('error');
        }
      }

      if ($(this).siblings(".no-result").length) {
        remove_no_result($(this));
        $(this).addClass('error');
        $(this).val('');
      }
    });

    $flights.once('flight').on("change", ".flight-date select, .airline, .flight-number", function () {
      var $this = $(this),
        $flight_row = $this.parents('.atj-insurance-flight-row'),
        $departure_airport_code = $flight_row.find('.departure-airport-code');
        $arrival_airport_code = $flight_row.find('.arrival-airport-code');

      $departure_airport_code.val('');
      $arrival_airport_code.val('');
    });

    $flight_number.on('input', function () {
      this.value = this.value.replace(/[^\d]/g, "");
    });

    $departure_airport_code.on("blur", function () {
      if ($(this).val()) {
        this.value = this.value.toLocaleUpperCase();
      }
    });

    $arrival_airport_code.on("blur", function () {
      if ($(this).val()) {
        this.value = this.value.toLocaleUpperCase();
      }
    });

    function show_throbber($element) {
      var throbber = '<div class="ajax-progress ajax-progress-throbber"><div class="throbber">&nbsp;</div></div>';
      $element.after(throbber);
    }

    function remove_throbber($element) {
      $element.siblings(".ajax-progress-throbber").remove();
    }

    function show_no_result($element) {
      var no_result = '<div class="no-result">No search result.</div>';
      $element.after(no_result);
    }

    function remove_no_result($element) {
      $element.siblings(".no-result").remove();
    }

    function validate_empty($element) {
      if ($element.length) {
        if ($element.val()) {
          $element.removeClass('error');
        }
        else {
          $element.addClass('error');
        }
      }
    }
  }

  function form_attach_remove_flight_handler($form) {
    var $remove_btn = $form.find('.remove-flight');

    $remove_btn.once('remove-btn').click(function () {
      var number = $(this).data('flight-row-number');
      if (number > 1) {
        $(this).closest('.atj-insurance-flight-row').remove();
      }

      Drupal.attachBehaviors();
    });
  }

  function form_attach_optional_coverages($form, package) {
    var $ec_fau = $form.find('.' + package + '--optional-coverages--fau-oc'),
      $ec_fau_coverage_limit = $form.find('.' + package + '--oc--fau--coverage-limit'),
      ec_fau_coverage_limit_value = $ec_fau_coverage_limit.val(),
      $ec_fau_checkbox = $form.find('input.' + package + '--oc--fau'),

      $ec_crcc = $form.find('.' + package + '--optional-coverages--crcc-oc'),
      $ec_crcc_checkbox = $form.find('input.' + package + '--oc--crcc'),
      $ec_crcc_car_fields = $form.find('[class^="' + package + '--oc--crcc--"]'),
      $ec_crcc_date_from = $form.find('.' + package + '--oc--crcc--pickup-date-from'),
      $ec_crcc_date_to = $form.find('.' + package + '--oc--crcc--pickup-date-to');


    $ec_fau_coverage_limit.once().change(function () {
      $ec_fau_checkbox.trigger("change");
    });

    $ec_crcc_car_fields.once().each(function (index) {
      $(this).change(function () {
        var crcc_error = false;

        $ec_crcc_car_fields.each(function () {
          if (!$(this).val()) {
            $(this).addClass('error');
            crcc_error = true;
          }
          else {
            $(this).removeClass('error');
          }
        }).promise().done(function () {
          if (!crcc_error) {
            setTimeout(function () {
              $ec_crcc_checkbox.trigger("change");
            }, 500);
          }
        });
      });
    });
  }

  var Messages = {
    max_cost: Drupal.t("Trip Cost should be less than or equal to $100,000 per person."),
  };

  function form_validate($form, settings) {
    var $trip_cost = $form.find('input[id*="trip-cost"]'),
      $ages = $form.find('.atj-insurance-travelers-row input'),
      travelers_amount = settings.atj_insurance.travelers_amount;

    $trip_cost.once().keyup(field_contain_only_numbers);
    $ages.once('ages-once').keyup(field_contain_only_numbers);

    $form.validate({
      rules: {
        'submitted[select_a_destination][trip_cost]': {
          required: true,
          valid_cost: true
        },
        'submitted[travelers_layout][travelers][policyholder][ph_trip_cost]': {
          required: true,
          valid_cost: true
        }
      },
      messages: {
        'submitted[select_a_destination][trip_cost]': {
          valid_cost: Messages.max_cost
        },
        'submitted[travelers_layout][travelers][policyholder][ph_trip_cost]': {
          valid_cost: Messages.max_cost
        }
      },
      errorPlacement: function (error, element) {
        if ((element.attr('name') === 'submitted[select_a_destination][trip_cost]') &&
          (error.text() == Messages.max_cost)) {
          error.insertAfter(element)
        }
        else
          error.appendTo(".page-node-205 .messages");
      }
    });

    for (var i = 2; i <= travelers_amount; i++) {
      var $travelers_trip_cost = $form.find('input[name*="[traveler_' + i + '][traveler_trip_cost]"]');
      if ($travelers_trip_cost.length) {
        $travelers_trip_cost.rules( "add", {
          valid_cost: true
        });
      }
    }
  }

  $.validator.addMethod("valid_cost", function (value, element, params) {
    return less_than_max_cost(value);
  }, jQuery.validator.format(Messages.max_cost));


  function less_than_max_cost(value) {
    var tripCost = parseInt(value.replace(/[^\d]/g, '')),
      numberOfTraveller = 0;
    $('.atj-insurance-travelers-row input').each(function () {
      var $this = $(this);
      if ($this.val() !== '')
        numberOfTraveller += 1;
    });
    if (!numberOfTraveller) {
      numberOfTraveller = 1;
    }

    return (tripCost <= (1e5 * numberOfTraveller));
  }

  function field_contain_only_numbers() {
    var $this = $(this),
      number = $this.val();
    number = number.replace(/[^\d]/g, '');
    $this.val(number);
  }

}(jQuery));
