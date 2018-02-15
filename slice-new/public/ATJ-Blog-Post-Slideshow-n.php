<!DOCTYPE html>
<html>
<?php $title = 'ATJ-Blog-Post-Slideshow-n'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page-news">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section section-top">
      <div class="bg">
        <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-4.jpg');"></div>
      </div>
      <div class="container">
        <div class="inner-wrap">
          <div class="title-wrap">
            <h1>luxury travel news</h1>
          </div>
          <div class="desc">
            <p>Stories, insights, recipes and more <br>
              from all over Asia.</p>
          </div>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="clearfix">
        <div class="main">

          <div class="node-news-top-destinations">
            <div class="b-articles style-b">
            <a class="link style-burgundy" href="#">SEE ALL OUR LUXURY TRAVEL ARTICLERS</a>
            <article class="single-item style-blog-article style-wide">

              <div class="style-blog-article-slider">

                <ul class="slides">
                  <?php
                  $blog_article_slider_img_url = "theme/images/tmp/";
                  $blog_article_slider = array(
                    "blog-article-slider-img-1.jpg",
                    "blog-article-slider-img-1.jpg",
                    "blog-article-slider-img-1.jpg",
                    "blog-article-slider-img-1.jpg",
                    "blog-article-slider-img-1.jpg",
                    "blog-article-slider-img-1.jpg",
                  ) ?>

                  <?php foreach ($blog_article_slider as $element): ?>
                    <li>
                      <div class="bg" style="background-image: url(' <?php print $blog_article_slider_img_url . $element ?>')"></div>
                    </li>
                  <?php endforeach; ?>
                </ul>

                <div class="slider-counter">
                  <span class="current-slider"></span> of <span class="all-sliders"></span>
                </div>

              </div>

              <div class="body content">
                <h1>
                  Top 5 Ways to Explore Bali<br>by Jarrod Hobson</br>
                </h1>
                <span property="dc:title" content="Top 5 Ways to Explore Bali&lt;br&gt;by Jarrod Hobson&lt;/br&gt;" class="rdf-meta element-hidden"></span>
                <span property="sioc:num_replies" content="0" datatype="xsd:integer" class="rdf-meta element-hidden"></span>
                <div class="article-control">
                  <div class="date">
                    <div class="field field-name-field-news-date field-type-datetime field-label-hidden">
                      <div class="field-items">
                        <div class="field-item even">
                          <span class="date-display-single" property="dc:date" datatype="xsd:dateTime" content="2017-11-01T00:00:00-06:00">November 1, 2017</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="share"></div>
                </div>
              </div>
              <div class="body content">
                <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                  <div class="field-items">
                    <div class="field-item even" property="content:encoded">
                      <p>As a 6th annual consecutive winner for Travel + Leisure's prestigious A-List awards for his expertise in Indonesia, there is no doubt that Jarrod Hobson knows the ins and outs of Bali, Indonesia. From the most stunning hikes to dining with Balinese Royals, he guides you through his favorite Balinese experiences. Continue reading below for Jarrod's first-hand account of memorable ways to explore Bali. </p>
                    </div>
                  </div>
                </div>
              </div>


              <div class="photo">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="item style-a-rectangle">
                      <div class="inner-content">
                        <div class="sib-title"><span>1</span></div>
                        <h2>TITLE GOES HERE</h2>
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
              <div class="body">
                <p>High up in the mountain villages of Muntigunung in North East Bali the people have much less privileged lives than most Balinese. By taking people on a beautiful trek we have found a way to generate income to the local families. </p>
                <p>We have chosen a moderate route which begins at the lakeside village of Songan. From here we trek through wild vegetation to the hamlets located on the hill side. Accompanied by experienced guides and villagers, you will enjoy a part of the island most visitors are not even aware of. Learn about the challenges locals face and how help is provided while enjoying the tranquility of this remote area and stunning views of Lake Batur and the Indian Ocean.</p>
                <p>Around lunch-time we will relax near the beach and enjoy a delicious meal before heading back to your resort. </p>
              </div>


              <div class="photo">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="item style-a-rectangle">
                      <div class="inner-content">
                        <div class="sib-title"><span>2</span></div>
                        <h2>TITLE GOES HERE</h2>
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
              <div class="body">
                <p>Visit the village of Bulian, which will allow you a very unique cultural experience. The drive to the village is beautiful, taking you past rice terraces and active volcanoes.</p>
                <p>Once you arrive at the village, visit with the locals and your guide's personal friends. You might observe the young boys and girls of the village learning the traditional Balinese dances and the traditional art of Balinese music. You'll spend the afternoon as honored guests and joining and learning of age-old traditions and customs.</p>
                <p>This evening you will spend time with your guide at his home for dinner and a unique dance performance. He and his family will have dinner prepared and as special guests, enjoy traditional music and dance. </p>
              </div>

              <div class="photo">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="item style-a-rectangle">
                      <div class="inner-content">
                        <div class="sib-title"><span>3</span></div>
                        <h2>TITLE GOES HERE</h2>
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
              <div class="body">
                <p>Bali; the name alone suggests images of rice paddies and mighty volcanoes. Besides the exotic image the island has built over the years, and it’s natural attractions Bali’s soul and character is defined by its people.</p>
                <p>Ubud in the 1930’s became a heaven for artists with the likes of Walter Spies, Miguel Covarrubias and later Antonio Blanco and Arie Smit. The island has been a magnet for the arts and Ubud its epicenter.</p>
                <p>One of the most remarkable ways of discovering Bali is through its people and the unique art forms the island is known for the world over. We invite you to join us in a memorable trip to the soul of the island. Meeting local artists at their homes and workshops we open the door to a world that is normally hidden form the sight of travelers. You can buy an art piece in a showroom but how about meeting the masters themselves?</p>
                <p>We always dream about a chance to meet interesting local people, we will give you the opportunity to meet talented local maestros and then have a meal with a host family in a real Balinese home.</p>
                <div class="share">
                  <img src="theme/images/tmp/tmp-share.png" alt=""/>
                </div>
              </div>


            </article>
          </div>
          </div>
        </div>
        <aside class="sidebar sidebar-right">
          <h6>SIMILAR NEWS</h6>
          <div class="b-articles style-a">
            <div class="field-items">
              <article class="item style-block-article">

                <div class="node-news node-teaser">

                  <a href="#">

                    <div class="photo">
                      <img src="theme/images/tmp/tmp-blog-new-9.jpg" alt=""/>
                    </div>
                    <div class="body">
                      <h4>TASTE OF ASIA: BALINESE CORN
                        FRITTERS</h4>
                      <div class="date">May 24, 2017</div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                      <span class="link type-read-more style-burgundy">READ MORE </span>
                    </div>

                  </a>

                </div>

              </article>
              <article class="item style-block-article">

                <div class="node-news node-teaser">

                  <a href="#">

                    <div class="photo">
                      <img src="theme/images/tmp/tmp-blog-new-10.jpg" alt=""/>
                    </div>
                    <div class="body">
                      <h4>SIMILAR POST</h4>
                      <div class="date">May 24, 2017</div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                      <span class="link type-read-more style-burgundy">READ MORE </span>
                    </div>

                  </a>

                </div>
              </article>
            </div>
          </div>
        </aside>
      </div>
    </div>
    <section class="section section-planning style-a">
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
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>