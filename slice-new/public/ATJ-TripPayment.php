<!DOCTYPE html>
<html>
<?php $title = 'ATJ-TripPayment'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section section-top">
      <div class="bg">
        <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-6.jpg');"></div>
      </div>
      <div class="container">
        <div class="inner-wrap">
          <div class="title-wrap">
            <h1>on your way</h1>
          </div>
        </div>
      </div>
    </section>

    <div class="content-wrapper container">
        <h2>MAKE A TRIP PAYMENT</h2>
        <div class="b-container container-with-43 container-style-a">
          <p>
            Please enter the following information to make either an initial trip deposit or a subsequent payment for your upcoming trip. We accept Visa, MasterCard and American Express. If you have any questions about your payment please email us directly at <a href="mailto:payment@atj.com">payment@atj.com </a> or call us at <a href="tel:1-800-642-2742">1-800-642-2742</a>.
          </p>
        </div>

      <div class="br-line-ico">
      </div>

      <div class="form form-type-a">
        <div class="row">
          <div class="form-item form-type-text col-sm-6">
            <label><span class="form-required">*</span> Itinerary ID (From invoice or use DEPOSIT)</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-6">
            <label><span class="form-required">*</span> Payment Amount (USD - Example: $x,xxx.xx)</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
        <div class="row">
          <div class="form-item form-type-text col-sm-6">
            <label><span class="form-required">*</span> First Name</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-6">
            <label><span class="form-required">*</span> Last Name</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
        <div class="row">
          <div class="form-item form-type-text col-sm-6">
            <label><span class="form-required">*</span> Billing Address Line 1</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-6">
            <label><span class="form-required">*</span> Billing Address Line 2</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
        <div class="row">
          <div class="form-item form-type-text col-sm-3">
            <label><span class="form-required">*</span> City</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-3">
            <label><span class="form-required">*</span> Country</label>
            <select class="form-select">
              <option selected>Country</option>
              <option>Country</option>
              <option>Country</option>
              <option>Country</option>
            </select>
          </div>
          <div class="form-item form-type-text col-sm-3">
            <label><span class="form-required">*</span> State</label>
            <select class="form-select">
              <option selected>State</option>
              <option>State</option>
              <option>State</option>
              <option>State</option>
            </select>
          </div>
          <div class="form-item form-type-text col-sm-3">
            <label><span class="form-required">*</span> Zip/Potal Code</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
        <div class="row">
          <div class="form-item form-type-text col-sm-4">
            <label><span class="form-required">*</span> Phone</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-4">
            <label><span class="form-required">*</span> Email</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-4">
            <label><span class="form-required">*</span> Confirm Email</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
        <div class="row">
          <div class="form-item form-type-text col-sm-5">
            <label><span class="form-required">*</span> Credit Card (No dashes or spaces)</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item field-expiration-date col-sm-5">
            <label><span class="form-required">*</span> Expiration Date</label>
            <div class="row">
              <div class="form-item form-type-text col-sm-7">
                <select class="form-select">
                  <option selected>January</option>
                  <option>January</option>
                  <option>January</option>
                  <option>January</option>
                </select>
                <span class="field-suffix">/</span>
              </div>
              <div class="form-item form-type-text col-sm-5">
                <select class="form-select">
                  <option selected>2016</option>
                  <option>2016</option>
                  <option>2016</option>
                  <option>2016</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-item form-type-text col-sm-2">
            <label><span class="form-required">*</span> CVV2</label>
            <input type="text" class="form-text"/>
            <div class="pull-center"><a href="#popup-cvv-whats-this">What’s This?</a></div>
          </div>
        </div>
        <div class="form-item form-type-textarea">
          <label>Comments</label>
          <textarea class="form-textarea"></textarea>
        </div>
        <div class="form-item form-type-checkbox">
          <input class="form-checkbox" type="checkbox" name="checkbox" checked="checked" />
          <label class="option">* I have read and agreed to the
            Terms & Conditions.</label>
        </div>
        <div class="form-bottom-text">
          <p>Please note that your credit card will be processed immediately upon clicking 'Make Payment'. Please do not click the Make Payment button twice or use your browser's 'back' or 'refresh' button while your transaction is being processed.
          </p>
          <p>If you have trouble submitting your payment with this form, please contact Stephanie Nix in our accounting department directly: <a href="tel:800-642-2742">800-642-2742</a> ext. 221 or <a href="mailto:stephanie@atj.com">stephanie@atj.com</a>. </p>
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
            <input type="submit" class="form-submit" value="MAKE PAYMENT"/>
          </div>
        </div>
        <div class="pull-center"><a class="link style-red" href="#"><i>Privacy Policy</i></a></div>
       </div>


    </div>
    <section class="section section-planning style-a">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="inner-content">
                  <h2>ITINERARIES AT
                    YOUR FINGERTIPS</h2>
                  <div class="text">
                    <p>Spend less time planning and more time seeing. We’ll get you on your way.</p>
                  </div>
                  <div class="btn">
                    <a class="link style-burgundy" href="#">DOWNLOAD CUSTOM TRIP PLANNER</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="bg" style="background-image: url('theme/images/tmp/planning-tmp-img-1.jpg');">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="inner-content">
                  <h2>THE NEW 2018
                    CATALOG IS HERE</h2>
                  <div class="text">
                    <p>An award-winning collection of beautifully crafted Group Trips to Asia</p>
                  </div>
                  <div class="btn">
                    <a class="link style-burgundy" href="#">VIEW OUR 2018 CATALOG</a>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="bg" style="background-image: url('theme/images/tmp/planning-tmp-img-2.jpg');">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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