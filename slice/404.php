<?php $title = '404'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-img-23.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-img-23.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-territory.png" alt=""/>
              <span>TERRITORY</span>
            </h1>
            <h5>You’re in uncharted</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="b-cols">
        <div class="row">
          <div class="col col-md-8">
            <h4 class="rtecenter">WHOOPS!</h4>
            <p class="rtecenter">Looks like even we don’t know where the page you’re trying to reach is.</p>
            <br/><p class="rtecenter"><a class="link type-read-more style-red ss-icon ss-standard ss-navigateright" href="#">HEAD BACK HOME</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>