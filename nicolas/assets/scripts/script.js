/**
 * Change Active State of Links in Sticky Navigation on Scroll
 *
 * Rishabh Pugalia
 * http://codetheory.in/change-active-state-links-sticky-navigation-scroll/
**/

var disableLinkStateOnScroll = false;
var sections = $('section');
var nav = $('nav');

nav.find('a[href="#home"]').addClass('active');

$(window).on('scroll', function() {
	var cur_pos = $(this).scrollTop();
	var top_offset = -parseFloat(sections.first().css('margin-top'));
	if (cur_pos >= top_offset) {
		nav.addClass('shadow');
	} else {
		nav.removeClass('shadow');
	}
	if (disableLinkStateOnScroll) { return; }
	var bottom_offset = parseFloat(sections.last().css('padding-bottom'));
	var page_height = $(document).height() - $(window).height() - top_offset - bottom_offset - 40;
	if (cur_pos >= page_height) {
		nav.find('a').removeClass('active');
		nav.find('a[href="#'+sections.last().attr('id')+'"]').addClass('active');
	} else {
		var nav_height = nav.outerHeight();
		sections.each(function() {
			var top = $(this).offset().top - nav_height;
			var bottom = top + $(this).outerHeight();
			if ((top <= cur_pos) && (cur_pos <= bottom)) {
				nav.find('a').removeClass('active');
				nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
			}
		});
	}
});


/**
 * Smooth Scrolling
 *
 * Chris Coyier
 * https://css-tricks.com/snippets/jquery/smooth-scrolling/
**/

$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
	if ((location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, ''))
		&& (location.hostname == this.hostname)) {
		disableLinkStateOnScroll = true;
		nav.find('a').removeClass('active');
		$(this).addClass('active');
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		if (target.length) {
			event.preventDefault();
			$('html, body').animate({
				scrollTop: target.offset().top
			}, 500, function() {
				disableLinkStateOnScroll = false;
				var $target = $(target);
				$target.focus();
				if ($target.is(':focus')) { 
					return false;
				} else {
					$target.attr('tabindex', '-1'); 
					$target.focus(); 
				};
			});
		}
	}
});
