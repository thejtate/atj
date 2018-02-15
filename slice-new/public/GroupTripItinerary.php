<!DOCTYPE html>
<html>
<?php $title = 'GroupTripItinerary'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page">
<div class="outer-wrapper">
<?php include 'tpl/layout/header.inc'; ?>
<div class="inner-wrapper">
<section class="section section-top">
  <div class="bg">
    <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-16.jpg');"></div>
  </div>
  <div class="container">
    <div class="inner-wrap">
      <div class="title-wrap">
        <h1>fun for everyone</h1>
      </div>
      <div class="desc">
        <p>Your Group Trip Itinerary awaits.</p>
      </div>
    </div>
  </div>
</section>

<div class="content-wrapper container">
  <div class="form form-type-a">
    <div class="form-caption">
      <div class="img"><img src="theme/images/tmp/n-tmp-img-5.png" alt=""/></div>
      <div class="caption">
        <h4>Download your GROUP TRIP ITINERARY</h4>
        <p>Please complete the following form. You should only need to enter your information once in order to download and view any of the itineraries on our site.</p>
      </div>
    </div>
    <div class="row">
      <div class="form-item form-type-text col-sm-4">
        <label><span class="form-required">*</span> First Name</label>
        <input type="text" class="form-text"/>
      </div>
      <div class="form-item form-type-text col-sm-4">
        <label><span class="form-required">*</span> Last Name</label>
        <input type="text" class="form-text"/>
      </div>
      <div class="form-item form-type-text col-sm-4">
        <label><span class="form-required">*</span> Email</label>
        <input type="text" class="form-text"/>
      </div>
    </div>
    <div class="form-item webform-component webform-component-radios webform-component--have-you-worked-with-atj-before">
      <label for="edit-submitted-have-you-worked-with-atj-before"><span class="form-required" title="This field is required.">*</span> Have you worked with ATJ before?</label>
      <div id="edit-submitted-have-you-worked-with-atj-before" class="form-radios"><div class="form-item form-type-radio form-item-submitted-have-you-worked-with-atj-before">
          <input required="required" type="radio" id="edit-submitted-have-you-worked-with-atj-before-1" name="submitted[have_you_worked_with_atj_before]" value="yes" class="form-radio">  <label class="option" for="edit-submitted-have-you-worked-with-atj-before-1"> Yes</label>

        </div>
        <div class="form-item form-type-radio form-item-submitted-have-you-worked-with-atj-before">
          <input required="required" type="radio" id="edit-submitted-have-you-worked-with-atj-before-2" name="submitted[have_you_worked_with_atj_before]" value="no" class="form-radio">  <label class="option" for="edit-submitted-have-you-worked-with-atj-before-2"> No</label>

        </div>
      </div>
    </div>
    <div class="form-item form-type-textarea">
      <label><span class="form-required">*</span> How did you hear about our Asia Transpacific Journeys? (If referral, please note name.)</label>
      <textarea class="form-textarea"></textarea>
    </div>
    <div class="form-item form-type-textarea">
      <label><span class="form-required">*</span> Comments</label>
      <textarea class="form-textarea"></textarea>
    </div>
    <div class="form-item form-type-checkbox">
      <input class="form-checkbox" type="checkbox" name="checkbox" checked="checked" />
      <label class="option">Yes, I would like to receive announcements via email of new adventures and special offers, as well as information on the unique cultural, culinary, historic and geographic features of countries throughout the Asia Pacific region.</label>
    </div>
    <fieldset class="captcha form-wrapper"><legend><span class="fieldset-legend">CAPTCHA</span></legend><div class="fieldset-wrapper"><div class="fieldset-description"> </div><input type="hidden" name="captcha_sid" value="12">
        <input type="hidden" name="captcha_token" value="ece7697f0702740a327968e71ac2b35b">
        <img src="/funnelcaptcha?sid=12&amp;ts=1476270602" width="180" height="60" alt="Funnel CAPTCHA" title="Funnel CAPTCHA"><div class="reload-captcha-wrapper"><a href="/funnel/captcha/refresh/webform_client_form_22" class="funnel-reload-captcha">Generate a new captcha</a></div><div class="form-item form-type-textfield form-item-captcha-response">
          <label for="edit-captcha-response"><span class="form-required" title="This field is required.">*</span> Enter the characters shown in the image.</label>
          <input type="text" id="edit-captcha-response" name="captcha_response" value="" size="15" maxlength="128" class="form-text required" autocomplete="off">
        </div>
        <div class="form-item form-type-textfield form-item-left-param">
          <input id="left_param" style="display: none;" type="text" name="left_param" value="" size="60" maxlength="128" class="form-text">
        </div>
        <div class="form-item form-type-textfield form-item-human-token">
          <input id="human_token" style="display: none;" type="text" name="human_token" value="" size="60" maxlength="128" class="form-text">
        </div>
      </div></fieldset>
    <div class="form-actions">
      <div class="form-submit-wrapper">
        <input type="submit" class="form-submit" value="SUBMIT"/>
      </div>
    </div>
    <div class="form-item form-type-desc">
      <label><span class="form-required">*</span> Required</label>
    </div>
  </div>


</div>
</div>
<?php include 'tpl/layout/footer.inc'; ?>

<div class="b-modal modal fade style-wight" id="popup-cvv-whats-this" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close close-btn" data-dismiss="modal" aria-hidden="true">+</a>
      </div>
      <div class="modal-body">
        <div class="field field-name-field-wtp-cvv2-info field-type-text-long field-label-hidden">
          <div class="field-items">
            <div class="field-item even">
              <p>
                <img alt="" height="70" src="theme/images/tmp//tmp-logo-1_0.png" width="132"/>
              </p>
              <p>
                <a href="#" target="_blank">www.atj.com</a>
              </p>
              <h4>CVV2 - What's This?</h4>
              <p>
                For <strong>Visa and MasterCard</strong>
                , the CVV, or Card Verification Number is a 3 digit number found on the back of your card in the signature area. Your card number should be printed here along with a three-digit number at the end. (Some newer credit cards only show the last four digits of the credit card number on the back, followed by the CVV number.)
              </p>
              <p>
                For <strong>American Express</strong>
                cards, the CVV is a 4 digit number printed above and to the right of the imprinted card number on the front of your card.
              </p>
              <p>CVV, or Card Verification Number, is an authentication mechanism created by card companies to help reduce fraud with online transactions. It requires the card holder to have the card physically in hand in order to enter three or four digits found printed on the card itself. The CVV is a number that is printed, not imprinted, on your Visa, MasterCard or American Express. This number is never transferred during card swipes and should only be known by you, the cardholder.</p>
              <table border="0">
                <tbody>
                <tr>
                  <td>
                    <p>
                      <strong>For Visa/Mastercard</strong>
                      <br/>
                      <img alt="Visa-MC CVV" height="115" src="theme/images/tmp/cvv2visa.gif" width="185"/>
                    </p>
                  </td>
                  <td>
                    <p>
                      <strong>For American Express</strong>
                      <br/>
                      <img alt="Amex CVV" height="115" src="theme/images/tmp/cvv2amex.gif" width="185"/>
                    </p>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>