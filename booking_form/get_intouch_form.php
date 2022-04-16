<?php

add_shortcode('get_in_touch_form', 'get_in_touch_form');

function get_in_touch_form() {
    
    $getInTouchFrom = '
        <div class="intouch-container">
            <form class="intouch-form" id="intouch_form">
                <div class="intouch-body info-container">
                    <div class="intouch-content">
                        <div class="intouch-info">
                            <div class="intouch-header">
                                <span class="panel-number">1</span>
                                <p class="title intouch-info-title">Enter Your Details</p>
                            </div>
                            <div class="intouch-user-info">
                                <input type="text" name="intouch_name" placeholder="Full Name (e.g. John Doe)">
                                <input type="text" name="intouch_email" placeholder="Email (e.g. johndoe@live.co.uk)">
                                <input type="text" name="intouch_phone" placeholder="Phone: (e.g. 07890123345)">
                                <textarea name="additional_details" placeholder="Describe the item or special requests. e.g. I have a pallet of antique goods, the driver may need a pump truck to deliver."></textarea>
                            </div>
                        </div>
                        <div class="intouch-postcode">
                            <div class="intouch-header">
                                <span class="panel-number">2</span>
                                <p class="title">Enter Your Pickup & Delivery Address</p>
                            </div>
                            <div class="intouch-postinfo">
                                <div>
                                    <input type="text" name="intouch_origin" id="intouch_origin" placeholder="Enter Your Collection Address">
                                    <input type="text" name="intouch_origin_code" disabled>
    
                                    <input type="text" name="intouch_dest" id="intouch_dest" placeholder="Enter Your Delivery Address">
                                    <input type="text" name="intouch_dest_code" disabled>
                                    
                                    <input type="hidden" name="intouch_distance">
                                    <input type="hidden" name="intouch_duration">
                                </div>
                                <img src="/wp-content/themes/sdcd/booking_form/assets/imgs/code_group.svg" alt="code group">
                            </div>
                        </div>
                        <div class="intouch-vehicle">
                            <div class="intouch-header">
                                <span class="panel-number">3</span>
                                <p class="title">Select a Vehicle</p>
                            </div>
                            <div class="intouch-vehicle-group">
                                <div class="vehicle-column">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_motorcycle"
                                            value="motorcycle">
                                        <label class="form-check-label" for="intouch_motorcycle">
                                            <span class="vehicle-icon motor-cycle"></span>
                                            <p>Motorcycle</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_small_van"
                                            value="small_van">
                                        <label class="form-check-label" for="intouch_small_van">
                                            <span class="vehicle-icon small-van"></span>
                                            <p>Small Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_large_van"
                                            value="large_van">
                                        <label class="form-check-label" for="intouch_large_van">
                                            <span class="vehicle-icon large-van"></span>
                                            <p>Large Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_lift_van" value="lift_van">
                                        <label class="form-check-label" for="intouch_lift_van">
                                            <span class="vehicle-icon lift-van"></span>
                                            <p>Lutton Tail Lift Van</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="vehicle-column">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_extra_large_van"
                                            value="extra_large_van">
                                        <label class="form-check-label" for="intouch_extra_large_van">
                                            <span class="vehicle-icon extra-large-van"></span>
                                            <p>Extra Large Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_lorry" value="lorry">
                                        <label class="form-check-label" for="intouch_lorry">
                                            <span class="vehicle-icon lorry"></span>
                                            <p>Lorry</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_refriger_van"
                                            value="refriger_van">
                                        <label class="form-check-label" for="intouch_refriger_van">
                                            <span class="vehicle-icon refriger-van"></span>
                                            <p>Refrigerated Van</p>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="intouch_vehicle_type" id="intouch_notsure_van"
                                            value="notsure_van">
                                        <label class="form-check-label" for="intouch_notsure_van">
                                            <span class="vehicle-icon notsure-van"></span>
                                            <p>I\'m not sure</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intouch-footer">
                        <button class="intouch_started">Get Started</button>
                    </div>
                </div>

                <div class="intouch-body enquiry-container">
                    <img class="intouch-check-desk" src="/wp-content/themes/sdcd/booking_form/assets/imgs/green_check.svg" alt="green check">
                    <div class="intouch-enquiry">
                        <div class="enquiry-header">
                            <img class="ornament-left" src="/wp-content/themes/sdcd/booking_form/assets/imgs/ornament_lines.svg" alt="ornament left">
                            <img class="ornament-right" src="/wp-content/themes/sdcd/booking_form/assets/imgs/ornament_lines.svg" alt="ornament right">
                        </div>
                        <div class="enquiry-content">
                            <img class="intouch-check-mobile" src="/wp-content/themes/sdcd/booking_form/assets/imgs/green_check.svg" alt="green check">
                            <h2>Thank you <br/> for your enquiry</h2>
                            <hr/>
                            <p>Our team will be in touch with you shortly with best possible prices. Remember - we can deliver your parcel today at rock bottom prices.</p>
                        </div>
                        <img class="enquiry-thumbs" src="/wp-content/themes/sdcd/booking_form/assets/imgs/thumbs_up.svg" alt="enquiry thumbs">
                    </div>
                </div>
            </form>
        </div>';

    return $getInTouchFrom;
}