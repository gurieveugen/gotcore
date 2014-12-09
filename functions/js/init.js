	var $ = jQuery.noConflict();

	$().ready(function() {
		$('.jqmWindow#vimeo-info').jqm({trigger: 'a#modal-vimeo-info', overlay:60});
		$('.jqmWindow#youtube-info').jqm({trigger: 'a#modal-youtube-info', overlay:60});
		$('.jqmWindow#vimeo-info').jqmAddClose('a.close'); 
	});

	$(document).ready(function() {
		try {
			$( ".datepicker" ).datepicker({
				altField: ".datepickeralt",
				altFormat: "DD, d MM, yy"
			});
		} catch(e) {

		}

		$('.modal-trigger').click(function(){
			var modalPos = $(window).scrollTop() + 70;
			$('.jqmWindow').css('top', modalPos + 'px');
		});
		
		if ($.browser.msie && $.browser.version.substr(0,1)<8) {
			$('#le-iexploder').show();
		}
		
		$('.colorpicker').jPicker({window:{expandable: true}});
		
		$('input.colorpicker, span.jPicker').click(function(){
				var modalPos = $(window).scrollTop() + 70;
			$('div.jPicker.Container').css('top', modalPos + 'px');
		});

 		$('span.expand').click(function(){
 		
 			var thisID = $(this).attr('id');
 			
			if($(this).parent('.le-title').parent('.le-section').hasClass('open')) {
				$(this).parent('.le-title').parent('.le-section').removeClass('open');
				$(this).text('+');
				$.cookie(thisID, 'collapsered');
			} else {
				$(this).parent('.le-title').parent('.le-section').addClass('open');
				$(this).text('-');
				$.cookie(thisID, 'expandered');
			}
		});
		
		$('a#collapse-all').click(function(){
			$('.le-section').removeClass('open');
			$('span.expand').text('+');
			$.cookie('span.expand', 'collapsered');
		});

		var cooky = $.cookie();
		
		$.each(cooky, function(key, value) {
			
			if(value == 'expandered') {
				$('span.expand#' + key).parent('.le-title').parent('.le-section').addClass('open');
				$('span.expand#' + key).text('-');
			}
			
			if(value == 'collapsered') {
				$('span.expand').parent('.le-title').parent('.le-section').removeClass('open');
				$('span.expand').text('+');
			}
			
		});

	    $('.le-select_webfont select').each(function(){
			var selectVal = $(this).find('option:selected').attr('value');
		    if(selectVal.length > 0) {
		    	$(this).parent().children('ul').children('li.' + $(this).find('option:selected').attr('class')).show();
		    }
	    });
		
		$('.le-select_webfont select').change(function(){
			
			var selectVal = $(this).find('option:selected').attr('value');
			
			if(selectVal.length > 0) {
				$(this).parent().children('ul').children('li').hide();
				$(this).parent().children('ul').children('li.' + $(this).find('option:selected').attr('class')).show();
			} else {
				$(this).parent().children('ul').children('li').hide();
			}
		
		});
	
	
	    	    
		$('#footer').hide();
		
	});