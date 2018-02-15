<?php $title = 'DownloadTailoredPlanner'; ?>
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
              <img src="theme/images/titles/title-itinerary.png" alt=""/>
              <span>ITINERARY</span>
            </h1>
            <h5>Download your small group trip</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="form form-type-a">
        <div class="form-caption">
          <div class="img"><img src="theme/images/tmp/tmp-img-5.png" alt=""/></div>
          <div class="caption">
            <h4>Download your SMALL
              GROUP TRIP ITINERARY</h4>
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
        <div class="form-item form-type-textarea">
          <label><span class="form-required">*</span> How did you hear about our Asia Transpacific Journeys? (If referral, please note name.)</label>
          <textarea class="form-textarea"></textarea>
        </div>
        <div class="form-item form-type-textarea">
          <label><span class="form-required">*</span> Comments</label>
          <textarea class="form-textarea"></textarea>
        </div>
        <div class="form-item form-type-desc">
          <label><span class="form-required">*</span> Required Field</label>
        </div>
        <div class="form-item form-type-checkbox">
          <input class="form-checkbox" type="checkbox" name="checkbox" checked="checked" />
          <label class="option">Yes, I would like to receive announcements via email of adventures and specials offers.</label>
        </div>
        <div class="form-actions">
          <input type="submit" class="form-submit" value="submit"/>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>