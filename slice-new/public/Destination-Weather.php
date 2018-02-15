<!DOCTYPE html>
<html>
<?php $title = 'Destination-Weather'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page without-parallax">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section section-top">
      <div class="bg">
        <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-10.jpg');"></div>
      </div>
      <div class="container">
        <div class="inner-wrap">
          <div class="title-wrap">
            <h1>india</h1>
          </div>
          <div class="desc">
            <p>Colorful. Mystical. Dynamic.</p>
          </div>
        </div>
      </div>
    </section>
    <div class="section section-navigation">
      <div class="container">
        <div class="navigation">
          <ul>
            <li class="ico-overview"><a href="#">Overview</a></li>
            <li class="ico-regions"><a href="#">Regions</a></li>
            <li class="ico-accommodations"><a href="#">Accommodations</a></li>
            <li class="ico-weather active"><a href="#">Weather</a></li>
            <li class="ico-group-trips"><a href="#">Group Trips</a></li>
            <li class="ico-tailored-trips"><a href="#">Custom Trips</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="content-wrapper container">
      <h2>
        HOW’S THE WEATHER?
      </h2>
      <div class="b-chart">
        <div class="chart-wrap">
          <div class="chart" data-data="257,med;290,med;250,med,popular;220,med,popular"></div>
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

      <div class="b-container container-with-56">
        <h2>FORECAST</h2>
        <p>Papua New Guinea weather is warm and sultry year round, with wet and dry seasons typical of the region. The best time to travel is from June through October. During this summer dry season expect some rainfall along with plenty of sunshine. In the coastal areas daytime temperatures range from 75 degrees F to 85 F. In the highlands, daytime temperatures will be in the 75 degrees F range. Nighttime temperatures in the highlands can go as low as 45 degrees F. Expect torrential rains December through April.</p>

        <div class="btn-contact-expert">
          <p>Questions? Ready to start planning your trip?</p>
          <div class="btn">
            <a class="link style-burgundy" href="#">Contact an india travel expert</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>