<?php $title = '04-Turkey_Weather'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top">
      <div class="bg">
        <div class="clip-path-img-top">
          <div class="bg-img" style="background-image: url('theme/images/tmp/turkey-section-top-img.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/turkey-section-top-img.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-turkey.png" alt=""/>
              <span>TURKEY</span>
            </h1>
            <h5>The crossroads of continents</h5>
          </header>
          <div class="navigation">
            <ul>
              <li class="ico-overview"><a href="#">Overview</a></li>
              <li class="ico-regions"><a href="#">Regions</a></li>
              <li class="ico-accommodations"><a href="#">Accommodations</a></li>
              <li class="ico-weather active"><a href="#">Weather</a></li>
              <li class="ico-group-trips"><a href="#">Group Trips</a></li>
              <li class="ico-tailored-trips"><a href="#">Tailored Trips</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <div class="content-wrapper container">
      <div class="b-chart">
        <h2>
          <img src="theme/images/titles/title-climate.png" alt=""/>
          <span>Climate</span>
        </h2>
        <div class="chart-wrap">
          <div class="chart" data-data="200,med,popular;303,low;210,med,popular;60,med"></div>
          <div class="axis y">
            <span class="i"><span class="text">HOT</span></span>
            <span class="i"><span class="text">WARM</span></span>
            <span class="i"><span class="text">COOL</span></span>
            <span class="i"><span class="text">COLD</span></span>
          </div>
          <div class="axis x">
            <span class="i"><span class="text">Spring</span></span>
            <span class="i"><span class="text">Summer</span></span>
            <span class="i"><span class="text">Autumn</span></span>
            <span class="i"><span class="text">Winter</span></span>
          </div>
        </div>
        <div class="legend-wrapper">
          <div class="left-part">
            <span class="title">PRECIPITATION</span>
            <span class="legend-item ico-low">LOW</span>
            <span class="legend-item ico-med">MED</span>
            <span class="legend-item ico-high">HIGH</span>
          </div>
          <div class="right-part">
            <span class="title">MOST POPULAR TRAVEL TIME</span>
            <span class="ico ico-popular"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>