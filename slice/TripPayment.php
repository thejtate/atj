<?php $title = 'TripPayment'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-10.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-top-img-10.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-payment.png" alt=""/>
              <span>PAYMENT</span>
            </h1>
            <h5>Trip</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="form form-type-a">
        <div class="b-cols">
          <div class="row">
            <div class="col col-md-12">
              <h4 class="rtecenter">MAKE A TRIP PAYMENT</h4>
              <p>If you have trouble submitting your payment with this form, please contact Jessica Durham in our accounting department directly: 800-642-2742 ext. 221 or jessica@atj.com. We apologize for the inconvenience.</p>
              <p>Please enter the following information to make either an initial trip deposit or a subsequent payment for your upcoming trip. We accept Visa, MasterCard and American Express. If you have any questions about your payment please email us directly at payment@asiatranspacific.com or call us at 1-800-642-2742.</p>
            </div>
          </div>
        </div>
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
            <div class="pull-center"><a href="#">What’s This?</a></div>
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
        <div class="form-actions">
          <input type="submit" class="form-submit" value="MAKE PAYMENT"/>
        </div>
        <div class="pull-center"><a class="link style-red" href="#"><i>Privacy Policy</i></a></div>
        <div class="b-cols">
          <div class="row">
            <div class="col col-sm-6">
              <p>Please note that your credit card will be processed immediately upon clicking 'make a payment'.   Please do not use your browser 'back' or 'refresh' button while your transaction is being processed.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>