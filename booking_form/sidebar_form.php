<?php

add_shortcode('sidebar_form', 'sidebar_form');
function sidebar_form()
{
    date_default_timezone_set("Europe/London");

	$pickDay = "";
    $pickMonth = "";
    $pickYear = "";
    $dates = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
    $month = date("m");
    $day = date("d");
    $hourCom = date("h");
    $idx = (int)$month;

    for ($i = 1; $i <= 31; $i++) {
        $disable = "";
        if ($i < $day) $disable = "disabled='disabled'";
        $pickDay .= '<option '.$disable.' value="' . $i . '"><span>' . $i . '</span></option>';
    }
    for ($i = 0; $i < 12; $i++) {
        $disable = "";
        if ($i < ($idx - 1)) $disable = "disabled='disabled'";
        $pickMonth .= '<option '.$disable.' value="' . $dates[$i] . '"><span>' . $dates[$i] . '</span></option>';
    }
    for ($i = 2021; $i <= 2022; $i++) $pickYear .= '<option value="' . $i . '"><span>' . $i . '</span></option>';


    $selectHour = "";
    for ($i = 0; $i < 24; $i++) {
        for ($j = 0; $j < 60; $j += 30) {
            $hours = $i < 10 ? "0" . $i : $i;
            $minutes = $j < 10 ? "0" . $j : $j;

            // $disable = "";
            $selected = "";
            // if ((int)$hours < (int)$hourCom) $disable = "disabled='disabled'";
            if ((int)$hours < ((int)$hourCom + 1)) $selected = "selected";
            
            $selectHour .= '<option '.$selected.' value="' . $hours.":".$minutes . '"><span>' . $hours.":".$minutes . '</span></option>';
        }
    }

    $sidebarContent =
        '<div class="sidebar-container">
            <div class="multisteps-form">
                
                <form class="sidebar_form" id="booking_form">
                    <div class="steps-body js-active" >
                        <div class="steps-inputcode multisteps-form__content">
                            <div class="steps-header">
                                <p class="title">Get Instant Quote</p>
                            </div>
                            <hr />
                            <div class="steps-content">
                                <div class="code-group d-flex">
                                    <div>
                                        <input type="text" name="first_address" id="first_address" placeholder="Enter Your Full Collection Address">
                                        <input type="text" name="first_postcode" id="first_postcode" disabled>
    
                                        <input type="text" name="second_address" id="second_address" placeholder="Enter Your Full Delivery Address">
                                        <input type="text" name="second_postcode" id="second_postcode" disabled>
                                        
                                        <input type="hidden" name="location_distance">
                                    </div>
                                    <img src="/wp-content/themes/sdcd/booking_form/assets/imgs/code_group.svg" alt="code group">
                                </div>

                                <img src="/wp-content/themes/sdcd/booking_form/assets/imgs/map_tracking.svg" alt="map tracking">
                            </div>
                            <div class="steps-footer">
                                <button class="js-btn-next" data-steps="steps-inputcode">
                                    <div class="check-next"></div> Next Step
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="steps-body" data-animation="fadeInLeftShort">
                        <div class="select-vehicle multisteps-form__content">
                            <div class="steps-header d-flex">
                                <img class="js-btn-prev" src="/wp-content/themes/sdcd/booking_form/assets/imgs/back_arrow.svg" alt="back arrow">
                                <p class="title">Select a Vehicle</p>
                                <span class="steps_number"><img src="/wp-content/themes/sdcd/booking_form/assets/imgs/step2.svg" alt="step2"></span>
                            </div>
                            <hr />
                            <div class="steps-content">
                                <div class="vahicle-column">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="motorcycle"
                                            value="motorcycle">
                                        <label class="form-check-label" for="motorcycle">
                                            <span class="vehicle-icon motor-cycle"></span>
                                            <p>Motorcycle</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="small_van"
                                            value="small_van">
                                        <label class="form-check-label" for="small_van">
                                            <span class="vehicle-icon small-van"></span>
                                            <p>Small Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="large_van"
                                            value="large_van">
                                        <label class="form-check-label" for="large_van">
                                            <span class="vehicle-icon large-van"></span>
                                            <p>Large Van</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="vahicle-column">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="lift_van" value="lift_van">
                                        <label class="form-check-label" for="lift_van">
                                            <span class="vehicle-icon lift-van"></span>
                                            <p>Lutton Tail Lift Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="extra_large_van"
                                            value="extra_large_van">
                                        <label class="form-check-label" for="extra_large_van">
                                            <span class="vehicle-icon extra-large-van"></span>
                                            <p>Extra Large Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="lorry" value="lorry">
                                        <label class="form-check-label" for="lorry">
                                            <span class="vehicle-icon lorry"></span>
                                            <p>Lorry</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="vahicle-column">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="refriger_van"
                                            value="refriger_van">
                                        <label class="form-check-label" for="refriger_van">
                                            <span class="vehicle-icon refriger-van"></span>
                                            <p>Refrigerated Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vehicle_type" id="notsure_van"
                                            value="notsure_van">
                                        <label class="form-check-label" for="notsure_van">
                                            <span class="vehicle-icon notsure-van"></span>
                                            <p>I\'m not sure</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-footer">
                                <button class="js-btn-next" data-steps="select-vehicle">
                                    <div class="check-next"></div> Next Step
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="steps-body" data-animation="fadeInLeftShort">
                        <div class="pick-date multisteps-form__content">
                            <div class="steps-header d-flex">
                                <img class="js-btn-prev" src="/wp-content/themes/sdcd/booking_form/assets/imgs/back_arrow.svg" alt="back arrow">
                                <p class="title">Pick a Delivery Date</p>
                                <span class="steps_number"><img src="/wp-content/themes/sdcd/booking_form/assets/imgs/step3.svg" alt="step3"></span>
                            </div>
                            <hr />
                            <div class="steps-content">
                                <div class="pick-date-group">
                                    <div class="form-check">
                                        <input type="radio" name="pick_date" id="pick-urgent" value="Urgent">
                                        <label for="pick-urgent">Urgent</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="pick_date" id="pick-today" value="Today">
                                        <label for="pick-today">Today</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="pick_date" id="pick-tomorrow" value="Tomorrow">
                                        <label for="pick-tomorrow">Tomorrow</label>
                                    </div>
                                </div>
                                <p class="text-center">Or choose a date</p>
                                <hr />
                                <div class="choose-date">
                                    <select name="pick-day" id="pick-day">
                                        ' . $pickDay . '
                                    </select>
                                    <select name="pick-month" id="pick-month">
                                        ' . $pickMonth . '
                                    </select>
                                    <select name="pick-year" id="pick-year">
                                        ' . $pickYear . '
                                    </select>
                                </div>
                            </div>
                            <div class="steps-footer">
                                <button class="js-btn-next" data-steps="pick-date">
                                    <div class="check-next"></div> Next Step
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="steps-body" data-animation="fadeInLeftShort">
                        <div class="select-time multisteps-form__content">
                            <div class="steps-header d-flex">
                                <img class="js-btn-prev" src="/wp-content/themes/sdcd/booking_form/assets/imgs/back_arrow.svg" alt="back arrow">
                                <p class="title">Select Collection Time</p>
                                <span class="steps_number"><img src="/wp-content/themes/sdcd/booking_form/assets/imgs/step4.svg" alt="step4"></span>
                            </div>
                            <hr />
                            <div class="steps-content">
                                <div class="choose-date">
                                    <select name="select-hour" id="select-hour">
                                        ' . $selectHour . '
                                    </select>
                                </div>
                                <img src="/wp-content/themes/sdcd/booking_form/assets/imgs/time.svg" alt="time">
                            </div>
                            <div class="steps-footer">
                                <button class="js-btn-next" data-steps="select-time">
                                    <div class="check-next"></div> Next Step
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="steps-body" data-animation="fadeInLeftShort">
                        <div class="steps-info multisteps-form__content">
                            <div class="steps-header d-flex">
                                <img class="js-btn-prev" src="/wp-content/themes/sdcd/booking_form/assets/imgs/back_arrow.svg" alt="back arrow" data-steps="steps-info">
                                <p class="title">Input your details</p>
                                <span class="steps_number"><img src="/wp-content/themes/sdcd/booking_form/assets/imgs/step5.svg" alt="step5"></span>
                            </div>
                            <hr />
                            <div class="steps-content">
                                <div class="user-info">
                                    <input type="text" name="user_name" placeholder="Full Name (e.g. John Doe)">
                                    <input type="text" name="user_email" placeholder="Email (e.g. johndoe@live.co.uk)" style="text-transform: initial;">
                                    <input type="text" name="user_phone" placeholder="Phone: (e.g. 07890123345)">
                                    <textarea name="additional_details" placeholder="Describe the item or special requests. e.g. I have a pallet of antique goods, the driver may need a pump truck to deliver."></textarea>
                                </div>
                            </div>
                            <div class="steps-footer">
                                <button class="js-btn-next" data-steps="steps-info">
                                    <div class="check-next"></div> Get Quote
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="steps-body" data-animation="fadeInLeftShort">
                        <div class="steps-price">
                            <div class="steps-header d-flex">
                                <img class="js-btn-prev" src="/wp-content/themes/sdcd/booking_form/assets/imgs/back_arrow.svg" alt="back arrow">
                                <p class="title">Price</p>
                                <p style="width: 37px;"></p>
                            </div>
                            <hr />
                            <div class="steps-content">
                                <p class="price-description">
                                    Based on the information you have provided, the price to courier your parcel from <span class="origin-address">XX1</span> to <span class="dest-address">XX1</span> is:
                                </p>
                                <p class="price-description" style="margin-top:12px;">
                                    Delivery time is approx. <strong class="duration">3 hour 30 min</strong>
                                </p>
                                <div class="calc_price">
                                    <p>£289.83</p>
                                    <p>INC VAT</p>
                                </div>
                                <input type="hidden" name="deliver_price">
                            </div>
                            <div class="steps-footer">
                                <div class="loading">
                                    <img style="width:40px;height:40px;" src="/wp-content/themes/sdcd/booking_form/assets/imgs/loading.gif"/>
                                </div>
                                <button id="checkout_button" data-steps="steps-price">
                                    <div class="check-next"></div> Book Now
                                </button>
                            </div>
                            <img class="thumbs-up" src="/wp-content/themes/sdcd/booking_form/assets/imgs/thumbs_up.svg" alt="thumbs">
                        </div>
                    </div>

                    <div class="steps-body" >
                        <div class="steps-thankyou multisteps-form__content">
                            <div class="steps-header">
                                <img class="ornament-left" src="/wp-content/themes/sdcd/booking_form/assets/imgs/ornament_lines.svg" alt="ornament left">
                                <img class="ornament-right" src="/wp-content/themes/sdcd/booking_form/assets/imgs/ornament_lines.svg" alt="ornament right">
                            </div>
                            <div class="steps-content">
                                <img src="/wp-content/themes/sdcd/booking_form/assets/imgs/green_check.svg" alt="green check">
                                <h2>Thank you <br/> for your enquiry</h2>
                                <hr/>
                                <p>Our team will be in touch with you shortly with best possible prices. Remember - we can deliver your parcel today at rock bottom prices.</p>
                            </div>
                            <img class="enquiry-thumbs" src="/wp-content/themes/sdcd/booking_form/assets/imgs/thumbs_up.svg" alt="enquiry thumbs">
                        </div>
                    </div>
                </form>
            </div>
        </div>';


    return $sidebarContent;
}
