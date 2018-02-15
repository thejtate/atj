<?php $title = 'Login'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">
    <section class="section type-top section-top style-min">
      <div class="bg">
        <div class="clip-path-img-top-min">
          <div class="bg-img" style="background-image: url('theme/images/tmp/section-img-20.jpg');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>
        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-min)">
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-img-20.jpg"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
          </g>
        </svg>
      </div>
      <div class="inner">
        <div class="container">
          <header class="titles">
            <h1>
              <img src="theme/images/titles/title-partners.png" alt=""/>
              <span>PARTNERS</span>
            </h1>
            <h5>Our loyal</h5>
          </header>
        </div>
      </div>
    </section>
    <div class="content-wrapper container">
      <h4>LOGIN</h4>
      <br/>
      <div class="form form-login">
        <div class="form-item form-type-textfield form-item-name">
          <label>Login Name</label>
          <input autofocus="autofocus" type="text" class="form-text">
        </div>
        <div class="form-item form-type-password form-item-pass">
          <label>Password</label>
          <input type="password" class="form-text">
        </div>
        <div class="form-actions form-wrapper">
          <input type="submit" value="Log in" class="form-submit">
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>