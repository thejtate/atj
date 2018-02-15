<!DOCTYPE html>
<html>
<?php $title = 'RequestCatalog'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page">
<div class="outer-wrapper">
<?php include 'tpl/layout/header.inc'; ?>
<div class="inner-wrapper">
<section class="section section-top">
  <div class="bg">
    <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-28.jpg');"></div>
  </div>
  <div class="container">
    <div class="inner-wrap">
      <div class="title-wrap">
        <h1>journey of discovery</h1>
      </div>
    </div>
  </div>
</section>

<div class=" container content-wrapper">
<div class="element-invisible">
  <a id="main-content"></a>
</div>
<div class="content-inner ">
<div class="main-content-wrapper ">
<div class="region region-content">
<div id="block-system-main" class="block block-system">
<div class="content">
<div id="node-22" class="node node-webform-catalog clearfix" about="/catalog" typeof="sioc:Item foaf:Document">
<span property="dc:title" content="Request a catalog" class="rdf-meta element-hidden"></span>
<span property="sioc:num_replies" content="0" datatype="xsd:integer" class="rdf-meta element-hidden"></span>
<figure class="b-figcaption">
  <div class="img">
    <div class="field field-name-field-catalog-preview-image field-type-image field-label-hidden">
      <div class="field-items">
        <div class="field-item even">
          <img typeof="foaf:Image" src="theme/images/tmp/n-tmp-img-7.png"/>
        </div>
      </div>
    </div>
  </div>
  <figcaption>
    <div class="field field-name-body field-type-text-with-summary field-label-hidden">
      <div class="field-items">
        <div class="field-item even" property="content:encoded">
          <h4>
            THANK YOU FOR YOUR INTEREST IN OUR CATALOG.
          </h4>
          <p>Our catalog features an award-winning collection of beautifully crafted Group Trips to Asia and the Pacific, as well as inspiration for individually crafted Custom Journeys for travel around Asia and beyond. Whether you seek the iconic sights or yearn for the far-flung and remote, you have now begun a journey of discovery and appreciation that will challenge your mind, change your perspective and fulfill your dreams.</p>
        </div>
      </div>
    </div>
  </figcaption>
</figure>
<div class="content">
<div id="webform-ajax-wrapper-22">
<form class="webform-client-form webform-client-form-22 form-type-a form" action="/catalog" method="post" id="webform-client-form-22" accept-charset="UTF-8">
<div>
<div class="form-item webform-component webform-component-markup webform-component--title-for-delivery-method">
  <h4>
    <span class="form-required">*</span>
    How would you like<br/>
    to receive your catalog?
  </h4>
</div>
<div class="row webform-layout-box custom webform-component--row">
  <div class="col col-sm-6 webform-layout-box custom webform-component--row--delivery-wrap">
    <div class="form-type-select form-item webform-component webform-component-select webform-component--row--delivery-wrap--delivery-method">
      <label class="element-invisible" for="edit-submitted-row-delivery-wrap-delivery-method">
        <span class="form-required" title="This field is required.">*</span>
        Delivery method
      </label>
      <select required="required" id="edit-submitted-row-delivery-wrap-delivery-method" name="submitted[row][delivery_wrap][delivery_method]" class="form-select required">
        <option value="download" selected="selected">Download PDF</option>
        <option value="mail">By Mail</option>
        <option value="both">Both</option>
      </select>
    </div>
  </div>
</div>
<div class="form-item webform-component webform-component-markup webform-component--header-for-personal-info">
  <h4>
    To help us serve you better,<br/>please tell us a little about yourself
  </h4>
</div>
<div class="row webform-layout-box custom webform-component--row2">
  <div class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--row2--first-name">
    <label for="edit-submitted-row2-first-name">
      <span class="form-required" title="This field is required.">*</span>
      First Name
    </label>
    <input required="required" type="text" id="edit-submitted-row2-first-name" name="submitted[row2][first_name]" value="" size="60" maxlength="128" class="form-text required"/>
  </div>
  <div class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--row2--last-name">
    <label for="edit-submitted-row2-last-name">
      <span class="form-required" title="This field is required.">*</span>
      Last Name
    </label>
    <input required="required" type="text" id="edit-submitted-row2-last-name" name="submitted[row2][last_name]" value="" size="60" maxlength="128" class="form-text required"/>
  </div>
  <div class="form-type-text col-sm-4 form-item webform-component webform-component-email webform-component--row2--email">
    <label for="edit-submitted-row2-email">
      <span class="form-required" title="This field is required.">*</span>
      Email
    </label>
    <input required="required" class="email form-text form-email required" type="email" id="edit-submitted-row2-email" name="submitted[row2][email]" size="60"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--row3">
  <div class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--row3--address-line-1">
    <label for="edit-submitted-row3-address-line-1">
      <span class="form-required" title="This field is required.">*</span>
      Address Line 1
    </label>
    <input required="required" type="text" id="edit-submitted-row3-address-line-1" name="submitted[row3][address_line_1]" value="" size="60" maxlength="128" class="form-text required"/>
  </div>
  <div class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--row3--address-line-2">
    <label for="edit-submitted-row3-address-line-2">Address Line 2</label>
    <input type="text" id="edit-submitted-row3-address-line-2" name="submitted[row3][address_line_2]" value="" size="60" maxlength="128" class="form-text"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--row4">
<div class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--row4--city">
  <label for="edit-submitted-row4-city">
    <span class="form-required" title="This field is required.">*</span>
    City
  </label>
  <input required="required" type="text" id="edit-submitted-row4-city" name="submitted[row4][city]" value="" size="60" maxlength="128" class="form-text required"/>
</div>
<div class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--row4--country">
  <label for="edit-submitted-row4-country">
    <span class="form-required" title="This field is required.">*</span>
    Country
  </label>
  <select required="required" id="edit-submitted-row4-country" name="submitted[row4][country]" class="form-select required">
    <option value="United States" selected="selected">United States</option>
    <option value="Argentina">Argentina</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Brazil">Brazil</option>
    <option value="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Canada">Canada</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Colombia">Colombia</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Croatia">Croatia</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Estonia">Estonia</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="Germany">Germany</option>
    <option value="Greece">Greece</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Haiti">Haiti</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kenya">Kenya</option>
    <option value="Korea">Korea</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Latvia">Latvia</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Mexico">Mexico</option>
    <option value="Monaco">Monaco</option>
    <option value="Morocco">Morocco</option>
    <option value="Netherlands">Netherlands</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Panama">Panama</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russia</option>
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Scotland">Scotland</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovak Republic">Slovak Republic</option>
    <option value="Slovenia">Slovenia</option>
    <option value="South Africa">South Africa</option>
    <option value="Spain">Spain</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Thailand">Thailand</option>
    <option value="Turkey">Turkey</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirate">United Arab Emirate</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="Uruguay">Uruguay</option>
    <option value="US Virgin Islands">US Virgin Islands</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Vietnam</option>
  </select>
</div>
<div class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--row4--state">
  <label for="edit-submitted-row4-state">
    <span class="form-required" title="This field is required.">*</span>
    State
  </label>
  <select required="required" id="edit-submitted-row4-state" name="submitted[row4][state]" class="form-select required">
    <option value="" selected="selected">Select</option>
    <option value="AL">Alabama</option>
    <option value="AK">Alaska</option>
    <option value="AS">American Samoa</option>
    <option value="AZ">Arizona</option>
    <option value="AR">Arkansas</option>
    <option value="CA">California</option>
    <option value="CO">Colorado</option>
    <option value="CT">Connecticut</option>
    <option value="DE">Delaware</option>
    <option value="DC">District of Columbia</option>
    <option value="FL">Florida</option>
    <option value="GA">Georgia</option>
    <option value="GU">Guam</option>
    <option value="HI">Hawaii</option>
    <option value="ID">Idaho</option>
    <option value="IL">Illinois</option>
    <option value="IN">Indiana</option>
    <option value="IA">Iowa</option>
    <option value="KS">Kansas</option>
    <option value="KY">Kentucky</option>
    <option value="LA">Louisiana</option>
    <option value="ME">Maine</option>
    <option value="MH">Marshall Islands</option>
    <option value="MD">Maryland</option>
    <option value="MA">Massachusetts</option>
    <option value="MI">Michigan</option>
    <option value="MN">Minnesota</option>
    <option value="MS">Mississippi</option>
    <option value="MO">Missouri</option>
    <option value="MT">Montana</option>
    <option value="NE">Nebraska</option>
    <option value="NV">Nevada</option>
    <option value="NH">New Hampshire</option>
    <option value="NJ">New Jersey</option>
    <option value="NM">New Mexico</option>
    <option value="NY">New York</option>
    <option value="NC">North Carolina</option>
    <option value="ND">North Dakota</option>
    <option value="MP">Northern Marianas Islands</option>
    <option value="OH">Ohio</option>
    <option value="OK">Oklahoma</option>
    <option value="OR">Oregon</option>
    <option value="PW">Palau</option>
    <option value="PA">Pennsylvania</option>
    <option value="PR">Puerto Rico</option>
    <option value="RI">Rhode Island</option>
    <option value="SC">South Carolina</option>
    <option value="SD">South Dakota</option>
    <option value="TN">Tennessee</option>
    <option value="TX">Texas</option>
    <option value="UT">Utah</option>
    <option value="VT">Vermont</option>
    <option value="VI">Virgin Islands</option>
    <option value="VA">Virginia</option>
    <option value="WA">Washington</option>
    <option value="WV">West Virginia</option>
    <option value="WI">Wisconsin</option>
    <option value="WY">Wyoming</option>
  </select>
</div>
<div class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--row4--canada-state">
  <label for="edit-submitted-row4-canada-state">
    <span class="form-required" title="This field is required.">*</span>
    State
  </label>
  <select required="required" id="edit-submitted-row4-canada-state" name="submitted[row4][canada_state]" class="form-select required">
    <option value="" selected="selected">Select</option>
    <option value="AB">ALBERTA</option>
    <option value="BC">BRITISH COLUMBIA</option>
    <option value="MB">MANITOBA</option>
    <option value="NB">NEW BRUNSWICK</option>
    <option value="NL">NEWFOUNDLAND</option>
    <option value="NS">NOVA SCOTIA</option>
    <option value="NT">NORTHWEST TERRITORIES</option>
    <option value="ON">ONTARIO</option>
    <option value="PEI">PRINCE EDWARD ISLAND</option>
    <option value="QC">QUEBEC</option>
    <option value="SK">SASKATCHEWAN</option>
    <option value="YT">YUKON</option>
  </select>
</div>
<div class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--row4--other-state">
  <label for="edit-submitted-row4-other-state">
    <span class="form-required" title="This field is required.">*</span>
    State
  </label>
  <input required="required" type="text" id="edit-submitted-row4-other-state" name="submitted[row4][other_state]" value="" size="60" maxlength="128" class="form-text required"/>
</div>
<div class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--row4--zip">
  <label for="edit-submitted-row4-zip">
    <span class="form-required" title="This field is required.">*</span>
    Zip/Potal Code
  </label>
  <input required="required" type="text" id="edit-submitted-row4-zip" name="submitted[row4][zip]" value="" size="10" maxlength="10" class="form-text required"/>
</div>
</div>
<div class="row webform-layout-box custom webform-component--row5"></div>
<div class="row webform-layout-box custom webform-component--row6"></div>
<div class="form-item webform-component webform-component-textarea webform-component--how-did-you-hear-about-asia-transpacific-journeys">
  <label for="edit-submitted-how-did-you-hear-about-asia-transpacific-journeys">
    <span class="form-required" title="This field is required.">*</span>
    How did you hear about ATJ?
  </label>
  <div class="form-textarea-wrapper">
    <textarea required="required" id="edit-submitted-how-did-you-hear-about-asia-transpacific-journeys" name="submitted[how_did_you_hear_about_asia_transpacific_journeys]" cols="60" rows="5" class="form-textarea required"></textarea>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--row7">
  <div class="form-type-text col-sm-8 form-item webform-component webform-component-textfield webform-component--row7--if-you-are-a-travel-agent-agency-name">
    <label for="edit-submitted-row7-if-you-are-a-travel-agent-agency-name">If you are a travel agent - Agency Name:</label>
    <input type="text" id="edit-submitted-row7-if-you-are-a-travel-agent-agency-name" name="submitted[row7][if_you_are_a_travel_agent_agency_name]" value="" size="60" maxlength="128" class="form-text"/>
  </div>
</div>
<div class="form-item webform-component webform-component-textarea webform-component--additional-comments">
  <label for="edit-submitted-additional-comments">Additional Comments:</label>
  <div class="form-textarea-wrapper">
    <textarea id="edit-submitted-additional-comments" name="submitted[additional_comments]" cols="60" rows="5" class="form-textarea"></textarea>
  </div>
</div>
<div class="form-item webform-component webform-component-markup webform-component--title-for-countries">
  <h4>
    Which destination(s) in our corner of the world<br/>are you most interested in traveling to?
  </h4>
  <div class="pull-center">
    <a class="link style-purple select-all" href="#">Select all that apply</a>
  </div>
</div>
<div class="to-select-all form-item webform-component webform-component-checkboxes webform-component--countries">
  <label class="element-invisible" for="edit-submitted-countries">Countries</label>
  <div id="edit-submitted-countries" class="form-checkboxes submitted-countries">
    <div class="form-item form-type-checkbox form-item-submitted-countries-Australia">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-1" name="submitted[countries][Australia]" value="Australia"/>
      <label class="option" for="edit-submitted-countries-1">Australia</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Bhutan">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-2" name="submitted[countries][Bhutan]" value="Bhutan"/>
      <label class="option" for="edit-submitted-countries-2">Bhutan</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Borneo">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-3" name="submitted[countries][Borneo]" value="Borneo"/>
      <label class="option" for="edit-submitted-countries-3">Borneo</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Cambodia">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-4" name="submitted[countries][Cambodia]" value="Cambodia"/>
      <label class="option" for="edit-submitted-countries-4">Cambodia</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Central-Asia">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-5" name="submitted[countries][Central Asia]" value="Central Asia"/>
      <label class="option" for="edit-submitted-countries-5">Central Asia</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-China">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-6" name="submitted[countries][China]" value="China"/>
      <label class="option" for="edit-submitted-countries-6">China</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Mongolia">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-7" name="submitted[countries][Mongolia]" value="Mongolia"/>
      <label class="option" for="edit-submitted-countries-7">Mongolia</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Hong-Kong">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-8" name="submitted[countries][Hong Kong]" value="Hong Kong"/>
      <label class="option" for="edit-submitted-countries-8">Hong Kong</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-India">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-9" name="submitted[countries][India]" value="India"/>
      <label class="option" for="edit-submitted-countries-9">India</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Indonesia">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-10" name="submitted[countries][Indonesia]" value="Indonesia"/>
      <label class="option" for="edit-submitted-countries-10">Indonesia</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Japan">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-11" name="submitted[countries][Japan]" value="Japan"/>
      <label class="option" for="edit-submitted-countries-11">Japan</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Laos">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-12" name="submitted[countries][Laos]" value="Laos"/>
      <label class="option" for="edit-submitted-countries-12">Laos</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Micronesia">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-13" name="submitted[countries][Micronesia]" value="Micronesia"/>
      <label class="option" for="edit-submitted-countries-13">Micronesia</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Sri-Lanka">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-14" name="submitted[countries][Sri Lanka]" value="Sri Lanka"/>
      <label class="option" for="edit-submitted-countries-14">Sri Lanka</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Myanmar">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-15" name="submitted[countries][Myanmar]" value="Myanmar"/>
      <label class="option" for="edit-submitted-countries-15">Myanmar</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Nepal">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-16" name="submitted[countries][Nepal]" value="Nepal"/>
      <label class="option" for="edit-submitted-countries-16">Nepal</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-New-Zealand">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-17" name="submitted[countries][New Zealand]" value="New Zealand"/>
      <label class="option" for="edit-submitted-countries-17">New Zealand</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Papau-New-Guinea">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-18" name="submitted[countries][Papau New Guinea]" value="Papau New Guinea"/>
      <label class="option" for="edit-submitted-countries-18">Papau New Guinea</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Seoul">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-19" name="submitted[countries][Seoul]" value="Seoul"/>
      <label class="option" for="edit-submitted-countries-19">Seoul</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Singapore">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-20" name="submitted[countries][Singapore]" value="Singapore"/>
      <label class="option" for="edit-submitted-countries-20">Singapore</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Taipei">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-21" name="submitted[countries][Taipei]" value="Taipei"/>
      <label class="option" for="edit-submitted-countries-21">Taipei</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Thailand">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-22" name="submitted[countries][Thailand]" value="Thailand"/>
      <label class="option" for="edit-submitted-countries-22">Thailand</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Tibet">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-23" name="submitted[countries][Tibet]" value="Tibet"/>
      <label class="option" for="edit-submitted-countries-23">Tibet</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Turkey">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-24" name="submitted[countries][Turkey]" value="Turkey"/>
      <label class="option" for="edit-submitted-countries-24">Turkey</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Vietnam">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-25" name="submitted[countries][Vietnam]" value="Vietnam"/>
      <label class="option" for="edit-submitted-countries-25">Vietnam</label>
    </div>
    <div class="form-item form-type-checkbox form-item-submitted-countries-Fiji">
      <input class="submitted-countries form-checkbox" type="checkbox" id="edit-submitted-countries-26" name="submitted[countries][Fiji]" value="Fiji"/>
      <label class="option" for="edit-submitted-countries-26">Fiji</label>
    </div>
  </div>
</div>
<div class="form-item webform-component webform-component-markup webform-component--required-label">
  <div class="form-item form-type-desc">
    <label>
      <span class="form-required">*</span>
      Required Field
    </label>
  </div>
</div>
<div class="form-type-checkbox checkbox-single form-item webform-component webform-component-checkboxes webform-component--yes-i-would-like-to-receive-announcements">
  <label class="element-invisible" for="edit-submitted-yes-i-would-like-to-receive-announcements">Yes, I would like to receive announcements via email of new adventures and special offers, as well as information on the unique cultural, culinary, historic and geographic features of countries throughout the Asia Pacific region.</label>
  <div id="edit-submitted-yes-i-would-like-to-receive-announcements" class="form-checkboxes">
    <div class="form-item form-type-checkbox form-item-submitted-yes-i-would-like-to-receive-announcements-Yes">
      <input type="checkbox" id="edit-submitted-yes-i-would-like-to-receive-announcements-1" name="submitted[yes_i_would_like_to_receive_announcements][Yes]" value="Yes" checked="checked" class="form-checkbox"/>
      <label class="option" for="edit-submitted-yes-i-would-like-to-receive-announcements-1">Yes, I would like to receive announcements via email of new adventures and special offers, as well as information on the unique cultural, culinary, historic and geographic features of countries throughout the Asia Pacific region.</label>
    </div>
  </div>
</div>
<input type="hidden" name="details[sid]"/>
<input type="hidden" name="details[page_num]" value="1"/>
<input type="hidden" name="details[page_count]" value="1"/>
<input type="hidden" name="details[finished]" value="0"/>
<input type="hidden" name="form_build_id" value="form-1f5Hmn4po-nVRfzmVpw2VxxsiljHLxbIjSTFJ-aU0Qg"/>
<input type="hidden" name="form_id" value="webform_client_form_22"/>
<input type="hidden" name="webform_ajax_wrapper_id" value="webform-ajax-wrapper-22"/>
<fieldset class="captcha form-wrapper">
  <legend>
    <span class="fieldset-legend">CAPTCHA</span>
  </legend>
  <div class="fieldset-wrapper">
    <div class="fieldset-description"></div>
    <input type="hidden" name="captcha_sid" value="119324"/>
    <input type="hidden" name="captcha_token" value="b35f95f5aeb133b6bb96aa1bf36adab5"/>
    <img src="/funnelcaptcha?sid=119324&amp;ts=1518190835" width="180" height="60" alt="Funnel CAPTCHA" title="Funnel CAPTCHA"/>
    <div class="reload-captcha-wrapper">
      <a href="/funnel/captcha/refresh/webform_client_form_22" class="funnel-reload-captcha">Generate a new captcha</a>
    </div>
    <div class="form-item form-type-textfield form-item-captcha-response">
      <label for="edit-captcha-response">
        <span class="form-required" title="This field is required.">*</span>
        Enter the characters shown in the image.
      </label>
      <input type="text" id="edit-captcha-response" name="captcha_response" value="" size="15" maxlength="128" class="form-text required"/>
    </div>
    <div class="form-item form-type-textfield form-item-left-param">
      <input id="left_param" style="display: none;" type="text" name="left_param" value="" size="60" maxlength="128" class="form-text"/>
    </div>
    <div class="form-item form-type-textfield form-item-human-token">
      <input id="human_token" style="display: none;" type="text" name="human_token" value="" size="60" maxlength="128" class="form-text"/>
    </div>
  </div>
</fieldset>
<div class="form-actions">
  <div class="form-submit-wrapper">
    <input class="webform-submit button-primary form-submit" type="submit" id="edit-webform-ajax-submit-22" name="op" value="Take me to the Catalog"/>
    </div>
</div>
</div>
</form>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include 'tpl/layout/footer.inc'; ?>

<div class="b-modal modal fade style-wight" id="popup-cvv-whats-this" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close close-btn" data-dismiss="modal" aria-hidden="true">+</a>
      </div>
      <div class="modal-body">
        <div class="field field-name-field-wtp-cvv2-info field-type-text-long field-label-hidden">
          <div class="field-items">
            <div class="field-item even">
              <p>
                <img alt="" height="70" src="theme/images/tmp//tmp-logo-1_0.png" width="132"/>
              </p>
              <p>
                <a href="#" target="_blank">www.atj.com</a>
              </p>
              <h4>CVV2 - What's This?</h4>
              <p>
                For <strong>Visa and MasterCard</strong>
                , the CVV, or Card Verification Number is a 3 digit number found on the back of your card in the signature area. Your card number should be printed here along with a three-digit number at the end. (Some newer credit cards only show the last four digits of the credit card number on the back, followed by the CVV number.)
              </p>
              <p>
                For <strong>American Express</strong>
                cards, the CVV is a 4 digit number printed above and to the right of the imprinted card number on the front of your card.
              </p>
              <p>CVV, or Card Verification Number, is an authentication mechanism created by card companies to help reduce fraud with online transactions. It requires the card holder to have the card physically in hand in order to enter three or four digits found printed on the card itself. The CVV is a number that is printed, not imprinted, on your Visa, MasterCard or American Express. This number is never transferred during card swipes and should only be known by you, the cardholder.</p>
              <table border="0">
                <tbody>
                <tr>
                  <td>
                    <p>
                      <strong>For Visa/Mastercard</strong>
                      <br/>
                      <img alt="Visa-MC CVV" height="115" src="theme/images/tmp/cvv2visa.gif" width="185"/>
                    </p>
                  </td>
                  <td>
                    <p>
                      <strong>For American Express</strong>
                      <br/>
                      <img alt="Amex CVV" height="115" src="theme/images/tmp/cvv2amex.gif" width="185"/>
                    </p>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>