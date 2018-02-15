<?php $title = 'ContactUs'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-img-21.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-img-21.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-on-your-way.png" alt=""/>
              <span>PARTNERS</span>
            </h1>
            <h5>We’ll get you</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="b-cols">
        <div class="row">
          <div class="col col-md-8">
            <h4 class="rtecenter">READY TO BOOK YOUR TRIP?</h4>
            <p class="rtecenter">We’re here to get you on your way! For personalized assistance developing a customized itinerary, or for general questions, we’re a phone call or email away. </p>
          </div>
        </div>
      </div>
      <div class="b-contact">
        <div class="col-row">
          <div class="col">
            <span class="sub-title">TOLL FREE</span>
            <a class="link" href="tel:8006422742">800-642-2742 <span class="ico ss-icon ss-glyphish-outlined ss-phone"></span></a>
          </div>
          <div class="col">
            <span class="sub-title">LOCAL</span>
            <a class="link" href="tel:3034436789">303-443-6789 <span class="ico ss-icon ss-glyphish-outlined ss-phone"></span></a>
          </div>
          <div class="col">
            <span class="sub-title">FAX</span>
            <a class="link" href="tel:3034437078">303-443-7078 <span class="ico ss-icon ss-glyphish-outlined ss-print"></span></a>
          </div>
        </div>
        <div class="col-row">
          <div class="col">
            <span class="sub-title">MONDAY - FRIDAY</span>
            <span class="sub-title-2">7:30AM - 5:30PM (MST) <span class="ico ss-icon ss-glyphish-outlined ss-clock"></span></span>
          </div>
        </div>
      </div>
      <div class="form form-contact">
        <div class="pull-center"><div class="form-title">EMAIL US <div class="ico ss-icon ss-glyphish-outlined ss-mail"></div></div></div>
        <div class="row">
          <div class="form-item form-type-select col-sm-5">
            <label><span class="form-required">*</span> I am a</label>
            <select class="form-select">
              <option selected>SELECT ONE</option>
              <option>SELECT ONE</option>
              <option>SELECT ONE</option>
              <option>SELECT ONE</option>
            </select>
          </div>
          <div class="form-item form-type-text col-sm-7">
            <label><span class="form-required">*</span> Name</label>
            <input type="text" class="form-text">
          </div>
        </div>
        <div class="form-item form-type-text">
          <label><span class="form-required">*</span> Email Address</label>
          <input type="text" class="form-text">
        </div>
        <div class="form-item form-type-textarea">
          <label>How did you hear about us?</label>
          <textarea class="form-textarea"></textarea>
        </div>
        <div class="form-item form-type-textarea">
          <label>Message</label>
          <textarea class="form-textarea"></textarea>
        </div>
        <div class="form-actions">
          <input type="submit" class="form-submit" value="submit">
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>