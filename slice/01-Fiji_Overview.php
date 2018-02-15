<?php $title = '01-Fiji_Overview'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top">
      <div class="bg">
        <div class="clip-path-img-top">
          <div class="bg-img" style="background-image: url('theme/images/tmp/fiji-section-top-img.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/fiji-section-top-img.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-fiji.png" alt=""/>
              <span>FIJI</span>
            </h1>
            <h5>Splendid</h5>
          </header>
          <div class="navigation">
            <ul>
              <li class="ico-overview active"><a href="#">Overview</a></li>
              <li class="ico-regions"><a href="#">Regions</a></li>
              <li class="ico-accommodations"><a href="#">Accommodations</a></li>
              <li class="ico-weather"><a href="#">Weather</a></li>
              <li class="ico-group-trips"><a href="#">Group Trips</a></li>
              <li class="ico-tailored-trips"><a href="#">Tailored Trips</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="section type-after-top section-region">
      <div class="bg">
        <div class="clip-path-region">
          <div class="bg-img" style="background-image: url('theme/images/tmp/fiji-section-img.jpg');"
               data-bottom-top="transform:translate3d(0px, -150px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%" >
          <g clip-path="url(#clip-path-region)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/fiji-section-img.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-bottom-top="@transform:translate(0, -150)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <div class="desc-region">
            <div class="map"><img src="theme/images/maps/map-fiji.png" alt=""/></div>
            <h4>NOT YOUR GARDEN-VARIETY PARADISE</h4>
            <div class="text">
              <p>White sand, warm trade winds and blue water stretching to the horizon; Fiji keeps the South Pacific promise then goes beyond the languid allure. Its many islands offer a compelling melting pot of multiple cultures, with a strong current of traditional Melanesian. Take part in Fiji luxury tours and adventures ranging from sea kayaking to highland hikes, and discover a highly developed eco-tourism infrastructure that emphasizes respect for its ecological treasures.</p>
            </div>
            <a class="link type-read-more style-red" href="#">GET YOUR CUSTOM ITENERARY <span class="ico ss-icon ss-standard ss-navigateright"></span></a>
          </div>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="b-table">
        <table>
          <tr>
            <td colspan="2">
              <h4>TWO WAYS TO TRAVEL</h4>
            </td>
            <td rowspan="2">
              <p>Join like-minded fellow travelers on a perfectly crafted small group trip with <a href="#">Australia luxury tours</a>. Or to create your own personalized, private custom journey to Australia for just you, your family and friends see the possibilities at
                <a href="#">Australia Custom Trip</a>.</p>
            </td>
          </tr>
          <tr>
            <td><div class="subtitle"><span class="ico ss-icon ss-glyphish-outlined ss-usergroup"></span> Group Trips</div></td>
            <td><div class="subtitle"><span class="ico ss-icon ss-glyphish-outlined ss-connection"></span> Tailored Trips</div></td>
          </tr>
        </table>
      </div>
      <h2>
        <img src="theme/images/titles/title-closer-look.png" alt=""/>
        <span>A CLOSER LOOK</span>
      </h2>
      <div class="b-photos">
        <div class="block-bg" style="background-image: url('theme/images/tmp/australia-b-photo-bg.jpg');"></div>
        <div class="items">
          <div class="item style-block-photo type-square">
            <div class="bg"><img src="theme/images/tmp/fiji-photo-1.jpg" alt=""/></div>
          </div>
          <div class="item style-block-photo type-half">
            <div class="bg"><img src="theme/images/tmp/fiji-photo-2.jpg" alt=""/></div>
          </div>
          <div class="item style-block-photo type-square">
            <div class="bg"><img src="theme/images/tmp/fiji-photo-3.jpg" alt=""/></div>
          </div>
          <div class="item style-block-photo type-half">
            <div class="bg"><img src="theme/images/tmp/fiji-photo-4.jpg" alt=""/></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>