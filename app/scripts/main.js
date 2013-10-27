// globals
var screenHeight = 0;

$(document).ready(function ()
{
	// init
	$.scrollTo( 0 );
	$(window).trigger('resize');

	// template
	resetLayout();
	functionality();
});

/**
* Reset layout
*/
function resetLayout()
{
	// intro height
	var introHeight = $(window).height();
	screenHeight = introHeight;
	$('.heading').height(introHeight);

	// bank-account description
	$('.payment-info').hide();
	$('.option input').change(function (event)
	{
		if ($('input[id="bank"]').is(':checked'))
		{
			$('.payment-info').show(100);
		}
		else
		{
			$('.payment-info').hide(75);
		}
	});

	// hide messages
	$('.validation').hide();

	// hide to top
	$('.to-top').css({opacity: 0});
}

/**
* Functionality
*/
function functionality()
{
	// scroll, fade out
	$(window).scroll(function (event)
	{
		var toTopOpacity = ($(window).scrollTop() > screenHeight) ? 1 : 0;
		toTopOpacity = Math.min((($(window).scrollTop() - screenHeight) / 100), .5);
		$('.to-top').css({opacity: toTopOpacity});
	});

	// scroll to subscription form
	$('.heading .subscribe').click(function (event)
	{
		$.scrollTo($('form'), 1000);
		event.preventDefault();
	});

	// back to top
	$('.to-top').click(function (event)
	{
		$.scrollTo(0, 750);
		event.preventDefault();
	});

	// subscribe form
	$('form').validate({
		errorPlacement: $.noop,
		submitHandler: function(form)
		{
			var form = $('form');
			var formData = $(form).serialize();

			$.ajax({
				type: 'post',
				url: 'ajax/subscribe.php',
				data: formData,
			}).done(function(response)
			{
				var response = jQuery.parseJSON(response);
				
				if (response.type == 'success')
				{
					$('.validation, .validation .success').show();
					$('.validation .error').hide();
					$.scrollTo($('form'), 1000);
				}
				else
				{
					$('.validation .success').hide();
					$('.validation, .validation .error').show();
				}
			});
		}
	});
}
