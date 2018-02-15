<?php $title = 'TripPaymentSuccessful'; ?>
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
        <div class="success">
          <h4>THANK YOU FOR YOUR PAYMENT</h4>
          <div class="b-cols">
            <div class="row pull-center">
              <div class="col col-sm-12">
                <p>You should receive a confirmation email shortly.</p>
                <p>If you have trouble submitting payment wiht this form, please contact Jessican Durham in our accounting department directly: 800.642.2742 ext: 221 or jessica@atj.com. We apologize for the inconvenience.</p>
              </div>
            </div>
          </div>
          <div class="b-cols">
            <div class="row">
              <div class="col col-sm-12">
                <h6>TRAVEL INSURANCE</h6>
                <p>Please note that the cost of your trip does not include trip cancellation insurance. However, we highly recommend that you purchase this additional coverage. If you book your insurance through our recommended provider, Travel Insurance Select, and would like any pre-existing conditions covered, your policy must be purchased within 14 days of confirmation. Other carriers may have terms for pre-existing conditions.
                  <a href="#">Learn More</a>.</p>
                <p>If you already purchased travel insurance, but your trip cost has changed since the original purchase, you MUST advise your insurance company immediately of the new trip cost to remain eligible for full coverage.</p>
                <h6>Visas & passports</h6>
                <p>It is your responisibility to obtain any applicable visas for your upcoming trip, as well as make sure you have a valid passport.
                  <a href="#">Learn More</a>.</p>
              </div>
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