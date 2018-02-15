<?php $title = 'EmailUpdates'; ?>
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
              <img src="theme/images/titles/title-atj.png" alt=""/>
              <span>ATJ</span>
            </h1>
            <h5>Keeping up with</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="form form-type-a">
        <h4>EMAIL UPDATES</h4>
        <div class="b-cols">
          <div class="row">
            <div class="col col-md-12">
              <p>Sign up to receive emails highlighting the incredible countries in our region, what we love about them and why we find them so fascinating. We'll also keep you updated on unique, not to be missed departures such as trips led by the World Wildlife Fund and unique Custom Journeys ideas. To receive these beyond-the-ordinary E-Newsletters, please fill out the sign-up form below.</p>
            </div>
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
            <label><span class="form-required">*</span> Email</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-6">
            <label>Agency Name</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
        <div class="form-item form-type-desc">
          <label><span class="form-required">*</span> Required Field</label>
        </div>
        <div class="form-item form-type-checkbox">
          <input class="form-checkbox" type="checkbox" name="checkbox" checked="checked" />
          <label class="option">Yes, I would like to receive announcements via email of new adventures and special offers, as well as information on the unique cultural, culinary, historic and geographic features of countries throughout the Asia Pacific region.</label>
        </div>
        <div class="form-actions">
          <input type="submit" class="form-submit" value="submit"/>
        </div>
        <div class="pull-center"><a class="link style-red" href="#"><i>Privacy Policy</i></a></div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>