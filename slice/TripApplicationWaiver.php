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
  <div class="form form-type-a form-waiver">
    <h4>Trip application &amp; WAIVER</h4>
    <p class="rtecenter"><img src="theme/images/tmp/logo-inspirato.png" alt=""></p><br>
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
      <form class="webform-client-form webform-client-form-33" action="/trip-application-waiver" method="post"
            id="webform-client-form-33" accept-charset="UTF-8">
        <div>
          <div class="webform-progressbar">
            <div style="display: none;" class="webform-progressbar-outer">
              <div class="webform-progressbar-inner" style="width: 0%">&nbsp;</div>
              <span class="webform-progressbar-page current" style="left: 0%">
          <span class="webform-progressbar-page-number">1</span>
                    <span class="webform-progressbar-page-label">
            1. Waiver          </span>
                  </span>
              <span class="webform-progressbar-page" style="left: 100%">
          <span class="webform-progressbar-page-number">2</span>
                    <span class="webform-progressbar-page-label">
            2. Trip application          </span>
                  </span>
            </div>


          </div>
          <div class="form-item webform-component webform-component-markup webform-component--desc0">
            <p>Before beginning the Trip Application you must read, sign and date the following Waiver, Release of
              Liability &amp; Assumption of Risk, Travel Insurance, and the Medical Proxy. Your application cannot be
              accepted without all three signatures. Parent or guardian must sign on behalf of those younger than 18
              years of age. Your information will be kept safe and confidential according to the terms of our <a
                href="#">Privacy Policy</a>.</p>

          </div>
          <div class="fields-group webform-layout-box custom webform-component--group0">
            <div class="group-head webform-layout-box custom webform-component--group0--group-head">
              <div
                class="form-item webform-component webform-component-markup webform-component--group0--group-head--acceptance-required">
                <h6>BE SURE TO HAVE THE FOLLOWING INFORMATION AVAILABLE</h6>

              </div>
            </div>
            <div class="group-body webform-layout-box custom webform-component--group0--group-body">
              <div
                class="form-item webform-component webform-component-markup webform-component--group0--group-body--rights-desc">
                <ul>
                  <li>Your Itinerary ID which you can obtain from your Signup Packet, Travel Specialist, or a recent
                    invoice.
                  </li>
                  <li>Passport information</li>
                  <li>How you will obtain your visa(s) (if applicable).&nbsp;<a href="#" target="_blank">Preview options
                      for obtaining visas</a>.
                  </li>
                  <li>Personal Health Insurance Information</li>
                </ul>
              </div>
            </div>
          </div>
          <fieldset class="webform-component-fieldset fieldset-1 webform-component--traveller-information form-wrapper">
            <legend><span class="fieldset-legend">Traveller information for (exactly as it appear on traveller's passport)</span>
            </legend>
            <div class="fieldset-wrapper">
              <div class="row webform-layout-box custom webform-component--traveller-information--row1">
                <div
                  class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveller-information--row1--frist-name">
                  <label for="edit-submitted-traveller-information-row1-frist-name"><span class="form-required"
                                                                                          title="This field is required.">*</span>
                    Frist Name</label>
                  <input required="required" type="text" id="edit-submitted-traveller-information-row1-frist-name"
                         name="submitted[traveller_information][row1][frist_name]" value="" size="60" maxlength="128"
                         class="form-text required">
                </div>
                <div
                  class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveller-information--row1--middle">
                  <label for="edit-submitted-traveller-information-row1-middle"> Middle</label>
                  <input type="text" id="edit-submitted-traveller-information-row1-middle"
                         name="submitted[traveller_information][row1][middle]" value="" size="60" maxlength="128"
                         class="form-text">
                </div>
                <div
                  class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveller-information--row1--last-name">
                  <label for="edit-submitted-traveller-information-row1-last-name"><span class="form-required"
                                                                                         title="This field is required.">*</span>
                    Last Name</label>
                  <input required="required" type="text" id="edit-submitted-traveller-information-row1-last-name"
                         name="submitted[traveller_information][row1][last_name]" value="" size="60" maxlength="128"
                         class="form-text required">
                </div>
              </div>
              <div
                class="form-item webform-component webform-component-markup webform-component--traveller-information--desc1">
                <p><strong>A separate form required for each traveler.</strong>&nbsp;At the end of this form, you will
                  be given the option to begin a new Trip Application for additional travelers.</p>

              </div>
              <div
                class="form-type-checkbox checkbox-single form-item webform-component webform-component-checkboxes webform-component--traveller-information--is-parent">
                <label for="edit-submitted-traveller-information-is-parent"> </label>

                <div id="edit-submitted-traveller-information-is-parent" class="form-checkboxes">
                  <div class="form-item form-type-checkbox form-item-submitted-traveller-information-is-parent-Yes">
                    <input type="checkbox" id="edit-submitted-traveller-information-is-parent-1"
                           name="submitted[traveller_information][is_parent][Yes]" value="Yes" class="form-checkbox">
                    <label class="option" for="edit-submitted-traveller-information-is-parent-1"> I am a parent or
                      guardian completing on behalf of a child younger than 18. If parent or guardian, please provide
                      your name:</label>

                  </div>
                </div>
              </div>
              <div class="row webform-layout-box custom webform-component--traveller-information--row2">
                <div
                  class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveller-information--row2--guardian-first">
                  <label for="edit-submitted-traveller-information-row2-guardian-first"><span class="form-required"
                                                                                              title="This field is required.">*</span>
                    Guardian First</label>
                  <input required="required" type="text" id="edit-submitted-traveller-information-row2-guardian-first"
                         name="submitted[traveller_information][row2][guardian_first]" value="" size="60"
                         maxlength="128" class="form-text required">
                </div>
                <div
                  class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveller-information--row2--guardian-middle">
                  <label for="edit-submitted-traveller-information-row2-guardian-middle"> Guardian Middle</label>
                  <input type="text" id="edit-submitted-traveller-information-row2-guardian-middle"
                         name="submitted[traveller_information][row2][guardian_middle]" value="" size="60"
                         maxlength="128" class="form-text">
                </div>
                <div
                  class="form-type-text col-sm-4 form-item webform-component webform-component-textfield webform-component--traveller-information--row2--guardian-last-name">
                  <label for="edit-submitted-traveller-information-row2-guardian-last-name"><span class="form-required"
                                                                                                  title="This field is required.">*</span>
                    Guardian Last Name</label>
                  <input required="required" type="text"
                         id="edit-submitted-traveller-information-row2-guardian-last-name"
                         name="submitted[traveller_information][row2][guardian_last_name]" value="" size="60"
                         maxlength="128" class="form-text required">
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset
            class="webform-component-fieldset fieldset-2 webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk form-wrapper">
            <legend><span class="fieldset-legend">RIGHTS AND RESPONSIBILITIES-WAIVER, RELEASE OF LIABILITY &amp; ASSUMPTION OF RISK</span>
            </legend>
            <div class="fieldset-wrapper">
              <div
                class="form-item webform-component webform-component-markup webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--desc2">
                <div class="scroll border">
                  <p>I acknowledge that travel (whether in civilized or remote areas and regardless of the
                    transportation conveyance) and participation particularly in adventure activities that may be
                    planned on this trip (such as, but not limited to boating, snorkeling, trekking, hiking, and animal
                    viewing) contain inherent risks of illness (including, but not limited to, malaria and diseases not
                    common in the United States), injury (including, but not limited to those caused or contributed to
                    by auto and/or boating accident and the inadequacy and/or absence of safety devices, such as seat
                    belts or flotation devices), emotional trauma, and/or death, which may be caused by negligence,
                    forces of nature, or other agencies known or unknown. I recognize that such risks may be present at
                    any time before, during and after the trip that I am participating in with Bolder Adventures, Inc.,
                    d.b.a. Asia Transpacific Journeys (B.A., Inc.). I also acknowledge that adequate medical services or
                    facilities may not be readily available or accessible during some or all of the time in which I am
                    participating in the trip, and that evacuation, if necessary, and if available, can be prolonged,
                    difficult and expensive. I am also aware that in developing nations such as many of those served by
                    B.A., Inc., the level of infrastructure development, sense of urgency, communications skills,
                    attention to detail, quality standards, hygiene, political stability, cuisine, sanitation
                    facilities, cleanliness, and business practices, among other things, may be deemed far inferior to
                    those found in most industrialized nations. In all cases, trip members are responsible for
                    comprehending all conditions stated and implied in the trip itinerary and selecting a trip that is
                    appropriate to their interests and abilities; for disclosing in writing any potentially relevant
                    medical or health conditions to B.A. Inc.; for preparing for the trip by reading the trip itinerary
                    and supplemental trip information supplied by B.A. Inc.; for bringing appropriate clothing and
                    related equipment and for following normal standards of personal hygiene and personal safety, as may
                    be advised by the tour leader or local guides in order to lessen the risk of all potential traveler
                    diseases or injuries.</p>

                  <p>If applicable, as a participant in a group tour, I am aware that group travel requires compromise
                    to accommodate varying personalities, wants, abilities and objectives of group members. I agree at
                    all times to act in an appropriate social manner with my fellow trip members and to act in an
                    appropriate and respectful manner in accordance with the customs of all places visited. I understand
                    and accept that, my personal desires notwithstanding, my tour leader or guide may be required, based
                    upon his or her experience and upon the wishes of the group members, to improvise and exercise his
                    or her judgment and/or make good-faith decisions concerning the management of the tour. I agree
                    further to abide by any such decisions. B.A. Inc. and/or its local guides and tour leaders reserve
                    the right, at their sole discretion, to ask a member to leave any group trip if, in the leader's
                    judgment, the person's behavior or condition may risk the health, safety, or well being of other
                    trip members or the individual themselves. Such behavior or condition includes, but is not limited
                    to contagious diseases, injuries and behavior that the guide or other group members find threatening
                    or other offensive conduct. In such case, it will be deemed a cancellation within thirty (30)
                    days.</p>

                  <p>I understand that due to the nature of the destinations to which B.A., Inc. organizes tours, and
                    the necessity of the long lead times required to organize such tours, situations such as the
                    following can and might be expected to occur: changes in tour leader or guide assignments; changes
                    in sequence or timing of the itinerary; and/or changes in accommodations and/or transport, including
                    but not limited to hotels, boats, ships, trains and automobiles. I understand further that due to
                    the above-stated reasons, B.A., Inc. cannot guarantee exact adherence to any itinerary or
                    itineraries that I have been provided. I accept that if any of the aforementioned situations arise
                    either before or during my trip, B.A., Inc. may be required to make decisions to address the changed
                    circumstances and that it may not be possible to provide me with advance notification.</p>

                  <p>B.A. Inc., gives notice that all services and arrangements for transportation, accommodations, and
                    all other services and arrangements related to this tour have been made by B.A. Inc. only as an
                    agent for the various providers of tour and travel services, upon the express condition that B.A.
                    Inc. is not liable and does not assume responsibility for any claims, damages, expenses or other
                    financial loss whether to person or property arising out of any injury, accident, death,
                    cancellation, delay, alteration, or inconvenience resulting from any act of any hotel, carrier,
                    restaurant, or other company or person rendering any of the services included in the tour or caused
                    by weather, sickness, strikes, quarantines, crime, terrorism, acts of war, or the willful or
                    negligent acts of any other tour members, or any other cause beyond our control. Accordingly, we
                    reserve the right to alter any itinerary, arrangements or dates, if it becomes necessary or
                    advisable, due to such occurrences. If additional expenses are required by such alteration, each
                    participant agrees to pay said additional amounts.</p>

                  <p>Accordingly, I waive any right or cause of action of any kind whatsoever against, and release from
                    any liability whatsoever, B.A. Inc., and its officers, directors and employees, ("Released Parties")
                    arising from my participation in the trip, excepting only liability that directly arises from the
                    gross negligence or intentional misconduct of B.A., Inc. This waiver and release shall apply to any
                    claim of injury to person or property, including but not limited to any personal injury, death,
                    dismemberment, inconvenience or delay or disruption of services, suffered in preparation for,
                    arrival at, during, or in departure from the trip.</p>

                  <p>I also agree to indemnify and defend each Released Party from any and all claims, actions, suits,
                    and demands (including all reasonable attorney's fees and costs incurred by any Released Party)
                    brought by any third party and arising from or related to any negligent action or conduct of me,
                    occurring during the trip, and which is alleged to have caused loss or damage to any such third
                    party.</p>

                  <p>I intend and agree that this waiver and release is also binding upon my heirs, legal
                    representatives, successors, and assigns.</p>

                  <p>I understand and acknowledge that all fares of passage and expenses of travel have been quoted to
                    me, in good faith, in U.S. dollars. Such quotes are subject to change due to currency fluctuations,
                    the risks of which I assume. Further, in the event changes in travel plans are required due to
                    unavoidable circumstances, B.A. Inc. shall exert all reasonable efforts to provide equivalent
                    alternatives and reasonable notice of same. Any resultant changes in cost shall be reflected in
                    amended quotes or billings to be provided by B.A. Inc. .</p>

                  <p>My rights arising from or in any way relating to contracts of travel and/or passage shall be solely
                    based upon the form of contract from time to time utilized by each transportation company and as
                    represented by their ticketing or other documentation supplied as part of the tour.</p>

                  <p>These agreements shall be construed under and governed by the laws of the State of Colorado,
                    excluding its choice of law provisions. Exclusive venue and jurisdiction over any dispute arising
                    hereunder shall be in the District Court, in and for the County of Boulder, State of Colorado. B.A.
                    Inc. shall be entitled to recover all costs and reasonable attorney's fees incurred in the event any
                    action or proceeding is brought by me outside of the foregoing venue. I agree that in the event that
                    any action or proceeding is brought by either of us in the appropriate venue, the substantially
                    prevailing party shall be entitled to recover all reasonable attorney's fees and costs.</p>

                  <p>If any of the terms of these agreements or the Terms &amp; Conditions incorporated by reference is
                    determined to be invalid or unenforceable pursuant to applicable law, the invalid or unenforceable
                    provision will be construed in accordance with applicable law as nearly as possible to reflect the
                    original intentions of the parties and the intent of the original provision. Where a court is unable
                    to construe any unenforceable or invalid provision to make it binding, the court will sever and
                    delete the provision. In any event, all other terms which remain valid and enforceable will survive
                    and remain in full force and effect.</p>
                </div>

              </div>
              <div
                class="fields-group webform-layout-box custom webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--group1">
                <div
                  class="group-head color-red webform-layout-box custom webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--group1--group-head">
                  <div
                    class="form-item webform-component webform-component-markup webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--group1--group-head--acceptance-required">
                    <h6>Acceptance required</h6>

                  </div>
                </div>
                <div
                  class="group-body webform-layout-box custom webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--group1--group-body">
                  <div
                    class="form-item webform-component webform-component-radios webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--group1--group-body--rights-accept">
                    <label class="element-invisible"
                           for="edit-submitted-rights-and-responsibilities-waiver-release-of-liability-assumption-of-risk-group1-group-body-rights-accept"><span
                        class="form-required" title="This field is required.">*</span> Rights accept</label>

                    <div
                      id="edit-submitted-rights-and-responsibilities-waiver-release-of-liability-assumption-of-risk-group1-group-body-rights-accept"
                      class="form-radios">
                      <div
                        class="form-item form-type-radio form-item-submitted-rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk-group1-group-body-rights-accept">
                        <input required="required" type="radio"
                               id="edit-submitted-rights-and-responsibilities-waiver-release-of-liability-assumption-of-risk-group1-group-body-rights-accept-1"
                               name="submitted[rights_and_responsibilities_waiver_release_of_liability__assumption_of_risk][group1][group_body][rights_accept]"
                               value="Yes" class="form-radio"> <label class="option"
                                                                      for="edit-submitted-rights-and-responsibilities-waiver-release-of-liability-assumption-of-risk-group1-group-body-rights-accept-1">
                          I have carefully read and understand the foregoing and having done so, I am signing it
                          voluntarily.</label>

                      </div>
                    </div>
                  </div>
                  <div
                    class="form-item webform-component webform-component-markup webform-component--rights-and-responsibilities-waiver-release-of-liability--assumption-of-risk--group1--group-body--rights-desc">
                    <p>I also acknowledge that I have carefully read the<a href="#">&nbsp;Terms &amp; Conditions</a>,
                      including the terms regarding cancellations and refunds, and I agree to be bound by all stated
                      conditions therein.&nbsp;<br>
                      Further, I recognize, represent and acknowledge that my execution of this Agreement is a necessary
                      pre-condition to participation in the trip, that I am over the age of 18 years and that I am in
                      sound physical and mental condition.</p>

                    <p>Signature: <span class="full-name">  </span></p>

                    <p>Date:&nbsp;09/26/16&nbsp;6:26:59 AM<br>
                      The traveler (or parent/guardian) intends the above electronic signature to serve as a valid and
                      binding signature.</p>

                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset
            class="webform-component-fieldset fieldset-3 webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost form-wrapper">
            <legend><span class="fieldset-legend">I UNDERSTAND MY OPTIONS FOR ADDITIONAL TRAVEL INSURANCE NOT INCLUDED IN TRIP COST</span>
            </legend>
            <div class="fieldset-wrapper">
              <div
                class="form-item webform-component webform-component-markup webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--desc3">
                <p>I understand that B.A., Inc. Terms and Conditions cancellation policy prevails and we cannot in some
                  cases give refunds on cancelled, pre-paid travel arrangements. I acknowledge that I have carefully
                  read the optional travel insurance brochure included in my signup materials and have considered
                  purchasing additional coverage on my own to cover trip cancellation, interruption, lost baggage, and
                  supplemental medical insurance. Please note that the cost of your trip does not include trip
                  cancellation insurance. However, we highly recommend that you purchase this additional coverage. If
                  you book your insurance through our recommended provider, Travel Insurance Services, and would like
                  any pre-existing conditions covered, your policy must be purchased within 14 days of confirmation.
                  Other carriers may have different terms for pre-existing conditions.</p>

              </div>
              <div
                class="fields-group webform-layout-box custom webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--group2">
                <div
                  class="group-head color-red webform-layout-box custom webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--group2--group-head">
                  <div
                    class="form-item webform-component webform-component-markup webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--group2--group-head--acceptance-required">
                    <h6>Acceptance required</h6>

                  </div>
                </div>
                <div
                  class="group-body webform-layout-box custom webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--group2--group-body">
                  <div
                    class="form-item webform-component webform-component-radios webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--group2--group-body--insurance-accept">
                    <label class="element-invisible"
                           for="edit-submitted-i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost-group2-group-body-insurance-accept"><span
                        class="form-required" title="This field is required.">*</span> Insurance accept</label>

                    <div
                      id="edit-submitted-i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost-group2-group-body-insurance-accept"
                      class="form-radios">
                      <div
                        class="form-item form-type-radio form-item-submitted-i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost-group2-group-body-insurance-accept">
                        <input required="required" type="radio"
                               id="edit-submitted-i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost-group2-group-body-insurance-accept-1"
                               name="submitted[i_understand_my_options_for_additional_travel_insurance_not_included_in_trip_cost][group2][group_body][insurance_accept]"
                               value="Yes" class="form-radio"> <label class="option"
                                                                      for="edit-submitted-i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost-group2-group-body-insurance-accept-1">
                          I have read, understand and agree to the above.</label>

                      </div>
                    </div>
                  </div>
                  <div
                    class="form-item webform-component webform-component-markup webform-component--i-understand-my-options-for-additional-travel-insurance-not-included-in-trip-cost--group2--group-body--rights-desc">
                    <p>Signature: <span class="full-name">  </span></p>

                    <p>Date:&nbsp;09/26/16&nbsp;6:26:59 AM<br>
                      The traveler (or parent/guardian) intends the above electronic signature to serve as a valid and
                      binding signature.</p>

                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="webform-component-fieldset fieldset-4 webform-component--medical-proxy form-wrapper">
            <legend><span class="fieldset-legend">MEDICAL PROXY</span></legend>
            <div class="fieldset-wrapper">
              <div class="form-item webform-component webform-component-markup webform-component--medical-proxy--desc4">
                <p>If I am unable to authorize my own medical attention, I authorize B.A., Inc. or its subcontractors or
                  agents to authorize medical attention on my behalf. I agree to hold harmless and release B.A., Inc.
                  from any liability for medical attention authorized by them, their subcontractors or agents on my
                  behalf. B.A., Inc. assumes no liability regarding provision of medical care or evacuation services.
                  Any of our staff or sub-contractors who may provide or seek emergency medical care on your behalf may
                  not have had formal medical or first aid training and are acting only as a "good Samaritan."</p>

              </div>
              <div class="fields-group webform-layout-box custom webform-component--medical-proxy--group3">
                <div
                  class="group-head color-red webform-layout-box custom webform-component--medical-proxy--group3--group-head">
                  <div
                    class="form-item webform-component webform-component-markup webform-component--medical-proxy--group3--group-head--acceptance-required">
                    <h6>Acceptance required</h6>

                  </div>
                </div>
                <div class="group-body webform-layout-box custom webform-component--medical-proxy--group3--group-body">
                  <div
                    class="form-item webform-component webform-component-radios webform-component--medical-proxy--group3--group-body--medical-accept">
                    <label class="element-invisible"
                           for="edit-submitted-medical-proxy-group3-group-body-medical-accept"><span
                        class="form-required" title="This field is required.">*</span> Medical accept</label>

                    <div id="edit-submitted-medical-proxy-group3-group-body-medical-accept" class="form-radios">
                      <div
                        class="form-item form-type-radio form-item-submitted-medical-proxy-group3-group-body-medical-accept">
                        <input required="required" type="radio"
                               id="edit-submitted-medical-proxy-group3-group-body-medical-accept-1"
                               name="submitted[medical_proxy][group3][group_body][medical_accept]" value="Yes"
                               class="form-radio"> <label class="option"
                                                          for="edit-submitted-medical-proxy-group3-group-body-medical-accept-1">
                          I have read, understand and agree to the above.</label>

                      </div>
                    </div>
                  </div>
                  <div
                    class="form-item webform-component webform-component-markup webform-component--medical-proxy--group3--group-body--medical-desc">
                    <p>Signature: <span class="full-name">  </span></p>

                    <p>Date:&nbsp;09/26/16&nbsp;6:26:59 AM<br>
                      The traveler (or parent/guardian) intends the above electronic signature to serve as a valid and
                      binding signature.</p>

                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <input type="hidden" name="details[sid]">
          <input type="hidden" name="details[page_num]" value="1">
          <input type="hidden" name="details[page_count]" value="2">
          <input type="hidden" name="details[finished]" value="0">
          <input type="hidden" name="form_build_id" value="form-5cXp1v5srBamFnTQ--DJWPOwIsAZdxre__g9Twzw3Go">
          <input type="hidden" name="form_token" value="64oqPWi3II_IumiFkSOFpyM9kdRgcXgSxoDRuC1fHv0">
          <input type="hidden" name="form_id" value="webform_client_form_33">

          <div class="form-actions"><input class="webform-next button-primary form-submit" type="submit" name="op"
                                           value="Submit Waiver">

            <div class="pull-center"><i class="style-red">and continue to trip application</i></div>
            <div class="pull-center">
              <div id="divSiteSeal">
                <script type="text/javascript" src="https://sealserver.trustwave.com/seal.js?style=normal"></script>
                <img id="trustwaveSealImage"
                     src="https://sealserver.trustwave.com/seal_image.php?customerId=&amp;size=105x54&amp;style=normal"
                     border="0" style="cursor:pointer;"
                     onclick="javascript:window.open('https://sealserver.trustwave.com/cert.php?customerId=&amp;size=105x54&amp;style=normal&amp;baseURL=atj.funnelstagingtoo.com', 'c_TW', 'location=no, toolbar=no, resizable=yes, scrollbars=yes, directories=no, status=no, width=615, height=720'); return false;"
                     oncontextmenu="javascript:alert('Copying Prohibited by Law - Trusted Commerce is a Service Mark of TrustWave Holdings, Inc.'); return false;"
                     alt="This site is protected by Trustwave's Trusted Commerce program"
                     title="This site is protected by Trustwave's Trusted Commerce program">
              </div>
            </div>
          </div>
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