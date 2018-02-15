<?php $title = 'BlogPost_thumbnailsgallery'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page-news">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-2.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>

        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-top-img-2.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-the-latest.png" alt=""/>
              <span>THE LATEST</span>
            </h1>
            <h5>Looking at the</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="clearfix">
        <div class="main">
          <div class="b-articles">
            <a class="link type-back" href="#">LATEST POSTS <span class="ico ss-icon ss-standard ss-navigateleft"></span></a>
            <article class="single-item style-blog-article style-wide">
              <div class="body">
                <h4>BLOG TITLE HERE WITH UP TO TWO LINES
                  OF TEXT FOR LONG TITLES</h4>
                <div class="article-control">
                  <div class="date">May 24, 2017</div>
                  <div class="share">
                    <img src="theme/images/tmp/tmp-share.png" alt=""/>
                  </div>
                </div>
              </div>
              <div class="photo">
                <img src="theme/images/tmp/tmp-blog-new.jpg" alt=""/>
                <a class="link-view" href="theme/images/tmp/tmp-blog-new.jpg"></a>
              </div>
              <div class="body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>
                <p>Non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt. explicabo. Nemo enim </p>
                <div class="b-gallery style-a">
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-1.jpg"><img src="theme/images/tmp/tmp-blog-new-1.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-2.jpg"><img src="theme/images/tmp/tmp-blog-new-2.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-3.jpg"><img src="theme/images/tmp/tmp-blog-new-3.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-4.jpg"><img src="theme/images/tmp/tmp-blog-new-4.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-5.jpg"><img src="theme/images/tmp/tmp-blog-new-5.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-6.jpg"><img src="theme/images/tmp/tmp-blog-new-6.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-7.jpg"><img src="theme/images/tmp/tmp-blog-new-7.jpg" alt=""/></a></div>
                  <div class="item"><a href="theme/images/tmp/tmp-blog-new-8.jpg"><img src="theme/images/tmp/tmp-blog-new-8.jpg" alt=""/></a></div>
                </div>
                <div class="share">
                  <img src="theme/images/tmp/tmp-share.png" alt=""/>
                </div>
                <div class="tags">
                  <span class="title">TAGS</span> <a href="#">India</a> <a href="#">Wedding</a> <a href="#">Group Trip</a>
                </div>
              </div>
            </article>
          </div>
        </div>
        <aside class="sidebar sidebar-right">
          <h6>SIMILAR POSTS</h6>
          <div class="b-articles">
            <div class="field-items">
              <article class="item style-block-article">
                <div class="photo">
                  <img src="theme/images/tmp/tmp-blog-new-9.jpg" alt=""/>
                </div>
                <div class="body">
                  <h4>SIMILAR POST</h4>
                  <div class="date">May 24, 2017</div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                  <a class="link type-read-more" href="#">READ MORE <span class="ico ss-icon ss-standard ss-navigateright"></span></a>
                </div>
              </article>
              <article class="item style-block-article">
                <div class="photo">
                  <img src="theme/images/tmp/tmp-blog-new-10.jpg" alt=""/>
                </div>
                <div class="body">
                  <h4>SIMILAR POST</h4>
                  <div class="date">May 24, 2017</div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                  <a class="link type-read-more" href="#">READ MORE <span class="ico ss-icon ss-standard ss-navigateright"></span></a>
                </div>
              </article>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>