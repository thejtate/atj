<?php $title = 'TripApplicationWaiver'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
<?php include 'tpl/layout/header.inc'; ?>
<div class="inner-wrapper">
<section class="section type-top section-top style-min">
  <div class="bg">
    <div class="clip-path-img-top-min">
      <div class="bg-img" style="background-image: url('theme/images/tmp/section-top-img-10.jpg');"
           data-top="transform:translate3d(0px, 0px, 0px)"
           data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
    </div>
    <svg width="100%" height="100%">
      <g clip-path="url(#clip-path-img-top-min)">
        <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="theme/images/tmp/section-top-img-10.jpg"
               width="100%" height="100%" preserveAspectRatio="xMidYMid slice" data-top="@transform:translate(0, 0)" data-top-bottom="@transform:translate(0, 150)"></image>
      </g>
    </svg>
  </div>
  <div class="inner">
    <div class="container">
      <header class="titles">
        <h1>
          <img src="theme/images/titles/title-journey.png" alt=""/>
          <span>JOURNEY</span>
        </h1>
        <h5>Start your</h5>
      </header>
    </div>
  </div>
</section>
<div class="content-wrapper container">
<div id="node-33" class="node node-webform-trip-application form form-type-a form-waiver"
     about="/trip-application-waiver"
     typeof="sioc:Item foaf:Document">


<span property="dc:title" content="JOURNEY" class="rdf-meta element-hidden"></span><span property="sioc:num_replies"
                                                                                         content="0"
                                                                                         datatype="xsd:integer"
                                                                                         class="rdf-meta element-hidden"></span>
<h4>Trip application &amp; WAIVER</h4>

<div class="b-cols">
  <div class="row pull-center">
    <div class="col col-md-12">
      <div class="field field-name-body field-type-text-with-summary field-label-hidden">
        <div class="field-items">
          <div class="field-item even" property="content:encoded"><p>Including rights and responsibilities-waiver,
              release of liability &amp; assumption of risk</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content">

<div class="form-progressbar">
            <span class="title">
              step
            </span>
  <ul>
    <li class="current">1. waiver</li>
    <li>2. trip application</li>
  </ul>
</div>

<form class="webform-client-form webform-client-form-33" enctype="multipart/form-data" action="/trip-application-waiver"
      method="post" id="webform-client-form-33" accept-charset="UTF-8">
<div>
<div class="webform-progressbar" style="display: none">
  <div class="webform-progressbar-outer">
    <div class="webform-progressbar-inner" style="width: 100%">&nbsp;</div>
              <span class="webform-progressbar-page completed" style="left: 0%">
          <span class="webform-progressbar-page-number">1</span>
                    <span class="webform-progressbar-page-label">
            1. Waiver          </span>
                  </span>
              <span class="webform-progressbar-page current" style="left: 100%">
          <span class="webform-progressbar-page-number">2</span>
                    <span class="webform-progressbar-page-label">
            2. Trip application          </span>
                  </span>
  </div>


</div>
<input type="hidden" name="submitted[trip_application]" value="2. Trip application"/>
<fieldset class="webform-component-fieldset fieldset-1 webform-component--traveler-inforamtion form-wrapper">
<legend><span class="fieldset-legend">Traveler inforamtion</span></legend>
<div class="fieldset-wrapper">
<div class="row webform-layout-box custom webform-component--traveler-inforamtion--row3">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--traveler-inforamtion--row3--itinerary-id">
    <label for="edit-submitted-traveler-inforamtion-row3-itinerary-id"><span class="form-required"
                                                                             title="This field is required.">*</span>
      Itinerary ID from invoice (Example: ITN300437)</label>
    <input required="required" type="text" id="edit-submitted-traveler-inforamtion-row3-itinerary-id"
           name="submitted[traveler_inforamtion][row3][itinerary_id]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-item webform-component webform-component-markup webform-component--traveler-inforamtion--row3--name">
    <div class="form-item form-type-text col-sm-6"><label><span class="form-required">*</span> Last Name</label>
      <span class="full-name">  </span></div>

  </div>
</div>
<div class="row webform-layout-box custom webform-component--traveler-inforamtion--row4">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--traveler-inforamtion--row4--address-line-2">
    <label for="edit-submitted-traveler-inforamtion-row4-address-line-2"><span class="form-required"
                                                                               title="This field is required.">*</span>
      Address line 2</label>
    <input required="required" type="text" id="edit-submitted-traveler-inforamtion-row4-address-line-2"
           name="submitted[traveler_inforamtion][row4][address_line_2]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--traveler-inforamtion--row4--address-line-1">
    <label for="edit-submitted-traveler-inforamtion-row4-address-line-1"><span class="form-required"
                                                                               title="This field is required.">*</span>
      Address line 1</label>
    <input required="required" type="text" id="edit-submitted-traveler-inforamtion-row4-address-line-1"
           name="submitted[traveler_inforamtion][row4][address_line_1]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--traveler-inforamtion--row5">
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--traveler-inforamtion--row5--city">
    <label for="edit-submitted-traveler-inforamtion-row5-city"><span class="form-required"
                                                                     title="This field is required.">*</span>
      City</label>
    <input required="required" type="text" id="edit-submitted-traveler-inforamtion-row5-city"
           name="submitted[traveler_inforamtion][row5][city]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--traveler-inforamtion--row5--country">
    <label for="edit-submitted-traveler-inforamtion-row5-country"><span class="form-required"
                                                                        title="This field is required.">*</span>
      Country</label>
    <select required="required" id="edit-submitted-traveler-inforamtion-row5-country"
            name="submitted[traveler_inforamtion][row5][country]" class="form-select required">
      <option value="" selected="selected">Select</option>
      <option value="United States">United States</option>
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
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--traveler-inforamtion--row5--state">
    <label for="edit-submitted-traveler-inforamtion-row5-state"><span class="form-required"
                                                                      title="This field is required.">*</span>
      State</label>
    <select required="required" id="edit-submitted-traveler-inforamtion-row5-state"
            name="submitted[traveler_inforamtion][row5][state]" class="form-select required">
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
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--traveler-inforamtion--row5--zip">
    <label for="edit-submitted-traveler-inforamtion-row5-zip"><span class="form-required"
                                                                    title="This field is required.">*</span>
      Zip/Potal Code</label>
    <input required="required" type="text" id="edit-submitted-traveler-inforamtion-row5-zip"
           name="submitted[traveler_inforamtion][row5][zip]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--traveler-inforamtion--row6">
  <div
    class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveler-inforamtion--row6--Phone">
    <label for="edit-submitted-traveler-inforamtion-row6-phone"><span class="form-required"
                                                                      title="This field is required.">*</span>
      Phone</label>
    <input required="required" type="text" id="edit-submitted-traveler-inforamtion-row6-phone"
           name="submitted[traveler_inforamtion][row6][Phone]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-4 form-item webform-component webform-component-email webform-component--traveler-inforamtion--row6--email">
    <label for="edit-submitted-traveler-inforamtion-row6-email"><span class="form-required"
                                                                      title="This field is required.">*</span>
      Email</label>
    <input required="required" class="email form-text form-email required" type="email"
           id="edit-submitted-traveler-inforamtion-row6-email" name="submitted[traveler_inforamtion][row6][email]"
           size="60"/>
  </div>
  <div
    class="form-type-text col-sm-4 form-item webform-component webform-component-email webform-component--traveler-inforamtion--row6--confirm-email">
    <label for="edit-submitted-traveler-inforamtion-row6-confirm-email"><span class="form-required"
                                                                              title="This field is required.">*</span>
      Confirm Email</label>
    <input required="required" class="email form-text form-email required" type="email"
           id="edit-submitted-traveler-inforamtion-row6-confirm-email"
           name="submitted[traveler_inforamtion][row6][confirm_email]" size="60"/>
  </div>
</div>
<div
  class="form-item webform-component webform-component-markup webform-component--traveler-inforamtion--traveller-desc">
  <p>TRAVEL GUIDE AND OTHER DOCUMENTS ARE SENT VIA USPS (AND IN RARE INSTANCES VIA FEDEX) AND DO NOT REQUIRE A
    SIGNATURE FOR DELIVERY.</p>

</div>
<div
  class="form-type-checkbox checkbox-single with-border form-item webform-component webform-component-checkboxes webform-component--traveler-inforamtion--add-an-alternate-shipping-address">

  <div id="edit-submitted-traveler-inforamtion-add-an-alternate-shipping-address" class="form-checkboxes">
    <div
      class="form-item form-type-checkbox form-item-submitted-traveler-inforamtion-add-an-alternate-shipping-address-Yes">
      <input required="required" type="checkbox"
             id="edit-submitted-traveler-inforamtion-add-an-alternate-shipping-address-1"
             name="submitted[traveler_inforamtion][add_an_alternate_shipping_address][Yes]" value="Yes"
             class="form-checkbox"/> <label class="option"
                                            for="edit-submitted-traveler-inforamtion-add-an-alternate-shipping-address-1">
        Add An Alternate Shipping Address</label>

    </div>
  </div>
</div>
<div
  class="form-type-checkbox checkbox-single with-border form-item webform-component webform-component-checkboxes webform-component--traveler-inforamtion--group-trip-clients-only">

  <div id="edit-submitted-traveler-inforamtion-group-trip-clients-only" class="form-checkboxes">
    <div class="form-item checkbox-bold form-type-checkbox form-item-submitted-traveler-inforamtion-group-trip-clients-only-Yes">
      <input required="required" type="checkbox" id="edit-submitted-traveler-inforamtion-group-trip-clients-only-1"
             name="submitted[traveler_inforamtion][group_trip_clients_only][Yes]" value="Yes"
             class="form-checkbox"/> <label class="option"
                                            for="edit-submitted-traveler-inforamtion-group-trip-clients-only-1">
        Group Trip Clients Onl</label>

    </div>
  </div>
  <div class="description">Check here if you <strong>DO NOT</strong> want us to include your name and the city/state you live on the
    traveler list given to other group participants
  </div>
</div>
<div
  class="form-item webform-component webform-component-markup webform-component--traveler-inforamtion--date-desc">
  <p>If you are going to be traveling on separate arrangements prior to your travel with us, please provide your
    departure date.<br/>
    This will help us ensure you receive all necessary documentation before leaving town.</p>

</div>
<div
  class="form-item webform-component webform-component-date webform-component--traveler-inforamtion--travel-departure-date">
  <label for="edit-submitted-traveler-inforamtion-travel-departure-date"> Travel Departure Date</label>

  <div class="webform-container-inline webform-datepicker">
    <div class="form-item form-type-select form-item-submitted-traveler-inforamtion-travel-departure-date-year">
      <label class="element-invisible" for="edit-submitted-traveler-inforamtion-travel-departure-date-year">
        Year</label>
      <select class="year form-select" id="edit-submitted-traveler-inforamtion-travel-departure-date-year"
              name="submitted[traveler_inforamtion][travel_departure_date][year]">
        <option value="" selected="selected">Year</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
      </select>
    </div>
    <div class="form-item form-type-select form-item-submitted-traveler-inforamtion-travel-departure-date-month">
      <label class="element-invisible" for="edit-submitted-traveler-inforamtion-travel-departure-date-month">
        Month</label>
      <select class="month form-select" id="edit-submitted-traveler-inforamtion-travel-departure-date-month"
              name="submitted[traveler_inforamtion][travel_departure_date][month]">
        <option value="" selected="selected">Month</option>
        <option value="1">Jan</option>
        <option value="2">Feb</option>
        <option value="3">Mar</option>
        <option value="4">Apr</option>
        <option value="5">May</option>
        <option value="6">Jun</option>
        <option value="7">Jul</option>
        <option value="8">Aug</option>
        <option value="9">Sep</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dec</option>
      </select>
    </div>
    <div class="form-item form-type-select form-item-submitted-traveler-inforamtion-travel-departure-date-day">
      <label class="element-invisible" for="edit-submitted-traveler-inforamtion-travel-departure-date-day">
        Day</label>
      <select class="day form-select" id="edit-submitted-traveler-inforamtion-travel-departure-date-day"
              name="submitted[traveler_inforamtion][travel_departure_date][day]">
        <option value="" selected="selected">Day</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
    </div>
    <input type="image" src="/sites/all/modules/contrib/webform/images/calendar.png"
           class="webform-calendar webform-calendar-start-2016-09-26 webform-calendar-end-2018-09-26 webform-calendar-day-0"
           alt="Open popup calendar" title="Open popup calendar"/>
  </div>
</div>
</div>
</fieldset>
<fieldset class="webform-component-fieldset fieldset-2 webform-component--emergency-inforamtion form-wrapper">
<legend><span class="fieldset-legend">EMERGENCY CONTACT INFORMATION</span></legend>
<div class="fieldset-wrapper">
<div class="row webform-layout-box custom webform-component--emergency-inforamtion--row3">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row3--emergency-relationship">
    <label for="edit-submitted-emergency-inforamtion-row3-emergency-relationship"><span class="form-required"
                                                                                        title="This field is required.">*</span>
      Relationship</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row3-emergency-relationship"
           name="submitted[emergency_inforamtion][row3][emergency_relationship]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row3--emergency-contact-name">
    <label for="edit-submitted-emergency-inforamtion-row3-emergency-contact-name"><span class="form-required"
                                                                                        title="This field is required.">*</span>
      Emergency Contact Name</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row3-emergency-contact-name"
           name="submitted[emergency_inforamtion][row3][emergency_contact_name]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--emergency-inforamtion--row4">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row4--address-line-2">
    <label for="edit-submitted-emergency-inforamtion-row4-address-line-2"><span class="form-required"
                                                                                title="This field is required.">*</span>
      Address line 2</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row4-address-line-2"
           name="submitted[emergency_inforamtion][row4][address_line_2]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row4--address-line-1">
    <label for="edit-submitted-emergency-inforamtion-row4-address-line-1"><span class="form-required"
                                                                                title="This field is required.">*</span>
      Address line 1</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row4-address-line-1"
           name="submitted[emergency_inforamtion][row4][address_line_1]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--emergency-inforamtion--row5">
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row5--city">
    <label for="edit-submitted-emergency-inforamtion-row5-city"><span class="form-required"
                                                                      title="This field is required.">*</span>
      City</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row5-city"
           name="submitted[emergency_inforamtion][row5][city]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--emergency-inforamtion--row5--country">
    <label for="edit-submitted-emergency-inforamtion-row5-country"><span class="form-required"
                                                                         title="This field is required.">*</span>
      Country</label>
    <select required="required" id="edit-submitted-emergency-inforamtion-row5-country"
            name="submitted[emergency_inforamtion][row5][country]" class="form-select required">
      <option value="" selected="selected">Select</option>
      <option value="United States">United States</option>
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
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-select webform-component--emergency-inforamtion--row5--state">
    <label for="edit-submitted-emergency-inforamtion-row5-state"><span class="form-required"
                                                                       title="This field is required.">*</span>
      State</label>
    <select required="required" id="edit-submitted-emergency-inforamtion-row5-state"
            name="submitted[emergency_inforamtion][row5][state]" class="form-select required">
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
  <div
    class="form-type-text col-sm-3 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row5--zip">
    <label for="edit-submitted-emergency-inforamtion-row5-zip"><span class="form-required"
                                                                     title="This field is required.">*</span>
      Zip/Potal Code</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row5-zip"
           name="submitted[emergency_inforamtion][row5][zip]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--emergency-inforamtion--row6">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--emergency-inforamtion--row6--Phone">
    <label for="edit-submitted-emergency-inforamtion-row6-phone"><span class="form-required"
                                                                       title="This field is required.">*</span>
      Phone</label>
    <input required="required" type="text" id="edit-submitted-emergency-inforamtion-row6-phone"
           name="submitted[emergency_inforamtion][row6][Phone]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
</div>
</fieldset>
<fieldset
  class="webform-component-fieldset fieldset-3 webform-component--state-of-health-physical-limitations form-wrapper">
  <legend><span class="fieldset-legend">STATE OF HEALTH/PHYSICAL LIMITATIONS</span></legend>
  <div class="fieldset-wrapper">
    <div class="row webform-layout-box custom webform-component--state-of-health-physical-limitations--row7">
      <div class="row">
        <div
          class="form-item webform-component webform-component-select webform-component--state-of-health-physical-limitations--row7--gender col-sm-5">
          <label for="edit-submitted-state-of-health-physical-limitations-row7-gender"><span class="form-required"
                                                                                             title="This field is required.">*</span>
            Gender</label>
          <select required="required" id="edit-submitted-state-of-health-physical-limitations-row7-gender"
                  name="submitted[state_of_health_physical_limitations][row7][gender]" class="form-select required">
            <option value="" selected="selected">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
        <div
          class="form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row7--age col-sm-2">
          <label for="edit-submitted-state-of-health-physical-limitations-row7-age"><span class="form-required"
                                                                                          title="This field is required.">*</span>
            Age</label>
          <input required="required" type="text" id="edit-submitted-state-of-health-physical-limitations-row7-age"
                 name="submitted[state_of_health_physical_limitations][row7][age]" value="" size="60" maxlength="128"
                 class="form-text required"/>
        </div>
        <div
          class="form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row7--height col-sm-2">
          <label for="edit-submitted-state-of-health-physical-limitations-row7-height"><span class="form-required"
                                                                                             title="This field is required.">*</span>
            Height</label>
          <input required="required" type="text" id="edit-submitted-state-of-health-physical-limitations-row7-height"
                 name="submitted[state_of_health_physical_limitations][row7][height]" value="" size="60" maxlength="128"
                 class="form-text required"/>
        </div>
        <div
          class="form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row7--weight col-sm-3">
          <label for="edit-submitted-state-of-health-physical-limitations-row7-weight"><span class="form-required"
                                                                                             title="This field is required.">*</span>
            Weight</label>
          <input required="required" type="text" id="edit-submitted-state-of-health-physical-limitations-row7-weight"
                 name="submitted[state_of_health_physical_limitations][row7][weight]" value="" size="60" maxlength="128"
                 class="form-text required"/> <span class="field-suffix">lb</span>
        </div>
      </div>
      <div
        class="form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row7--occupation">
        <label for="edit-submitted-state-of-health-physical-limitations-row7-occupation"><span class="form-required"
                                                                                               title="This field is required.">*</span>
          Occupation</label>
        <input required="required" type="text" id="edit-submitted-state-of-health-physical-limitations-row7-occupation"
               name="submitted[state_of_health_physical_limitations][row7][occupation]" value="" size="60"
               maxlength="128" class="form-text required"/>
      </div>
      <div
        class="form-type-checkbox checkbox-single form-item webform-component webform-component-checkboxes webform-component--state-of-health-physical-limitations--row7--have-health-conditions">
        <label for="edit-submitted-state-of-health-physical-limitations-row7-have-health-conditions"><span
            class="form-required" title="This field is required.">*</span> have health conditions</label>

        <div id="edit-submitted-state-of-health-physical-limitations-row7-have-health-conditions"
             class="form-checkboxes">
          <div
            class="form-item form-type-checkbox form-item-submitted-state-of-health-physical-limitations-row7-have-health-conditions-Yes">
            <input required="required" type="checkbox"
                   id="edit-submitted-state-of-health-physical-limitations-row7-have-health-conditions-1"
                   name="submitted[state_of_health_physical_limitations][row7][have_health_conditions][Yes]" value="Yes"
                   class="form-checkbox"/> <label class="option"
                                                  for="edit-submitted-state-of-health-physical-limitations-row7-have-health-conditions-1">
              Yes, I have health conditions of which Asia Transpacific Journeys and/or our overseas staff should be
              aware?</label>

          </div>
        </div>
      </div>
      <div
        class="form-item webform-component webform-component-textarea webform-component--state-of-health-physical-limitations--row7--please-explain">
        <label for="edit-submitted-state-of-health-physical-limitations-row7-please-explain"> Please explain</label>

        <div class="form-textarea-wrapper"><textarea
            id="edit-submitted-state-of-health-physical-limitations-row7-please-explain"
            name="submitted[state_of_health_physical_limitations][row7][please_explain]" cols="60" rows="5"
            class="form-textarea"></textarea></div>
        <div class="description">(Maximum 200 characters)</div>
      </div>
    </div>
    <div class="row">
      <div class="form-item webform-layout-box horiz webform-component--state-of-health-physical-limitations--row8 col-sm-4">
        <div
          class="form-type-text form-item webform-component webform-component-select webform-component--state-of-health-physical-limitations--row8--are-you-a-smoker">
          <label for="edit-submitted-state-of-health-physical-limitations-row8-are-you-a-smoker"><span
              class="form-required" title="This field is required.">*</span> Are you a smoker?</label>
          <select required="required" id="edit-submitted-state-of-health-physical-limitations-row8-are-you-a-smoker"
                  name="submitted[state_of_health_physical_limitations][row8][are_you_a_smoker]"
                  class="form-select required">
            <option value="" selected="selected">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
      </div>
      <div
        class="form-item webform-component webform-component-select webform-component--state-of-health-physical-limitations--dietary-preference col-sm-8">
        <label for="edit-submitted-state-of-health-physical-limitations-dietary-preference"><span class="form-required"
                                                                                                  title="This field is required.">*</span>
          Dietary Preference</label>
        <select required="required" id="edit-submitted-state-of-health-physical-limitations-dietary-preference"
                name="submitted[state_of_health_physical_limitations][dietary_preference]" class="form-select required">
          <option value="No Preference" selected="selected">No Preference</option>
          <option value="Vegetarian">Vegetarian</option>
          <option value="Vegan">Vegan</option>
          <option value="Other">Other</option>
        </select>
      </div>
    </div>
    <div
      class="form-item webform-component webform-component-textarea webform-component--state-of-health-physical-limitations--dietary-restrictions">
      <label for="edit-submitted-state-of-health-physical-limitations-dietary-restrictions"> Dietary
        Restrictions</label>

      <div class="form-textarea-wrapper resizable"><textarea
          id="edit-submitted-state-of-health-physical-limitations-dietary-restrictions"
          name="submitted[state_of_health_physical_limitations][dietary_restrictions]" cols="60" rows="5"
          class="form-textarea"></textarea></div>
      <div class="description">(Maximum 200 characters)</div>
    </div>
    <div
      class="form-item webform-component webform-component-markup webform-component--state-of-health-physical-limitations--physician-desc">
      <p>A physician and health care provider information if you become ill during your travels</p>

    </div>
    <div class="row webform-layout-box custom webform-component--state-of-health-physical-limitations--row9">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row9--physician-contact-name">
        <label for="edit-submitted-state-of-health-physical-limitations-row9-physician-contact-name"><span
            class="form-required" title="This field is required.">*</span> Physician Contact Name</label>
        <input required="required" type="text"
               id="edit-submitted-state-of-health-physical-limitations-row9-physician-contact-name"
               name="submitted[state_of_health_physical_limitations][row9][physician_contact_name]" value="" size="60"
               maxlength="128" class="form-text required"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-masked-textfield webform-component--state-of-health-physical-limitations--row9--physician-phone">
        <label for="edit-submitted-state-of-health-physical-limitations-row9-physician-phone"><span
            class="form-required" title="This field is required.">*</span> Physician Phone</label>
        <input required="required" placeholder="___-___-____" type="text"
               id="edit-submitted-state-of-health-physical-limitations-row9-physician-phone"
               name="submitted[state_of_health_physical_limitations][row9][physician_phone]" value="" size="60"
               maxlength="128" class="form-text required"/>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--state-of-health-physical-limitations--row10">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row10--personal-health-insurance-policy">
        <label for="edit-submitted-state-of-health-physical-limitations-row10-personal-health-insurance-policy"><span
            class="form-required" title="This field is required.">*</span> Personal Health Insurance Policy #</label>
        <input required="required" type="text"
               id="edit-submitted-state-of-health-physical-limitations-row10-personal-health-insurance-policy"
               name="submitted[state_of_health_physical_limitations][row10][personal_health_insurance_policy]" value=""
               size="60" maxlength="128" class="form-text required"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--state-of-health-physical-limitations--row10--personal-health-insurance-carrier">
        <label for="edit-submitted-state-of-health-physical-limitations-row10-personal-health-insurance-carrier"><span
            class="form-required" title="This field is required.">*</span> Personal Health Insurance Carrier</label>
        <input required="required" type="text"
               id="edit-submitted-state-of-health-physical-limitations-row10-personal-health-insurance-carrier"
               name="submitted[state_of_health_physical_limitations][row10][personal_health_insurance_carrier]" value=""
               size="60" maxlength="128" class="form-text required"/>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--state-of-health-physical-limitations--row11">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-masked-textfield webform-component--state-of-health-physical-limitations--row11--personal-health-insurance-phone">
        <label for="edit-submitted-state-of-health-physical-limitations-row11-personal-health-insurance-phone"><span
            class="form-required" title="This field is required.">*</span> Personal Health Insurance Phone</label>
        <input required="required" placeholder="___-___-____" type="text"
               id="edit-submitted-state-of-health-physical-limitations-row11-personal-health-insurance-phone"
               name="submitted[state_of_health_physical_limitations][row11][personal_health_insurance_phone]" value=""
               size="60" maxlength="128" class="form-text required"/>
      </div>
    </div>
  </div>
</fieldset>
<fieldset class="webform-component-fieldset fieldset-4 webform-component--visa-information form-wrapper">
  <legend><span class="fieldset-legend">VISA INFORMATION</span></legend>
  <div class="fieldset-wrapper">
    <div class="form-item webform-component webform-component-markup webform-component--visa-information--visa-desc">
      <p><strong>IT IS YOUR RESPONSIBILITY TO OBTAIN YOUR VISAS.</strong> <br/>
        Please visit <a href="http://www.asiatranspacific.com/visas" target="_blank">www.AsiaTranspacific.com/visas</a>
        for more information. If you are a non-U.S. citizen please check with an authorized visa service or
        embassy/consulate prior to travel, to ensure compliance with requirements. <br/><strong>List below how you will
          be obtaining your visa(s) for each country visited:</strong></p>

    </div>
    <div class="row webform-layout-box custom webform-component--visa-information--row12">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--visa-information--row12--visa-country-1">
        <label for="edit-submitted-visa-information-row12-visa-country-1"><span class="form-required"
                                                                                title="This field is required.">*</span>
          Country</label>
        <input required="required" type="text" id="edit-submitted-visa-information-row12-visa-country-1"
               name="submitted[visa_information][row12][visa_country_1]" value="" size="60" maxlength="128"
               class="form-text required"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-select webform-component--visa-information--row12--obtain-visa-by-1">
        <label for="edit-submitted-visa-information-row12-obtain-visa-by-1"><span class="form-required"
                                                                                  title="This field is required.">*</span>
          Obtain Visa By</label>
        <select required="required" id="edit-submitted-visa-information-row12-obtain-visa-by-1"
                name="submitted[visa_information][row12][obtain_visa_by_1]" class="form-select required">
          <option value="" selected="selected">Select</option>
          <option value="G3">G3</option>
          <option value="Other">Other</option>
          <option value="On Arrival">On Arrival</option>
          <option value="Not Required">Not Required</option>
        </select>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--visa-information--row13">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--visa-information--row13--visa-country-2">
        <label for="edit-submitted-visa-information-row13-visa-country-2"> Country</label>
        <input type="text" id="edit-submitted-visa-information-row13-visa-country-2"
               name="submitted[visa_information][row13][visa_country_2]" value="" size="60" maxlength="128"
               class="form-text"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-select webform-component--visa-information--row13--obtain-visa-by-2">
        <label for="edit-submitted-visa-information-row13-obtain-visa-by-2"> Obtain Visa By</label>
        <select id="edit-submitted-visa-information-row13-obtain-visa-by-2"
                name="submitted[visa_information][row13][obtain_visa_by_2]" class="form-select">
          <option value="" selected="selected">Select</option>
          <option value="G3">G3</option>
          <option value="Other">Other</option>
          <option value="On Arrival">On Arrival</option>
          <option value="Not Required">Not Required</option>
        </select>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--visa-information--row14">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--visa-information--row14--visa-country-3">
        <label for="edit-submitted-visa-information-row14-visa-country-3"> Country</label>
        <input type="text" id="edit-submitted-visa-information-row14-visa-country-3"
               name="submitted[visa_information][row14][visa_country_3]" value="" size="60" maxlength="128"
               class="form-text"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-select webform-component--visa-information--row14--obtain-visa-by-3">
        <label for="edit-submitted-visa-information-row14-obtain-visa-by-3"> Obtain Visa By</label>
        <select id="edit-submitted-visa-information-row14-obtain-visa-by-3"
                name="submitted[visa_information][row14][obtain_visa_by_3]" class="form-select">
          <option value="" selected="selected">Select</option>
          <option value="G3">G3</option>
          <option value="Other">Other</option>
          <option value="On Arrival">On Arrival</option>
          <option value="Not Required">Not Required</option>
        </select>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--visa-information--row15">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--visa-information--row15--visa-country-4">
        <label for="edit-submitted-visa-information-row15-visa-country-4"> Country</label>
        <input type="text" id="edit-submitted-visa-information-row15-visa-country-4"
               name="submitted[visa_information][row15][visa_country_4]" value="" size="60" maxlength="128"
               class="form-text"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-select webform-component--visa-information--row15--obtain-visa-by-4">
        <label for="edit-submitted-visa-information-row15-obtain-visa-by-4"> Obtain Visa By</label>
        <select id="edit-submitted-visa-information-row15-obtain-visa-by-4"
                name="submitted[visa_information][row15][obtain_visa_by_4]" class="form-select">
          <option value="" selected="selected">Select</option>
          <option value="G3">G3</option>
          <option value="Other">Other</option>
          <option value="On Arrival">On Arrival</option>
          <option value="Not Required">Not Required</option>
        </select>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--visa-information--row16">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--visa-information--row16--visa-country-5">
        <label for="edit-submitted-visa-information-row16-visa-country-5"> Country</label>
        <input type="text" id="edit-submitted-visa-information-row16-visa-country-5"
               name="submitted[visa_information][row16][visa_country_5]" value="" size="60" maxlength="128"
               class="form-text"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-select webform-component--visa-information--row16--obtain-visa-by-5">
        <label for="edit-submitted-visa-information-row16-obtain-visa-by-5"> Obtain Visa By</label>
        <select id="edit-submitted-visa-information-row16-obtain-visa-by-5"
                name="submitted[visa_information][row16][obtain_visa_by_5]" class="form-select">
          <option value="" selected="selected">Select</option>
          <option value="G3">G3</option>
          <option value="Other">Other</option>
          <option value="On Arrival">On Arrival</option>
          <option value="Not Required">Not Required</option>
        </select>
      </div>
    </div>
    <div class="row webform-layout-box custom webform-component--visa-information--row17">
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--visa-information--row17--visa-country-6">
        <label for="edit-submitted-visa-information-row17-visa-country-6"> Country</label>
        <input type="text" id="edit-submitted-visa-information-row17-visa-country-6"
               name="submitted[visa_information][row17][visa_country_6]" value="" size="60" maxlength="128"
               class="form-text"/>
      </div>
      <div
        class="form-type-text col-sm-6 form-item webform-component webform-component-select webform-component--visa-information--row17--obtain-visa-by-6">
        <label for="edit-submitted-visa-information-row17-obtain-visa-by-6"> Obtain Visa By</label>
        <select id="edit-submitted-visa-information-row17-obtain-visa-by-6"
                name="submitted[visa_information][row17][obtain_visa_by_6]" class="form-select">
          <option value="" selected="selected">Select</option>
          <option value="G3">G3</option>
          <option value="Other">Other</option>
          <option value="On Arrival">On Arrival</option>
          <option value="Not Required">Not Required</option>
        </select>
      </div>
    </div>
  </div>
</fieldset>
<fieldset class="webform-component-fieldset fieldset-5 webform-component--passport-information form-wrapper">
<legend><span class="fieldset-legend">PASSPORT INFORMATION</span></legend>
<div class="fieldset-wrapper">
<div class="row webform-layout-box custom webform-component--passport-information--row18">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--passport-information--row18--issuing-authority">
    <label for="edit-submitted-passport-information-row18-issuing-authority"><span class="form-required"
                                                                                   title="This field is required.">*</span>
      Issuing Authority</label>
    <input required="required" type="text" id="edit-submitted-passport-information-row18-issuing-authority"
           name="submitted[passport_information][row18][issuing_authority]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--passport-information--row18--passport-number">
    <label for="edit-submitted-passport-information-row18-passport-number"><span class="form-required"
                                                                                 title="This field is required.">*</span>
      Passport Number</label>
    <input required="required" type="text" id="edit-submitted-passport-information-row18-passport-number"
           name="submitted[passport_information][row18][passport_number]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--passport-information--row19">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--passport-information--row19--citizenship">
    <label for="edit-submitted-passport-information-row19-citizenship"><span class="form-required"
                                                                             title="This field is required.">*</span>
      Citizenship</label>
    <input required="required" type="text" id="edit-submitted-passport-information-row19-citizenship"
           name="submitted[passport_information][row19][citizenship]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>

  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-date webform-component--passport-information--issue-date">
    <label for="edit-submitted-passport-information-issue-date"><span class="form-required"
                                                                      title="This field is required.">*</span> Issue
      Date</label>

    <div class="webform-container-inline webform-datepicker">
      <div class="form-item form-type-select form-item-submitted-passport-information-issue-date-year">
        <label class="element-invisible" for="edit-submitted-passport-information-issue-date-year"> Year</label>
        <select class="year form-select" required="required" id="edit-submitted-passport-information-issue-date-year"
                name="submitted[passport_information][issue_date][year]">
          <option value="" selected="selected">Year</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
          <option value="2018">2018</option>
        </select>
      </div>
      <div class="form-item form-type-select form-item-submitted-passport-information-issue-date-month">
        <label class="element-invisible" for="edit-submitted-passport-information-issue-date-month"> Month</label>
        <select class="month form-select" required="required"
                id="edit-submitted-passport-information-issue-date-month"
                name="submitted[passport_information][issue_date][month]">
          <option value="" selected="selected">Month</option>
          <option value="1">Jan</option>
          <option value="2">Feb</option>
          <option value="3">Mar</option>
          <option value="4">Apr</option>
          <option value="5">May</option>
          <option value="6">Jun</option>
          <option value="7">Jul</option>
          <option value="8">Aug</option>
          <option value="9">Sep</option>
          <option value="10">Oct</option>
          <option value="11">Nov</option>
          <option value="12">Dec</option>
        </select>
      </div>
      <div class="form-item form-type-select form-item-submitted-passport-information-issue-date-day">
        <label class="element-invisible" for="edit-submitted-passport-information-issue-date-day"> Day</label>
        <select class="day form-select" required="required" id="edit-submitted-passport-information-issue-date-day"
                name="submitted[passport_information][issue_date][day]">
          <option value="" selected="selected">Day</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
      </div>
      <input type="image" src="/sites/all/modules/contrib/webform/images/calendar.png"
             class="webform-calendar webform-calendar-start-2016-09-26 webform-calendar-end-2018-09-26 webform-calendar-day-0"
             alt="Open popup calendar" title="Open popup calendar"/>
    </div>
  </div>
</div>

<div class="row">
<div
  class="form-type-text col-sm-6 form-item webform-component webform-component-date webform-component--passport-information--date-of-birth">
  <label for="edit-submitted-passport-information-date-of-birth"><span class="form-required"
                                                                       title="This field is required.">*</span> Date
    of Birth</label>

  <div class="webform-container-inline webform-datepicker">
    <div class="form-item form-type-select form-item-submitted-passport-information-date-of-birth-year">
      <label class="element-invisible" for="edit-submitted-passport-information-date-of-birth-year"> Year</label>
      <select class="year form-select" required="required"
              id="edit-submitted-passport-information-date-of-birth-year"
              name="submitted[passport_information][date_of_birth][year]">
        <option value="" selected="selected">Year</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
        <option value="2036">2036</option>
        <option value="2037">2037</option>
        <option value="2038">2038</option>
        <option value="2039">2039</option>
        <option value="2040">2040</option>
        <option value="2041">2041</option>
        <option value="2042">2042</option>
        <option value="2043">2043</option>
        <option value="2044">2044</option>
        <option value="2045">2045</option>
        <option value="2046">2046</option>
        <option value="2047">2047</option>
        <option value="2048">2048</option>
        <option value="2049">2049</option>
        <option value="2050">2050</option>
        <option value="2051">2051</option>
        <option value="2052">2052</option>
        <option value="2053">2053</option>
        <option value="2054">2054</option>
        <option value="2055">2055</option>
        <option value="2056">2056</option>
      </select>
    </div>
    <div class="form-item form-type-select form-item-submitted-passport-information-date-of-birth-month">
      <label class="element-invisible" for="edit-submitted-passport-information-date-of-birth-month"> Month</label>
      <select class="month form-select" required="required"
              id="edit-submitted-passport-information-date-of-birth-month"
              name="submitted[passport_information][date_of_birth][month]">
        <option value="" selected="selected">Month</option>
        <option value="1">Jan</option>
        <option value="2">Feb</option>
        <option value="3">Mar</option>
        <option value="4">Apr</option>
        <option value="5">May</option>
        <option value="6">Jun</option>
        <option value="7">Jul</option>
        <option value="8">Aug</option>
        <option value="9">Sep</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dec</option>
      </select>
    </div>
    <div class="form-item form-type-select form-item-submitted-passport-information-date-of-birth-day">
      <label class="element-invisible" for="edit-submitted-passport-information-date-of-birth-day"> Day</label>
      <select class="day form-select" required="required" id="edit-submitted-passport-information-date-of-birth-day"
              name="submitted[passport_information][date_of_birth][day]">
        <option value="" selected="selected">Day</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
    </div>
    <input type="image" src="/sites/all/modules/contrib/webform/images/calendar.png"
           class="webform-calendar webform-calendar-start-2011-09-26 webform-calendar-end-2056-09-26 webform-calendar-day-0"
           alt="Open popup calendar" title="Open popup calendar"/>
  </div>
</div>
<div
  class="form-type-text col-sm-6 form-item webform-component webform-component-date webform-component--passport-information--expiration-date">
  <label for="edit-submitted-passport-information-expiration-date"><span class="form-required"
                                                                         title="This field is required.">*</span>
    Expiration Date</label>

  <div class="webform-container-inline webform-datepicker">
    <div class="form-item form-type-select form-item-submitted-passport-information-expiration-date-year">
      <label class="element-invisible" for="edit-submitted-passport-information-expiration-date-year"> Year</label>
      <select class="year form-select" required="required"
              id="edit-submitted-passport-information-expiration-date-year"
              name="submitted[passport_information][expiration_date][year]">
        <option value="" selected="selected">Year</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
        <option value="2036">2036</option>
        <option value="2037">2037</option>
        <option value="2038">2038</option>
        <option value="2039">2039</option>
        <option value="2040">2040</option>
        <option value="2041">2041</option>
        <option value="2042">2042</option>
        <option value="2043">2043</option>
        <option value="2044">2044</option>
        <option value="2045">2045</option>
        <option value="2046">2046</option>
        <option value="2047">2047</option>
        <option value="2048">2048</option>
        <option value="2049">2049</option>
        <option value="2050">2050</option>
        <option value="2051">2051</option>
        <option value="2052">2052</option>
        <option value="2053">2053</option>
        <option value="2054">2054</option>
        <option value="2055">2055</option>
        <option value="2056">2056</option>
      </select>
    </div>
    <div class="form-item form-type-select form-item-submitted-passport-information-expiration-date-month">
      <label class="element-invisible" for="edit-submitted-passport-information-expiration-date-month">
        Month</label>
      <select class="month form-select" required="required"
              id="edit-submitted-passport-information-expiration-date-month"
              name="submitted[passport_information][expiration_date][month]">
        <option value="" selected="selected">Month</option>
        <option value="1">Jan</option>
        <option value="2">Feb</option>
        <option value="3">Mar</option>
        <option value="4">Apr</option>
        <option value="5">May</option>
        <option value="6">Jun</option>
        <option value="7">Jul</option>
        <option value="8">Aug</option>
        <option value="9">Sep</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dec</option>
      </select>
    </div>
    <div class="form-item form-type-select form-item-submitted-passport-information-expiration-date-day">
      <label class="element-invisible" for="edit-submitted-passport-information-expiration-date-day"> Day</label>
      <select class="day form-select" required="required"
              id="edit-submitted-passport-information-expiration-date-day"
              name="submitted[passport_information][expiration_date][day]">
        <option value="" selected="selected">Day</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
    </div>
    <input type="image" src="/sites/all/modules/contrib/webform/images/calendar.png"
           class="webform-calendar webform-calendar-start-2011-09-26 webform-calendar-end-2056-09-26 webform-calendar-day-0"
           alt="Open popup calendar" title="Open popup calendar"/>
  </div>
</div>
</div>
<div class="row webform-layout-box custom webform-component--passport-information--row21">
  <div
    class="form-type-text col-sm-6 form-item webform-component webform-component-textfield webform-component--passport-information--row21--place-of-birth">
    <label for="edit-submitted-passport-information-row21-place-of-birth"><span class="form-required"
                                                                                title="This field is required.">*</span>
      Place of birth</label>
    <input required="required" type="text" id="edit-submitted-passport-information-row21-place-of-birth"
           name="submitted[passport_information][row21][place_of_birth]" value="" size="60" maxlength="128"
           class="form-text required"/>
  </div>
</div>
<div class="row webform-layout-box custom webform-component--passport-information--row20"></div>
<div
  class="form-item webform-component webform-component-radios webform-component--passport-information--is-upload">
  <label for="edit-submitted-passport-information-is-upload"><span class="form-required"
                                                                   title="This field is required.">*</span> Before
    you travel, we need a scanned copy of your passport. If you have this already on your computer, you can upload
    it now. Would you like to upload your passport now?</label>

  <div id="edit-submitted-passport-information-is-upload" class="form-radios">
    <div class="form-item form-type-radio form-item-submitted-passport-information-is-upload">
      <input required="required" type="radio" id="edit-submitted-passport-information-is-upload-1"
             name="submitted[passport_information][is_upload]" value="No" checked="checked" class="form-radio"/>
      <label class="option" for="edit-submitted-passport-information-is-upload-1"> No</label>

    </div>
    <div class="form-item form-type-radio form-item-submitted-passport-information-is-upload">
      <input required="required" type="radio" id="edit-submitted-passport-information-is-upload-2"
             name="submitted[passport_information][is_upload]" value="Yes" class="form-radio"/> <label
        class="option" for="edit-submitted-passport-information-is-upload-2"> Yes</label>

    </div>
  </div>
</div>
<div id="edit-submitted-passport-information-upload-file-ajax-wrapper">
  <div
    class="form-item webform-component webform-component-file webform-component--passport-information--upload-file">
    <label for="edit-submitted-passport-information-upload-file-upload"> Upload file</label>

    <div class="form-managed-file"><input type="file" id="edit-submitted-passport-information-upload-file-upload"
                                          name="files[submitted_passport_information_upload_file]" size="22"
                                          class="form-file"/><input type="submit"
                                                                    id="edit-submitted-passport-information-upload-file-upload-button"
                                                                    name="submitted_passport_information_upload_file_upload_button"
                                                                    value="Upload" class="form-submit"/><input
        type="hidden" name="submitted[passport_information][upload_file][fid]" value="0"/>
    </div>
    <div class="description">Files must be less than <strong>2 MB</strong>.<br/>Allowed file types: <strong>gif jpg
        jpeg png txt rtf pdf doc docx odt ods zip</strong>.
    </div>
  </div>
</div>
</div>
</fieldset>
<input type="hidden" name="details[sid]"/>
<input type="hidden" name="details[page_num]" value="2"/>
<input type="hidden" name="details[page_count]" value="2"/>
<input type="hidden" name="details[finished]" value="0"/>
<input type="hidden" name="form_build_id" value="form-NsyA5xq9gRMTq8-gKEdBieSan8Nuavq-74Ji-FMILHY"/>
<input type="hidden" name="form_id" value="webform_client_form_33"/>

<div class="form-actions"><input formnovalidate="formnovalidate" class="webform-previous form-submit" type="submit"
                                 name="op" value="Back"/><input class="webform-submit button-primary form-submit"
                                                                type="submit" name="op" value="Submit"/></div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>