$(document).ready(function () {

    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var date = new Date();
    var year = date.getFullYear();
    var currentMonth = date.getMonth();
    var month = date.toLocaleString('default', { month: 'long' });
    var today = date.getDate();
    
    var setPickDate = function() {
        $('#pick-day').val(today.toString());
        $('#pick-month').val(month.toString());
        $('#pick-year').val(year.toString());
    }
    setPickDate();
    
    // Set the background in Pick a Delivery Date panel
    $(document).on('click', '.pick-date .steps-content .pick-date-group .form-check', function(e) {
        e.preventDefault();
        $('input[name="pick_date"]').each((i, e) => {
            $(e).parent().removeAttr('style');
        });
        
        $(this).css('background', '#18A754');
        $(this).find('input[name="pick_date"]').prop('checked', true)
        
        // Reset the choose date
        setPickDate();
    });

    // Set the hover text color of vans in Select a Vehicle panel
    $(document).on('mouseover', '.select-vehicle .steps-content .form-check', function () {
        if ($(this).attr('class').indexOf('selected') < 0) {
            $(this).find('.form-check-label > p').css('cssText', 'color: #18A754;font-weight:700;font-size:12px;');
            const checkedClass = $(this).find('.form-check-label > span').attr('class');
            const selectedClass = `${checkedClass}-checked`;
    
            $(this).find('.form-check-label > span').attr('class', selectedClass);
            $(this).find('.form-check-label > span').addClass('vehicle-icon-checked');
        }
    });
    $(document).on('mouseout', '.select-vehicle .steps-content .form-check', function () {
        $('.select-vehicle .steps-content .form-check').each((i, e) => {
            if ($(e).attr('class').indexOf('selected') < 0) {
                $(e).find('.form-check-label > p').removeAttr('style');
                $(e).find('.form-check-label > span').removeClass('vehicle-icon-checked');

                const checkedClass = $(e).find('.form-check-label > span').attr('class');
                const selectedClass = checkedClass.replace('-checked', '');
                
                $(e).find('.form-check-label > span').attr('class', selectedClass);
            }
        })
    });

    // Set the selected style to vans
    $(document).on('change', '.select-vehicle .steps-content .form-check', function () {
        $('.select-vehicle .steps-content .form-check').each((i, e) => {
            $(e).removeClass('selected');
            $(e).find('.vehicle-icon').removeClass('vehicle-icon-checked');
            $(e).find('p').removeAttr('style');

            const checkedClass = $(e).find('.vehicle-icon').attr('class');
            const selectedClass = checkedClass.replace('-checked', '');
            $(e).find('.vehicle-icon').attr('class', selectedClass);
        })
        $(this).addClass('selected');

        const checkedClass = $(this).find('.vehicle-icon').attr('class');
        const selectedClass = `${checkedClass}-checked`;
        $(this).find('.vehicle-icon').attr('class', selectedClass);

        $(this).find('.vehicle-icon').addClass('vehicle-icon-checked');
        $(this).find('.form-check-label > p').css('cssText', 'color: #18A754;font-weight:700;font-size:12px;');
    });
    

    // Remove empty-alert outline when user focus to input text tag.
    $(document).on('input', '.sidebar-container .sidebar_form input', function() {
        $(this).removeClass('empty-check');
    });
    
    
    // Release the selected date when user choose a date
    $(document).on('change', '#pick-day', function() {
        $('.pick-date input[name="pick_date"]:checked').parent().removeAttr('style');
        $('.pick-date input[name="pick_date"]:checked').prop('checked', false);
    });
    $(document).on('change', '#pick-month', function() {
        $('.pick-date input[name="pick_date"]:checked').parent().removeAttr('style');
        $('.pick-date input[name="pick_date"]:checked').prop('checked', false);
        
        var monthName = $(this).val()
        var monthNum = monthNames.indexOf(monthName)
        var daysInMonth = new Date(year, (monthNum + 1), 0).getDate();

        $('#pick-day option').each((i, e) => {
            var date = $(e).val();
            
            if (monthNum > currentMonth) {
                $(e).removeAttr('disabled');
            } else {
                if (monthNum === currentMonth && today > date) $(e).prop('disabled', true);
                else $(e).removeAttr('disabled');
    
                if (monthNum < currentMonth) $(e).prop('disabled', true);
            }

            if (date > daysInMonth) {
                $(e).prop('disabled', true);
            }
        })
    });
    $(document).on('change', '#pick-year', function() {
        $('.pick-date input[name="pick_date"]:checked').parent().removeAttr('style');
        $('.pick-date input[name="pick_date"]:checked').prop('checked', false);
		
        var selectedYear = $(this).val()
        $('#pick-month option').each((i, e) => {
            var month = $(e).val();
            var monthNum = monthNames.indexOf(month)
            
            if (selectedYear > year) {
                $(e).removeAttr('disabled');
            } else {
                if (monthNum < currentMonth) $(e).prop('disabled', true);
            }
        })
    });
    
    
    var getPostalCode = function(addressInfo) {
        var postCode = addressInfo.filter((val) => val.types[0] == "postal_code");
        return postCode[0].long_name;
    }

    // Set the address by postcode
    $('input[name="first_address"]').on('change', function () {
        setTimeout(function() {
            let originAddress = ($('input[name="first_address"]').val()).trim();
            let destAddress = ($('input[name="second_address"]').val()).trim();
            (async () => {
                try {
                    if (originAddress === "") {
                        $('input[name="first_postcode"]').val("");
                        return;
                    }
                    const result = await getAddressBy(originAddress);    
                    if (result !== "failed") {
                        const postalCode = getPostalCode(result.address_components);
                        // Set postal code
                        $('#booking_form input[name="first_postcode"]').val(postalCode);
                    } else $(this).focus();
    
    
                    // Get the miles between two location
                    if (originAddress !== "" && destAddress !== "") {    
                        const distanceRes = await getDistanceMatrix(originAddress, destAddress);
                        const distance = distanceRes.rows[0].elements[0].distance.text.split(' ')[0];
                        const duration = distanceRes.rows[0].elements[0].duration.text;
                        
                        $('#booking_form input[name="location_distance"]').val(distance);
                        $('#booking_form .duration').html(duration);
                    }
                } catch (error) { console.warn(error)}
            })();
        }, 120);
    });
    $('input[name="second_address"]').on('change', function () {
        setTimeout(function() {
            let originAddress = ($('input[name="first_address"]').val()).trim();
            let destAddress = ($('input[name="second_address"]').val()).trim();

            (async () => {
                try {
                    if (destAddress === "") {
                        $('input[name="second_postcode"]').val("");
                        return;
                    }
                    const result = await getAddressBy(destAddress);
                    if (result !== "failed") {
                        const postalCode = getPostalCode(result.address_components);
                        // Set postal code
                        $('#booking_form input[name="second_postcode"]').val(postalCode);
                    } else $(this).focus();
        
        
                    // Get the miles between two location
                    if (originAddress !== "" && destAddress !== "") {    
                        const distanceRes = await getDistanceMatrix(originAddress, destAddress);
                        const distance = distanceRes.rows[0].elements[0].distance.text.split(' ')[0];
                        const duration = distanceRes.rows[0].elements[0].duration.text;
                        
                        $('#booking_form input[name="location_distance"]').val(distance);
                        $('#booking_form .duration').html(duration);
                    }
                } catch (error) {}
            })();
        }, 120);
    });



    // When user start the typing, will be added text upper class.
    $('input[name="first_address"]').on('input', function() {
        var firstAddress = $(this).val();
        if (firstAddress !== "") $(this).addClass('text-upper');
        else $(this).removeClass('text-upper');
    });
    $('input[name="second_address"]').on('input', function() {
        var firstAddress = $(this).val();
        if (firstAddress !== "") $(this).addClass('text-upper');
        else $(this).removeClass('text-upper');
    });
    
    
    
    var vehicleInfo = [
        { type: "motorcycle", price: 0.80, name: "Motorcycle" },
        { type: "small_van", price: 0.80, name: "Small Van" },
        { type: "large_van", price: 1.00, name: "Large Van" },
        { type: "lift_van", price: 1.50, name: "Lift Van" },
        { type: "extra_large_van", price: 1.40, name: "Extra Large Van" },
        { type: "refriger_van", price: 1.30, name: "Refrigerated Van" },
        { type: "lorry", price: 2.00, name: "Lorry" },
    ]
    $(document).on('click', '.steps-info .js-btn-next', function (e) {
        e.preventDefault();

        gtag('event', 'Quote', {
            'event_category': 'Quote Form',
            'event_label': 'Quote'
        });

        const distance = $('#booking_form input[name="location_distance"]').val();
        const duration = $('#booking_form .duration').html();
        
        const originAddress = $('#booking_form input[name="first_postcode"]').val();
        const destAddress = $('#booking_form input[name="second_postcode"]').val();
        const vehicleType = $('input[name="vehicle_type"]:checked').val();
        const vehiclePrice = vehicleInfo.find((val) => (val.type === vehicleType));
        
        // Adding imposed price like city of London...
        var imposedPrice = 0
        if (originAddress.indexOf('M25') !== -1 || destAddress.indexOf('M25') !== -1) {
            imposedPrice = 0.1
        }

        var distancePrice = 0;
        if (distance !== "" && distance < 40) {
            if (vehicleType === "motorcycle" || vehicleType === "small_van" || vehicleType === "large_van") {
                distancePrice = 30; 
            } else if (vehicleType === "lift_van" || vehicleType === "extra_large_van" || vehicleType === "refriger_van") {
                distancePrice = 40; 
            } else if (vehicleType === "lorry") {
                distancePrice = 100; 
            }
        } else {
            if (distance !== "" && vehicleType !== "notsure_van") {
                distancePrice = distance * (vehiclePrice.price + imposedPrice);
            }
        }
        
        // Added 20 GBP when post codes include
        if (checkPostCodes(originAddress) || checkPostCodes(destAddress)) {
            distancePrice += 20;
        }

        
        const deliverPrice = (distancePrice === 0 || distance === "") ? 0 : distancePrice.toFixed(2);

        $('#booking_form .steps-price .origin-address').html(`${originAddress !== "" ? originAddress : "XX1"}`);
        $('#booking_form .steps-price .dest-address').html(`${destAddress !== "" ? destAddress : "XX2"}`);
        $('#booking_form .steps-price .calc_price p:first-child').html(`£${deliverPrice}`);
        $('#booking_form .steps-price input[name="deliver_price"]').val(`${deliverPrice}`);
        
        
        // Set the data to CRM
        const fullName = $('#booking_form input[name="user_name"]').val();
        const userEmail = $('#booking_form input[name="user_email"]').val();
        const userPhone = $('#booking_form input[name="user_phone"]').val();

        const firstAddress = $('#booking_form input[name="first_address"]').val();
        const firstCode = $('#booking_form input[name="first_postcode"]').val();
        const secondAddress = $('#booking_form input[name="second_address"]').val();
        const secondCode = $('#booking_form input[name="second_postcode"]').val();

        const deliveryTime = $('#booking_form #select-hour').val();
        const pickDate = $('#booking_form input[name="pick_date"]:checked').val();
        const pickDay = $('#booking_form #pick-day').val();
        const pickMonth = $('#booking_form #pick-month').val();
        const pickYear = $('#booking_form #pick-year').val();
        
        
        if (fullName === "" || userEmail === "" || !isEmail(userEmail) || userPhone === "" || !isPhone(userPhone)) {
            return;
        }
        
        var deliveryDate = "";
        if (pickDate === "" || typeof pickDate === "undefined") {
            deliveryDate = `${pickDay} ${pickMonth}, ${pickYear}`;
        } else {
            deliveryDate = pickDate;
        }

        const selected = vehicleInfo.filter((val) => val.type === vehicleType);
        const vehicleName = selected.length > 0 ? selected[0].name : vehicleType == "notsure_van" ? "No vehicle selected" : "";
        const pageURL = window.location.href;
        const addDetails = $('#booking_form textarea[name="additional_details"]').val();
        
        const contactInfo = {
            action: "right_form",
            order_type: "A to B",
            full_name: fullName,
            email: userEmail,
            phone: userPhone,
            collection_address: firstAddress,
            collection_postcode: firstCode,
            deliver_address: secondAddress,
            deliver_postcode: secondCode,
            vehicle_type: vehicleName,
            delivery_date: deliveryDate,
            delivery_time: deliveryTime,
            price: deliverPrice,
            payment_status: "Unpaid",
            page_url: pageURL,
            distance: `${distance} mi`,
            duration: duration,
            addDetails: addDetails
        };

        $.ajax({
            url: "/wp-content/crm_active_campaign/init.php",
            type: "POST",
            data: contactInfo,
            dataType: "application/json",
            success: function(res) {},
            error: function(e) {}
        });
    });

    try {
        // Booking 
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("pk_live_51JDBI0DfvS5LbD5j3qAXFCJ7FctmVaIJahtUSWekNEkreJSiFavPF2e3NB9pfqHKbLhnr3OhxOGcdFrcT7qMlKDU0099jlHLXE");
        // var stripe = Stripe("pk_test_51JDBI0DfvS5LbD5jdyP18EyorIMS5Z6JR2Bj4VYiwExCm6cv4I0Yc8X6hDLkzWToaldml5U7LJ8pA0STw2lqbPzq009SBvv34c");
        
        var checkoutButton = document.getElementById("checkout_button");
    
        checkoutButton.addEventListener("click", function (e) {
            e.preventDefault();
            
            $('#checkout_button').attr('disabled', 'disabled');
            $('#checkout_button').css('background', '#2F80ED');
            $(this).css('display', 'none');
            $('.loading').css('display', 'block');
            
            const deliverPrice = $('#booking_form .steps-price input[name="deliver_price"]').val();
            const contact_email = $('#booking_form input[name="user_email"]').val() + ",RF";
            const formData = new FormData();
            formData.append('amount', deliverPrice);
            formData.append('contact_email', contact_email);
            
            fetch("/wp-content/stripe/create-checkout-session.php", {
                method: "POST",
                body: formData
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
    
                // If redirectToCheckout fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using error.message.
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error("Error:", error);
            });
        });
    } catch(e) {
        console.warn(e);
    }

    
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
      
    function isPhone(userPhone) {
        var regex = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/; 
        return regex.test(userPhone);
    }

    function checkPostCodes(postCode) {
        const posts = [
          'TR', 'TQ', 'PL', 'TA','EX', 'BN', 'NR', 'CO', 'PO', 'CT', 'PE', 'CB', 'HR', 'WR', 'DA', 'BH', 'NP'
        ];
        const matched = posts.map(val => postCode.indexOf(val) !== -1).find(fval => fval === true);

        return matched ? matched : false;
    }
});