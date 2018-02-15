<?php $title = '04_brandingkit'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-img-20.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-img-20.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-partners.png" alt=""/>
              <span>PARTNERS</span>
            </h1>
            <h5>Our loyal</h5>
          </header>
          <div class="navigation">
            <div class="form form-pick-list">
              <div class="form-item form-type-select">
                <select class="form-select">
                  <option>SUPPLIER & TOUR LEADER INFO</option>
                  <option>GETTING TO KNOW US</option>
                  <option>BRANDING KIT</option>
                  <option selected>LOGOS</option>
                  <option>EMERGENCY PROCEDURES</option>
                  <option>SUPPLIER INFORMATION</option>
                  <option>GUIDE TRAINING</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="b-cols">
        <div class="row">
          <div class="col col-md-8">
            <h4 class="rtecenter">LOGOS</h4>
            <p>We have created PDFs of commonly used signage and materials, which can be found in our Branding Kit. Should you need to create any additional materials, please use the following logos.</p>
            <p>In general, a png or jpg file should work for most uses.</p>
            <br/>
            <ul class="inline-list with-images">
              <li>
                <div class="logo-img"><img src="theme/images/tmp/tmp-logo-atj.png" alt=""/></div>
                <a class="link type-download" href="#">Download PNG <span class="ico ss-icon ss-glyphish-filled ss-download"></span></a>
              </li>
              <li>
                <div class="logo-img"><img src="theme/images/tmp/tmp-logo-atj-1.png" alt=""/></div>
                <a class="link type-download" href="#">Download PNG <span class="ico ss-icon ss-glyphish-filled ss-download"></span></a>
              </li>
              <li>
                <div class="logo-img"><img src="theme/images/tmp/tmp-logo-atj-2.png" alt=""/></div>
                <a class="link type-download" href="#">Download JPG <span class="ico ss-icon ss-glyphish-filled ss-download"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>