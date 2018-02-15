<!DOCTYPE html>
<html>
<?php $title = 'ATJ-NewHome-updated'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="front">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section section-slider">

      <div class="b-travel-slider">
        <div class="slider-text-wrap">

          <div class="slider-text">
            <ul class="slides">
              <?php
              $slider_text = array (
                array('
                      <div class="title-wrap">
                        <span class="title">adventure awaits</span>
                      </div>
                      <div class="desc">
                       <p>We craft personal adventures & small group travel luxury tours all over Asia.</p>
                      </div>', 'Myanmar'),
                array('
                      <div class="title-wrap">
                        <span class="sub-title">path of the nomad</span>
                        <span class="title">mongolia</span>
                      </div>
                      <div class="text">
                        <p>This Group Trip to Mongolia features traditional nomadic culture, camel trek, ger camps, Gobi Desert scenary, wildlife, and visits areas that are extremely untouristed.</p>
                        <p>Next Departure: July 6, 2017</p>
                      </div>
                      <div class="btn">
                         <a class="link style-burgundy" href="#">LEARN MORE</a>
                      </div>
                      ', 'Borneo'),
                array('
                      <div class="title-wrap">
                        <span class="title">Lorem</span>
                      </div>
                      <div class="desc">
                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ea magnam magni neque nisi, quaerat totam? Aliquid atque consectetur dolores doloribus exercitationem fugiat ipsam, libero maiores non sequi tempora vel. </p>
                      </div>', 'Thailand'),
              )
              ?>
              <?php foreach($slider_text as $element): ?>
                <?php include 'tpl/items/slider_text_item.inc'; ?>
              <?php endforeach; ?>
            </ul>
            <div class="custom-controls-container">

            </div>
          </div>

        </div>

        <div class="bgs flexslider">
          <ul class="slides">
            <?php
            $bgs_items_img_url = "theme/images/tmp/";
            $bgs_items = array(
              "slider-img-tmp-1-a-m.jpg",
              "slider-img-tmp-2-m.jpg",
              "slider-img-tmp-1-a-m.jpg",
            ) ?>

            <?php foreach ($bgs_items as $element): ?>
              <?php include 'tpl/items/slider_bgs_item.inc'; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

    </section>

    <section class="section section-planning">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="inner-content">
                  <h2>ITINERARIES AT
                    YOUR FINGERTIPS</h2>
                  <div class="text">
                    <p>Spend less time planning and more time seeing. We’ll get you on your way.</p>
                  </div>
                  <div class="btn">
                    <a class="link style-burgundy" href="#">DOWNLOAD CUSTOM TRIP PLANNER</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="bg" style="background-image: url('theme/images/tmp/planning-tmp-img-1.jpg');">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="inner-content">
                  <h2>THE NEW 2018
                    CATALOG IS HERE</h2>
                  <div class="text">
                    <p>An award-winning collection of beautifully crafted Group Trips to Asia</p>
                  </div>
                  <div class="btn">
                    <a class="link style-burgundy" href="#">VIEW OUR 2018 CATALOG</a>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-sm-6">
              <div class="item style-a-rectangle">
                <div class="bg" style="background-image: url('theme/images/tmp/planning-tmp-img-2.jpg');">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-top-destination">
      <div class="bg" style="background-image: url('theme/images/tmp/top-destination-map-img-m.png');">

      </div>
      <div class="container">
        <div class="title-arrow">
          <h2>TOP 4 BEACH DESTINATIONS</h2>
          <div class="desc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
          </div>
        </div>
      </div>
      <div class="items">
        <div class="row">
          <?php
          $top_destination_img_url = "theme/images/bg-destination/";
          $top_destination_img_mobile_url = "theme/images/tmp/";
          $top_destination_items = array (
            array('top-destination-img-1-m.jpg', 'sri lanka', '1', 'top-destination-img-1-bg-m.png', '1m.jpg'),
            array('top-destination-img-2-m.jpg', 'india', '2', 'destination-india-bg-m.png', '2m.jpg'),
            array('top-destination-img-3-m.jpg', 'nepal', '3', 'destination-nepal-bg-2-m.png', '3m.jpg'),
            array('top-destination-img-4-m.jpg', 'tibet', '4', 'destination-tibet-bg-1-m.png', '4m.jpg'),

//            array('top-destination-img-4-m.jpg', 'bhutan', '5', 'destination-bhutan-bg-1-m.png'),
//            array('top-destination-img-4-m.jpg', 'china', '6', 'destination-china-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'turkey', '7', 'destination-turkey-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'central asia', '8', 'destination-central-asia-bg-m.png'),
//
//            array('top-destination-img-4-m.jpg', 'mongolia', '9', 'destination-mongolia-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'japan', '10', 'destination-japan-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'myanmar', '11', 'destination-myanmar-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'laos', '12', 'destination-laos-bg-m.png'),
//
//            array('top-destination-img-4-m.jpg', 'thailand', '13', 'destination-thailand-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'cambodia', '14', 'destination-cambodia-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'vietnam', '15', 'destination-vietnam-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'borneo', '16', 'destination-borneo-bg-m.png'),
//
//            array('top-destination-img-4-m.jpg', 'indonesia', '17', 'destination-indonesia-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'papau new guinea', '18', 'destination-papau-new-guinea-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'australia', '19', 'destination-australia-bg-m.png'),
//            array('top-destination-img-4-m.jpg', 'new zealand', '20', 'destination-new-zealand-bg-m.png'),
//
//            array('top-destination-img-4-m.jpg', 'fiji', '21', 'destination-fiji-bg-m.png'),
          )
          ?>
          <?php foreach($top_destination_items as $element): ?>
            <div class="item col-sm-3">
              <div class="clip">
                <div class="wrap">
                  <a href="#" class="top-destination-link">
                    <span class="img only-mobile">
                      <img src="<?php print $top_destination_img_mobile_url . $element[4] ?>" alt=""/>
                    </span>
                    <span class="img">
                      <img src="<?php print $top_destination_img_url . $element[0] ?>" alt=""/>
                    </span>
                    <?php if (isset($element[3])): ?>
                       <span class="img-bg">
                        <img src="<?php print $top_destination_img_url . $element[3] ?>" alt=""/>
                      </span>
                    <?php endif; ?>
                    <span class="top-destination_title">
                      <?php print $element[1] ?>
                    </span>
                    <span class="top-destination_number">
                      <?php print $element[2] ?>
                    </span>
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </section>

    <section class="section section-slider">

      <div class="container">
        <div class="title-arrow">
          <h2>UPCOMING GROUP TRIPS</h2>
        </div>
      </div>

      <div class="b-travel-slider style-a">
        <div class="slider-text-wrap">

          <div class="slider-text">
            <ul class="slides">
              <?php
              $slider_text_2 = array (
                array('
                      <div class="title-wrap">
                        <span class="sub-title">path of the nomad</span>
                        <span class="title">mongolia</span>
                      </div>
                      <div class="text">
                        <p>This Group Trip to Mongolia features traditional nomadic culture, camel trek, ger camps, Gobi Desert scenary, wildlife, and visits areas that are extremely untouristed.</p>
                        <p>Next Departure: July 6, 2017</p>
                      </div>
                      <div class="btn">
                         <a class="link style-burgundy" href="#">LEARN MORE</a>
                      </div>
                      ', 'Mongolia'),
                array('
                      <div class="title-wrap">
                        <span class="title">adventure awaits</span>
                      </div>
                      <div class="desc">
                       <p>We craft personal adventures & small group travel luxury tours all over Asia.</p>
                      </div>', 'Myanmar'),
                array('
                      <div class="title-wrap">
                        <span class="title">Lorem</span>
                      </div>
                      <div class="desc">
                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ea magnam magni neque nisi, quaerat totam? Aliquid atque consectetur dolores doloribus exercitationem fugiat ipsam, libero maiores non sequi tempora vel. </p>
                      </div>', 'Thailand'),
              )
              ?>
              <?php foreach($slider_text_2 as $element): ?>
                <?php include 'tpl/items/slider_text_item.inc'; ?>
              <?php endforeach; ?>
            </ul>
            <div class="custom-controls-container">

            </div>
          </div>

        </div>

        <div class="bgs flexslider">
          <ul class="slides">
            <?php
            $bgs_items_img_url = "theme/images/tmp/";
            $bgs_items_2 = array(
              "slider-img-tmp-2-m.jpg",
              "slider-img-tmp-1-a-m.jpg",
              "slider-img-tmp-1-a-m.jpg",
            ) ?>

            <?php foreach ($bgs_items_2 as $element): ?>
              <?php include 'tpl/items/slider_bgs_item.inc'; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

    </section>

    <section class="section type-bottom section-latest">

      <div class="title-arrow-wrap">
        <a class="title-arrow" href="#">
          <span class="title-arrow-h2">LUXURY TRAVEL NEWS</span>
        </a>
      </div>

      <div class="latest-inner-wrap">
        <div class="bg">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-img-1.jpg');"></div>
        </div>
        <div class="inner">

        <div class="container">
             <div class="b-articles style-a">
              <div class="field-items">
                <article class="item style-block-article">
                  <div class="node-news-top-destinations node-teaser">

                    <a href="#">
                      <div class="photo">
                        <img src="theme/images/tmp/content-img-31.jpg" alt=""/>
                      </div>
                      <div class="body">
                        <h4>TASTE OF ASIA: BALINESE CORN
                          FRITTERS</h4>
                        <div class="date">May 24, 2017</div>
                        <p>he gorgeous city of Jaipur is known as the "Pink City" for its many buildings painted
                        </p>
                        <span class="link type-read-more style-burgundy">READ MORE </span>
                      </div>
                    </a>

                  </div>
                </article>
                <article class="item style-block-article">

                  <div class="node-news-top-destinations node-teaser">
                    <a href="#">
                      <div class="photo">
                        <img src="theme/images/tmp/content-img-32.jpg" alt=""/>
                      </div>
                      <div class="body">
                        <h4>SAME DESTINATIONS, A NEW
                          WORLD: DISCOVER INDIA
                          THROUGH A FRESH LENS</h4>
                        <div class="date">May 24, 2017</div>
                        <p>The gorgeous city of Jaipur is known as the </p>

                        <span class="link type-read-more style-burgundy">READ MORE</span>
                      </div>
                   </a>
                  </div>
                </article>
                <article class="item style-block-article">
                  <div class="node-news-top-destinations node-teaser">
                    <a href="#">
                      <div class="photo">
                        <img src="theme/images/tmp/content-img-33.jpg" alt=""/>
                      </div>
                      <div class="body">
                        <h4>A TASTE OF SRI LANKA</h4>
                        <div class="date">May 24, 2017</div>
                        <p>The gorgeous city of Jaipur is known as the "Pink City" for its many buildings painted pink, the traditional color of welcome. Visit the City Palace, still inhabited by Jai ..</p>

                        <span class="link type-read-more style-burgundy">READ MORE</span>
                      </div>
                    </a>
                  </div>
                </article>
              </div>
             </div>
            </div>
          </div>
        </div>
    </section>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
<div class="b-sticky-btn style-a">
  <span class="title">START YOUR JOURNEY</span>
  <div class="btns">
    <div class="btn">
      <div class="sticky-btn-bg" style="background-image: url('theme/images/tmp/bnt-sticky-img-1-m.png');"></div>
      <a class="link type-read-more-a" href="#">VIEW OUR 2018 CATALOG</a>
    </div>
    <div class="btn">
      <div class="sticky-btn-bg" style="background-image: url('theme/images/tmp/bnt-sticky-img-2-m.png');"></div>
      <a class="link type-read-more-a" href="#">CUSTOM TRIP PLANNER</a>
    </div>
    <div class="btn">
      <div class="sticky-btn-bg" style="background-image: url('theme/images/tmp/bnt-sticky-img-3-m.png');"></div>
      <a class="link type-read-more-a" href="#">PLAN YOUR TRIP</a>
    </div>
  </div>
</div>
</body>
</html>