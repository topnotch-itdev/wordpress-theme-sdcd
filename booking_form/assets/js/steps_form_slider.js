$(document).ready(function() {
    //DOM elements
    const DOMstrings = {
        stepsBtnClass: 'multisteps-form__progress-btn',
        stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
        stepsBar: document.querySelector('.multisteps-form__progress'),
        stepsForm: document.querySelector('.sidebar_form'),
        stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
        stepFormPanelClass: 'steps-body',
        stepFormPanels: document.querySelectorAll('.steps-body'),
        stepPrevBtnClass: 'js-btn-prev',
        stepNextBtnClass: 'js-btn-next'
    };


    //remove class from a set of items
    const removeClasses = (elemSet, className) => {
        elemSet.forEach(elem => {
            elem.classList.remove(className);
        });
    };

    //return exect parent node of the element
    const findParent = (elem, parentClass) => {
        let currentNode = elem;
        let parentNode = $(currentNode).parents(`.${parentClass}`);
        if (parentNode.length > 0) currentNode = parentNode[0];

        return currentNode;
    };

    //get active button step number
    const getActiveStep = elem => {
        return Array.from(DOMstrings.stepsBtns).indexOf(elem);
    };

    //set all steps before clicked (and clicked too) to active
    const setActiveStep = activeStepNum => {
        //remove active state from all the state
        removeClasses(DOMstrings.stepsBtns, 'js-active');

        //set picked items to active
        DOMstrings.stepsBtns.forEach((elem, index) => {
            if (index <= activeStepNum) {
                elem.classList.add('js-active');
            }
        });
    };

    //get active panel
    const getActivePanel = () => {
        let activePanel;
        DOMstrings.stepFormPanels.forEach(elem => {
            if (elem.classList.contains('js-active')) {
                activePanel = elem;
            }
        });

        return activePanel;
    };

    //open active panel (and close unactive panels)
    const setActivePanel = activePanelNum => {
        //remove active class from all the panels
        removeClasses(DOMstrings.stepFormPanels, 'js-active');

        //show active panel
        DOMstrings.stepFormPanels.forEach((elem, index) => {
            if (index === activePanelNum) {
                elem.classList.add('js-active');
                setFormHeight(elem);
            }
        });
    };

    //set form height equal to current panel height
    const formHeight = activePanel => {
        const activePanelHeight = activePanel.offsetHeight;
        DOMstrings.stepsForm.style.height = `${activePanelHeight > 550 ? activePanelHeight : 550 }px`;
    };

    const setFormHeight = () => {
        const activePanel = getActivePanel();
        formHeight(activePanel);
    };

    $(document).on('click', `.${DOMstrings.stepNextBtnClass}`, function (e) {
        e.preventDefault();

        // Check the input value status
        const currentStep = $(this).data('steps');
        if (currentStep === "steps-inputcode") {
            if ($('input[name="first_address"]').val() === "") {
                $('input[name="first_address"]').focus();
                $('input[name="first_address"]').addClass('empty-check');
                return;
            }
            if ($('input[name="second_address"]').val() === "") {
                $('input[name="second_address"]').focus();
                $('input[name="second_address"]').addClass('empty-check');
                return;
            }
        } else if (currentStep === "select-vehicle") {
            const vehicleType = $('input[name="vehicle_type"]:checked').val();
            if (typeof vehicleType === "undefined") return;
        } else if (currentStep === "select-time") {
            if ($('#select-hour').val() === "hour") return;
            if ($('#select-minutes').val() === "minutes") return;
        } else if (currentStep === "steps-info") {
            if ($('input[name="user_name"]').val() === "") {
                $('input[name="user_name"]').focus();
                $('input[name="user_name"]').addClass('empty-check');
                return;
            }
            
            const userEmail = $('input[name="user_email"]').val();
            if ( userEmail === "" || !isEmail(userEmail)) {
                $('input[name="user_email"]').focus(); 
                $('input[name="user_email"]').addClass('empty-check');
                return;
            }

            const userPhone = $('input[name="user_phone"]').val();
            if ( userPhone === "" || !isPhone(userPhone)) {
                $('input[name="user_phone"]').focus(); 
                $('input[name="user_phone"]').addClass('empty-check');
                return;
            }
        }


        const eventTarget = e.target;

        //find active panel
        const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
        let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

        //set active step and active panel onclick
        activePanelNum++;

        // To skip the Select time panel.
        if (currentStep === "pick-date") {
            const pickDate = $('input[name="pick_date"]:checked').val();
            const pickDay = $('#pick-day').val();
            const pickMonth = $('#pick-month').val();

            if (typeof pickDate === "undefined" && (pickDay === "Day" || pickMonth === "Month")) return;
            if (pickDate === "Urgent") {
                activePanelNum += 1;
                $('.steps-info .steps_number').html('<img src="/wp-content/themes/sdcd/booking_form/assets/imgs/step4.svg" alt="step4">');
            } 
        }
        
        // Set to thank you panel.
        if (currentStep === "steps-info") {
            const vehicleType = $('input[name="vehicle_type"]:checked').val();
            if (vehicleType === "notsure_van") activePanelNum = 6;
        }

        setActiveStep(activePanelNum);
        setActivePanel(activePanelNum);

        
        $('html, body').animate({
            scrollTop: $(".sidebar-container #booking_form").offset().top - 100
        }, 500);
        
        const animating = $('.sidebar_form .js-active').data('animation');
        $('.sidebar_form .js-active').addClass(animating)
        setTimeout(() => {
            removeClasses(DOMstrings.stepFormPanels, animating);
        }, 1000);
        
    });

    $(document).on('click', `.${DOMstrings.stepPrevBtnClass}`, function (e) {
        e.preventDefault();
        const eventTarget = e.target;

        //find active panel
        const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
        let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

        //set active step and active panel onclick
        activePanelNum--;
        
        const currentStep = $(this).data('steps');
        const pickDate = $('input[name="pick_date"]:checked').val();
        // to skip the Select time panel.
        if (currentStep === "steps-info" && pickDate === "Urgent") {
            activePanelNum -= 1;
            $('.steps-info .steps_number').html('<img src="/wp-content/themes/sdcd/booking_form/assets/imgs/step5.svg" alt="step5">');
        }

        setActiveStep(activePanelNum);
        setActivePanel(activePanelNum);
    });


    //SETTING PROPER FORM HEIGHT ONLOAD
    window.addEventListener('load', setFormHeight, false);

    //SETTING PROPER FORM HEIGHT ONRESIZE
    window.addEventListener('resize', setFormHeight, false);
    
    
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
      
    function isPhone(userPhone) {
        var regex = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/; 
        return regex.test(userPhone);
    }
});
