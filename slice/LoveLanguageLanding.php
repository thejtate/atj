<?php $title = 'LoveLanguageLanding'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top">
      <div class="bg">
        <div class="clip-path-img-top">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-12.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-top-img-12.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice"  data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="share-block">
          <a class="btn" href="#"><span class="ico ss-icon ss-glyphish-outlined ss-action"></span>Share</a>
          <div class="social-menu">
            <ul>
              <li><a href="#"><span class="ico ss-icon ss-social-regular ss-facebook"></span></a></li>
              <li><a href="#"><span class="ico ss-icon ss-social-regular ss-twitter"></span></a></li>
              <li><a href="#"><span class="ico ss-icon  ss-standard ss-mail"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-love-language.png" alt=""/>
              <span>Love language</span>
            </h1>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="b-cols">
        <div class="row">
          <div class="col col-md-9">
            <h4 class="rtecenter">SHARE YOUR LOVE LANGUAGE WITH SOMEONE SPECIAL</h4>
            <p class="rtecenter">Starting February 1st all the way thru Febrary 14th, every day we’ll send a person of your choosing an email saying “I love you” in a different Asian language. Just fill out the form below and we’ll do the rest!</p>
          </div>
        </div>
      </div>
      <div class="form form-love-language">
        <div class="img"><img src="theme/images/tmp/img-love.png" alt=""></div>
        <div class="inner-form">
          <div class="form-item">
            <label><span class="form-required">*</span> Name of the person you’re sending this to</label>
            <div class="row">
              <div class="form-item form-type-text col-sm-8">
                <input type="text" class="form-text"/>
              </div>
              <div class="form-item form-type-select col-sm-4">
                <select class="form-select">
                  <option selected>GENDER</option>
                  <option>GENDER</option>
                  <option>GENDER</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-item form-type-text col-sm-12">
              <label><span class="form-required">*</span> Their email address</label>
              <input type="text" class="form-text"/>
            </div>
          </div>
          <div class="form-item">
            <label><span class="form-required">*</span> Who it’s from (that’s you!)</label>
            <div class="row">
              <div class="form-item form-type-text col-sm-8">
                <input type="text" class="form-text"/>
              </div>
              <div class="form-item form-type-select col-sm-4">
                <select class="form-select">
                  <option selected>GENDER</option>
                  <option>GENDER</option>
                  <option>GENDER</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-item form-type-text col-sm-12">
              <label><span class="form-required">*</span> Your email address</label>
              <input type="text" class="form-text"/>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <input type="submit" class="form-submit" value="Submit"/>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>