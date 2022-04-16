'use strict';

var $ = jQuery.noConflict();

var PartnersSlider = (function() {
	var doIt;

	function setupListeners() {
		$(window).on('resize', _checkForResizeEnd);
	}

	function _checkForResizeEnd() {
	  clearTimeout(doIt);

	  doIt = setTimeout(_updateDynamicStyles, 100);

	  setTimeout(_updateDynamicStyles, 500);
	};

	function _updateDynamicStyles() {
		var $logoItems = $('.u-logos__item');
		var $logoBgs = $('.u-logos__item-bg');
		var height = $logoItems.width();
	
		$logoBgs.css('height', height);
	}

	function _initSlider() {
		$('.u-logos').lightSlider({
			item: 6,
			slideMargin: 20,
			pager: false,
			controls: false,
			responsive: [
				{
					breakpoint: 800,
					settings: {
						item: 4
					}
				},
				{
					breakpoint: 500,
					settings: {
						item: 3,
						controls: false
					}
				},
				{
					breakpoint: 400,
					settings: {
						item: 2
					}
				}
			],
			onSliderLoad: function() {
				$('.u-logos').removeClass('cS-hidden');
				_updateDynamicStyles();
			}
		});
	}

	return {
		init: function() {
			if ($('.u-logos').length > 0) {
				setupListeners();
				_initSlider();
			}
		}
	}
}());

var WPCF7 = (function() {
	function setupListeners() {
		$('.wpcf7 input[aria-required="true"]').on('input', _validate);
		$('.wpcf7').on('wpcf7:mailsent', _showThankYou);
		$('.s-editorial__checkboxes').on('click', '.wpcf7-list-item-label', _changeRadioButtonValue);
	}

	function _changeRadioButtonValue() {
		var $this = $(this);

		$this.prev().prop('checked', true);
	}

	function _invalid(elem) {
		elem.removeClass('wpcf7-valid').addClass('wpcf7-not-valid');
	}

	function _valid(elem) {
		elem.removeClass('wpcf7-not-valid').addClass('wpcf7-valid');
	}

	function _showThankYou() {
		var $this = $(this);

		$this.siblings().hide();
		$this.find('.wpcf7-body').hide();
		$this.find('.wpcf7-thank-you').show();
	}

	function _validateEmail(email) {
		return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
	}

	function _validate() {
		var $this = $(this);
		var type = $this.attr('type');
		var val = $this.val();

		if (type == 'text') {
			val != '' ? _valid($this) : _invalid($this);
		} else if (type == 'email') {
			_validateEmail(val) ? _valid($this) : _invalid($this);
		} else if (type == 'tel') {
			/^\d+$/.test(val) ? _valid($this) : _invalid($this);
		}
	}

	return {
		init: function() {
			setupListeners();
		}
	}
}());

var WordRotate = (function() {
	function _init() {
		$('.word-rotate').each(function() {
			var $this = $(this);
			var $itemsWrapper = $this.find('.word-rotate-items');
			var $items = $itemsWrapper.find('> span');
			var $firstItem = $items.eq(0);
			var $firstItemClone = $firstItem.clone();
			var itemHeight = 0;
			var currentItem = 1;
			var currentTop = 0;

			itemHeight = $firstItem.height();

			$itemsWrapper.append($firstItemClone);

			$this.height(itemHeight).addClass('active');

			setInterval(function() {
				currentTop = (currentItem * itemHeight);

				$itemsWrapper.animate({
					top: -(currentTop) + 'px'
				}, 300, 'easeOutQuad', function() {
					currentItem++;

					if (currentItem > $items.length) {
						$itemsWrapper.css('top', 0);

						currentItem = 1;
					}
				});
			}, 2000);
		});
	}

	return {
		init: function() {
			_init();
		}
	}
}());

var ReviewsSlider = (function() {
	function _initSlider() {
		$('.c-reviews-slider').lightSlider({
			item: 1,
			pager: true,
			controls: false,
			onSliderLoad: function() {
				$('.c-reviews-slider').removeClass('cS-hidden');
			}
		});
	}

	return {
		init: function() {
			if ($('.c-reviews-slider').length > 0) {
				_initSlider();
			}
		}
	}
}());

var FixedForm = (function() {
	function setupListeners() {
		$(window).on('scroll', _toggleFixedLayout);
		$(window).on('resize', _toggleFixedLayout);
	}

	function _toggleFixedLayout() {
		var $sidebar = $('.s-editorial__layout-right .wpcf7');
		var $content = $('.s-editorial__layout-left');
		var contentStartPosition = $content.offset().top;
		var contentEndPosition = contentStartPosition + $content.height();
		var currentPosition = document.documentElement.scrollTop;
		var headerHeight = $('.js-siteheader').height();
		var windowWidth = $('body').prop('clientWidth');
	
		if (windowWidth >= 1180 && (currentPosition + headerHeight) > contentStartPosition && $(window).height() > 750) {
			$sidebar.addClass('s-editorial__layout-right--fixed').removeClass('s-editorial__layout-right--fixed-bottom');

			if (contentEndPosition < $sidebar.height() + headerHeight + currentPosition) {
				$sidebar.addClass('s-editorial__layout-right--fixed-bottom').removeClass('s-editorial__layout-right--fixed');
			}
		} else {
			$sidebar.removeClass('s-editorial__layout-right--fixed').removeClass('s-editorial__layout-right--fixed-bottom');
		}
	}

	return {
		init: function() {
			if ($('.s-editorial__layout-right').length > 0) {
				setupListeners();
				_toggleFixedLayout();	
			}
		}
	}
}());

var VerticalSlideForm = (function() {
    var slider;
    
    function setupListeners() {
        var $document = $(document);
        
        $document.on('click', '.vertical-slider-form__next-step', _nextStep);
        $document.on('click', '.vertical-slide-form__step-inner .wpcf7-list-item label', _activateCheckbox);
    }
    
    function _activateCheckbox() {
        $(this).addClass('checked')
            .parent().siblings().children('label').removeClass('checked');
    }
    
    function _nextStep(e) {
        e.preventDefault();
        
        var $inputs = $(this).closest('.vertical-slide-form__step').find('input');
        
        if ($inputs.length == 1 && $inputs.val()) {
            slider.goToNextSlide();
        } else if ($inputs.length) {
            var isAtLeastOneChecked = false;
            
            $inputs.each(function() {
                if ($(this).is(':checked')) {
                    isAtLeastOneChecked = true;
                }    
            });
            
            if (isAtLeastOneChecked) {
                slider.goToNextSlide();
            }
        }
    }
    
    function _initSlider() {
        slider = $('.vertical-slide-form').lightSlider({
            vertical: true,
            controls: false,
            item: 1,
            // autoWidth: true,
            pager: false,
            // freeMove: false,
            enableTouch: false,
            enableDrag: false
        });
    }
    
    return {
        init: function() {
            setupListeners();
            _initSlider();
        }
    }
}());

function initAutocomplete() {
    var collectionPostCodeInput = document.getElementById('collection');
    var deliveryPostcodeInput = document.getElementById('delivery');
    var $collectionPostcode = $('#collection');
    var $deliveryPostcode = $('#delivery');
    
    var options = {
        componentRestrictions: {
            country: 'gb'
        }
    };
    
    if ($collectionPostcode.length) {
        var autocomplete = new google.maps.places.Autocomplete(collectionPostCodeInput, options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            
            console.log(place);
            
            var postcode;
            
            for (var i = 0; i < place.address_components.length; i++) {
                var types = place.address_components[i].types;
                
                for (var type of types) {
                    if (type === "postal_code") {
                        postcode = place.address_components[i].long_name;
                    }
                }
            }
            
            if (!postcode) {
                postcode = place.formatted_address;
            }
            
            console.log(postcode);
            $collectionPostcode.val(postcode);
        });
    }
    
    if ($deliveryPostcode.length) {
        var autocomplete2 = new google.maps.places.Autocomplete(deliveryPostcodeInput, options);

        autocomplete2.addListener('place_changed', function() {
            var place = autocomplete2.getPlace();
            var postcode;
            
            for (var i = 0; i < place.address_components.length; i++) {
                var types = place.address_components[i].types;
                
                for (var type of types) {
                    if (type === "postal_code") {
                        postcode = place.address_components[i].long_name;
                    }
                }
            }
            
            if (!postcode) {
                postcode = place.formatted_address;
            }
            
            console.log(postcode);
            $deliveryPostcode.val(postcode);
        });
    }
}

var ClinksForm = (function() {
	function setupListeners() {
		$('.clinks-form').on('submit', _filterCities);
	}
	
	function _filterCities(e) {
		e.preventDefault();
		
		$.ajax({
			url: php_vars.ajax_url,
			type: 'POST',
			data: {
				action: 'search_cities_and_towns',
				s: $(this).find('input').val().toLowerCase()
			},
			success: function(data) {
				var response = JSON.parse(data);
				
				$('.clinks_towns').html(response.towns_html);
				$('.clinks_cities').html(response.cities_html);
				
				$('html, body').animate({
					scrollTop: $('.clinks-form').offset().top
				});
			}
		})
	}
	
	return {
		init: function() {
			setupListeners();
		}
	}
}());

$(document).ready(function() {
	PartnersSlider.init();
	WPCF7.init();
	WordRotate.init();
	ReviewsSlider.init();
	FixedForm.init();
	VerticalSlideForm.init();
	ClinksForm.init();
});