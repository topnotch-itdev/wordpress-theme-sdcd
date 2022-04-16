

$(document).ready(function () {



    var $intouchName = $('.intouch-user-info input[name="intouch_name"]');

    var $intouchEmail = $('.intouch-user-info input[name="intouch_email"]');

    var $intouchPhone = $('.intouch-user-info input[name="intouch_phone"]');



    var $intouchOrigin = $('.intouch-postinfo input[name="intouch_origin"]');

    var $intouchDest = $('.intouch-postinfo input[name="intouch_dest"]');



    // Set the hover text color of vans in Select a Vehicle panel

    $(document).on('mouseover', '.intouch-vehicle .intouch-vehicle-group .form-check', function () {

        if ($(this).attr('class').indexOf('selected') < 0) {

            $(this).find('.form-check-label > p').css('cssText', 'color: #18A754;font-weight:700;font-size:12px;');

            const checkedClass = $(this).find('.form-check-label > span').attr('class');

            const selectedClass = `${checkedClass}-checked`;



            $(this).find('.form-check-label > span').attr('class', selectedClass);

            $(this).find('.form-check-label > span').addClass('vehicle-icon-checked');

        }

    });

    $(document).on('mouseout', '.intouch-vehicle .intouch-vehicle-group .form-check', function () {

        $('.intouch-vehicle .intouch-vehicle-group .form-check').each((i, e) => {

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

    $(document).on('change', '.intouch-vehicle .intouch-vehicle-group .form-check', function () {

        $('.intouch-vehicle .intouch-vehicle-group .form-check').each((i, e) => {

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







    var vehicleInfo = [

        { type: "motorcycle", price: 0.90, name: "Motorcycle" },

        { type: "small_van", price: 0.90, name: "Small Van" },

        { type: "large_van", price: 1.00, name: "Large Van" },

        { type: "lift_van", price: 1.50, name: "Lift Van" },

        { type: "extra_large_van", price: 1.40, name: "Extra Large Van" },

        { type: "refriger_van", price: 1.30, name: "Refrigerated Van" },

        { type: "lorry", price: 2.00, name: "Lorry" },

    ];

    // Action when user click get started button

    $(document).on('click', '.intouch-footer .intouch_started', function (e) {

        e.preventDefault();

        gtag('event', 'Callback', {
            'event_category': 'Callback',
            'event_label': 'Callback'
        });


        // Check user details info.

        if ($intouchName.val() === "") {

            $intouchName.addClass('empty-check');

            $intouchName.focus();

            return;

        }

        if ($intouchEmail.val() === "" || !isEmail($intouchEmail.val())) {

            $intouchEmail.addClass('empty-check');

            $intouchEmail.focus();

            return;

        }

        if ($intouchPhone.val() === "" || !isPhone($intouchPhone.val())) {

            $intouchPhone.addClass('empty-check');

            $intouchPhone.focus();

            return;

        }



        // Check postcode validation

        if ($intouchOrigin.val() === "") {

            $intouchOrigin.addClass('empty-check');

            $intouchOrigin.focus();

            return;

        }

        if ($intouchDest.val() === "") {

            $intouchDest.addClass('empty-check');

            $intouchDest.focus();

            return;

        }



        const $vehicleType = $('.intouch-vehicle input[name="intouch_vehicle_type"]:checked');

        if (typeof $vehicleType.val() === "undefined") {

            return;

        }


        // Set the data to CRM

        const fullName = $('#intouch_form input[name="intouch_name"]').val();

        const userEmail = $('#intouch_form input[name="intouch_email"]').val();

        const userPhone = $('#intouch_form input[name="intouch_phone"]').val();



        const firstAddress = $('#intouch_form input[name="intouch_origin"]').val();

        const firstCode = $('#intouch_form input[name="intouch_origin_code"]').val();

        const secondAddress = $('#intouch_form input[name="intouch_dest"]').val();

        const secondCode = $('#intouch_form input[name="intouch_dest_code"]').val();

        
        const distance = $('#intouch_form input[name="intouch_distance"]').val();

        const vehicleType = $('#intouch_form input[name="intouch_vehicle_type"]:checked').val();

        if (typeof vehicleType === "undefined") return;

        const vehiclePrice = vehicleInfo.find((val) => (val.type === vehicleType));


        // Adding imposed price like city of London...
        var imposedPrice = 0
        if (firstAddress.indexOf('M25') !== -1 || secondAddress.indexOf('M25') !== -1) {
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

                distancePrice = parseFloat(distance) * (vehiclePrice.price + imposedPrice);

            }

        }

        // Added 20 GBP when post codes include
        if (checkPostCodes(originAddress) || checkPostCodes(destAddress)) {
            distancePrice += 20;
        }


        const deliverPrice = (distancePrice === 0 || distance === "") ? 0 : distancePrice.toFixed(2);








        const selected = vehicleInfo.filter((val) => val.type === vehicleType);

        const vehicleName = selected.length > 0 ? selected[0].name : vehicleType == "notsure_van" ? "No vehicle selected" : "";

        const pageURL = window.location.href;

        const duration = $('#intouch_form input[name="intouch_duration"]').val();

        const addDetails = $('#intouch_form textarea[name="additional_details"]').val();





        const contactInfo = {

            action: "intouch_form",

            order_type: "Request callback",

            full_name: fullName,

            email: userEmail,

            phone: userPhone,

            collection_address: firstAddress,

            collection_postcode: firstCode,

            deliver_address: secondAddress,

            deliver_postcode: secondCode,

            vehicle_type: vehicleName,

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

            success: function (res) { },

            error: function (e) { }

        });



        $('.intouch-container .info-container').css('display', 'none');

        $('.intouch-container .enquiry-container').css('display', 'block');

        $('.intouch-container .enquiry-container').addClass('fadeInLeftShort');



    });





    $intouchName.on('input', function () {

        $(this).removeClass('empty-check')

    });

    $intouchEmail.on('input', function () {

        $(this).removeClass('empty-check')

    });

    $intouchPhone.on('input', function () {

        $(this).removeClass('empty-check')

    });

    $intouchOrigin.on('input', function () {

        $(this).removeClass('empty-check')

    });

    $intouchDest.on('input', function () {

        $(this).removeClass('empty-check')

    });





    var getPostalCode = function (addressInfo) {

        var postCode = addressInfo.filter((val) => val.types[0] == "postal_code");

        return postCode[0].long_name;

    }

    // Set the address by postcode

    $('input[name="intouch_origin"]').on('change', function () {

        setTimeout(function () {

            let originAddress = ($('input[name="intouch_origin"]').val()).trim();

            let destAddress = ($('input[name="intouch_dest"]').val()).trim();

            (async () => {

                try {

                    if (originAddress === "") {

                        $('input[name="intouch_origin_code"]').val("");

                        return;

                    }

                    const result = await getAddressBy(originAddress);

                    if (result !== "failed") {

                        const postalCode = getPostalCode(result.address_components);

                        // Set postal code

                        $('#intouch_form input[name="intouch_origin_code"]').val(postalCode);

                    } else $(this).focus();





                    // Get the miles between two location

                    if (originAddress !== "" && destAddress !== "") {

                        const distanceRes = await getDistanceMatrix(originAddress, destAddress);

                        console.log(distanceRes, "===distanceRes");

                        const distance = distanceRes.rows[0].elements[0].distance.text.replace('mi', '');

                        const duration = distanceRes.rows[0].elements[0].duration.text;



                        $('#intouch_form input[name="intouch_distance"]').val(distance);

                        $('#intouch_form input[name="intouch_duration"]').val(duration);

                    }

                } catch (error) { console.warn(error) }

            })();

        }, 120);

    });

    $('input[name="intouch_dest"]').on('change', function () {

        setTimeout(function () {

            let originAddress = ($('input[name="intouch_origin"]').val()).trim();

            let destAddress = ($('input[name="intouch_dest"]').val()).trim();



            (async () => {

                try {

                    if (destAddress === "") {

                        $('input[name="intouch_dest_code"]').val("");

                        return;

                    }

                    const result = await getAddressBy(destAddress);

                    if (result !== "failed") {

                        const postalCode = getPostalCode(result.address_components);

                        // Set postal code

                        $('#intouch_form input[name="intouch_dest_code"]').val(postalCode);

                    } else $(this).focus();





                    // Get the miles between two location

                    if (originAddress !== "" && destAddress !== "") {

                        const distanceRes = await getDistanceMatrix(originAddress, destAddress);

                        console.log(distanceRes, "===distanceRes");

                        const distance = distanceRes.rows[0].elements[0].distance.text.replace('mi', '');

                        const duration = distanceRes.rows[0].elements[0].duration.text;



                        $('#intouch_form input[name="intouch_distance"]').val(distance);

                        $('#intouch_form input[name="intouch_duration"]').val(duration);

                    }

                } catch (error) { }

            })();

        }, 120);

    });





    // Set the height in Get in touch 

    $('.get-in-touch-title').parents('.vc_column_container').css('max-height', '72px');





    $(window).resize(function () {

        const width = $(this).innerWidth();

        if (width > 1350) {

            let marginLeft = (width - 1000) / 8,

                marginRight = marginLeft;

            $('.intouch-container').css('cssText', `margin-left:${marginLeft}px; margin-right:${marginRight}px`);

        } else {

            $('.intouch-container').removeAttr('style');

        }

    });





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