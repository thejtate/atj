<!DOCTYPE html>
<html>
<?php $title = 'NewsletterSignUp'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page">
<div class="outer-wrapper">
<?php include 'tpl/layout/header.inc'; ?>
<div class="inner-wrapper">
<section class="section section-top">
  <div class="bg">
    <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-32.jpg');"></div>
  </div>
  <div class="container">
    <div class="inner-wrap">
      <div class="title-wrap">
        <h1>special delivery</h1>
      </div>
      <div class="desc">
        <p>Straight to your inbox.
        </p>
      </div>
    </div>
  </div>
</section>

  <div class="content-wrapper container">
    <div class="b-container container-with-53 container-style-j rtecenter">
      <h2>GET THE MOST OUT OF YOUR ATJ EXPERIENCE</h2>
      <p>Please complete the following form to receive ATJ’s monthy newsletter. <br>
        Filled with fun facts, featured destinations, delicious recipes and more! <br>
        Experience ATJ like never before!</p>
    </div>

    <div class="form sign-up-page">
      <div class="form-items">
        <div class="row">
          <div class="form-item form-type-text col-sm-4">
            <label><span class="form-required">*</span> Name</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-4">
            <label><span class="form-required">*</span> Email</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text col-sm-4">
            <label><span class="form-required">*</span> Confirm Email</label>
            <input type="text" class="form-text"/>
          </div>
        </div>
      </div>
      <h4>TRAVEL PREFERENCE</h4>
      <div class="form-radios">
        <div class="form-item form-type-radio">
          <input class="form-radio" type="radio" name="radio" id="radio" checked="checked">
          <label for="radio" class="option">Custom Travel</label>
        </div>
        <div class="form-item form-type-radio">
          <input class="form-radio" type="radio" id="radio1" name="radio">
          <label for="radio1" class="option">Small Group Travel</label>
        </div>
        <div class="form-item form-type-radio">
          <input class="form-radio" type="radio" id="radio1" name="radio">
          <label for="radio1" class="option">Both</label>
        </div>
      </div>
      <h4>FAVORITE DESTINATIONS</h4>
      <div class="pull-center"><a class="link style-purple" href="#">Choose all that apply.</a></div>

      <div class="to-select-all form-item webform-component webform-component-checkboxes webform-component--countries">
        <label class="element-invisible" for="edit-submitted-countries"><span class="form-required" title="This field is required.">*</span> Countries</label>
        <div id="edit-submitted-countries" class="form-checkboxes submitted-countries style-a"><div class="form-item form-type-checkbox form-item-submitted-countries-Australia">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-1" name="submitted[countries][Australia]" value="Australia">  <label class="option" for="edit-submitted-countries-1"> Australia</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Bhutan">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-2" name="submitted[countries][Bhutan]" value="Bhutan">  <label class="option" for="edit-submitted-countries-2"> Bhutan</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Borneo">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-3" name="submitted[countries][Borneo]" value="Borneo">  <label class="option" for="edit-submitted-countries-3"> Borneo</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Cambodia">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-4" name="submitted[countries][Cambodia]" value="Cambodia">  <label class="option" for="edit-submitted-countries-4"> Cambodia</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Central-Asia">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-5" name="submitted[countries][Central Asia]" value="Central Asia">  <label class="option" for="edit-submitted-countries-5"> Central Asia</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-China">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-6" name="submitted[countries][China]" value="China">  <label class="option" for="edit-submitted-countries-6"> China</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Mongolia">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-7" name="submitted[countries][Mongolia]" value="Mongolia">  <label class="option" for="edit-submitted-countries-7"> Mongolia</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Hong-Kong">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-8" name="submitted[countries][Hong Kong]" value="Hong Kong">  <label class="option" for="edit-submitted-countries-8"> Hong Kong</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-India">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-9" name="submitted[countries][India]" value="India">  <label class="option" for="edit-submitted-countries-9"> India</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Indonesia">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-10" name="submitted[countries][Indonesia]" value="Indonesia">  <label class="option" for="edit-submitted-countries-10"> Indonesia</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Japan">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-11" name="submitted[countries][Japan]" value="Japan">  <label class="option" for="edit-submitted-countries-11"> Japan</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Laos">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-12" name="submitted[countries][Laos]" value="Laos">  <label class="option" for="edit-submitted-countries-12"> Laos</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Micronesia">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-13" name="submitted[countries][Micronesia]" value="Micronesia">  <label class="option" for="edit-submitted-countries-13"> Micronesia</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Sri-Lanka">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-14" name="submitted[countries][Sri Lanka]" value="Sri Lanka">  <label class="option" for="edit-submitted-countries-14"> Sri Lanka</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Myanmar">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-15" name="submitted[countries][Myanmar]" value="Myanmar">  <label class="option" for="edit-submitted-countries-15"> Myanmar</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Nepal">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-16" name="submitted[countries][Nepal]" value="Nepal">  <label class="option" for="edit-submitted-countries-16"> Nepal</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-New-Zealand">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-17" name="submitted[countries][New Zealand]" value="New Zealand">  <label class="option" for="edit-submitted-countries-17"> New Zealand</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Papua-New-Guinea">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-18" name="submitted[countries][Papua New Guinea]" value="Papua New Guinea">  <label class="option" for="edit-submitted-countries-18"> Papua New Guinea</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Seoul">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-19" name="submitted[countries][Seoul]" value="Seoul">  <label class="option" for="edit-submitted-countries-19"> Seoul</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Singapore">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-20" name="submitted[countries][Singapore]" value="Singapore">  <label class="option" for="edit-submitted-countries-20"> Singapore</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Taipei">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-21" name="submitted[countries][Taipei]" value="Taipei">  <label class="option" for="edit-submitted-countries-21"> Taipei</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Thailand">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-22" name="submitted[countries][Thailand]" value="Thailand">  <label class="option" for="edit-submitted-countries-22"> Thailand</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Tibet">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-23" name="submitted[countries][Tibet]" value="Tibet">  <label class="option" for="edit-submitted-countries-23"> Tibet</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Turkey">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-24" name="submitted[countries][Turkey]" value="Turkey">  <label class="option" for="edit-submitted-countries-24"> Turkey</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Vietnam">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-25" name="submitted[countries][Vietnam]" value="Vietnam">  <label class="option" for="edit-submitted-countries-25"> Vietnam</label>

          </div>
          <div class="form-item form-type-checkbox form-item-submitted-countries-Fiji">
            <input class="submitted-countries style-a form-checkbox require-one-edit-submitted-countries" type="checkbox" id="edit-submitted-countries-26" name="submitted[countries][Fiji]" value="Fiji">  <label class="option" for="edit-submitted-countries-26"> Fiji</label>

          </div>
        </div>
      </div>
      <!--        <div class="form-item form-type-desc">-->
      <!--          <label><span class="form-required">*</span> Required Field</label>-->
      <!--        </div>-->
      <div class="form-item form-type-checkbox">
        <input class="form-checkbox" type="checkbox" name="checkbox" checked="checked" />
        <label class="option">Yes, I would like to receive announcements via email of adventures and specials offers.</label>
      </div>
      <div class="form-actions">
        <div class="form-submit-wrapper">
          <input type="submit" class="form-submit" value="submit"/>
        </div>
      </div>
      <!--        <div class="pull-center"><a class="link style-red" href="#"><i>Privacy Policy</i></a></div>-->
    </div>

  </div>
</div>
<?php include 'tpl/layout/footer.inc'; ?>


</body>
</html>