<!DOCTYPE html>
<html>
<?php $title = 'SearchResults'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page">
<div class="outer-wrapper">
<?php include 'tpl/layout/header.inc'; ?>
<div class="inner-wrapper">
<section class="section section-top">
  <div class="bg">
    <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-20.jpg');"></div>
  </div>
  <div class="container">
    <div class="inner-wrap">
      <div class="b-search">
        <div class="form form-search">
          <div class="form-item">
            <input autofocus="autofocus" type="text" class="form-text" placeholder="Search"/>
          </div>
          <div class="form-actions">
            <input type="submit" class="form-submit"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="content-wrapper container">
  <div class="b-search">
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


</body>
</html>