<?php $title = 'SearchResults'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-img-25.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-img-25.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-results.png" alt=""/>
              <span>RESULTS</span>
            </h1>
            <h5>Search</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <div class="b-search">
        <div class="form form-search">
          <div class="form-item">
            <input autofocus="autofocus" type="text" class="form-text" placeholder="SEARCH"/>
          </div>
          <div class="form-actions">
            <input type="submit" class="form-submit"/>
          </div>
        </div>
        <h4>DISPLAYING X RESULTS FOR “INDIA”</h4>
        <div class="list-results">
          <div class="item">
            <h6><a href="#">RESULT</a></h6>
            <p>Lorem ipsum dolor sit amet, India adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco...
              <a class="link style-red" href="#">READ MORE</a></p>
          </div>
          <div class="item">
            <h6>RESULT</h6>
            <p>Lorem ipsum dolor sit amet, India adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco...
              <a class="link style-red" href="#">READ MORE</a></p>
          </div>
          <div class="item">
            <h6>RESULT</h6>
            <p>Lorem ipsum dolor sit amet, India adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco...
              <a class="link style-red" href="#">READ MORE</a></p>
          </div>
        </div>
        <div class="pager-wrapper">
          <div class="item-list">
            <ul class="pager">
              <li class="pager-first first"><a href="#">«</a></li>
              <li class="pager-previous"><a href="#">‹</a></li>
              <li class="pager-item"><a title="Go to page 1" href="#">1</a></li>
              <li class="pager-current">2</li>
              <li class="pager-item"><a title="Go to page 3" href="#">3</a></li>
              <li class="pager-item"><a title="Go to page 4" href="#">4</a></li>
              <li class="pager-item"><a title="Go to page 5" href="#">5</a></li>
              <li class="pager-next"><a href="#">›</a></li>
              <li class="pager-last last"><a href="#">»</a></li>
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