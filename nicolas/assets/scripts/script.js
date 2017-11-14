/**
 * Change Active State of Links in Sticky Navigation on Scroll
 *
 * Rishabh Pugalia
 * http://codetheory.in/change-active-state-links-sticky-navigation-scroll/
**/

var disableLinkStateOnScroll = false;
var sections = $('section');
var nav = $('nav');
var nav_height = nav.outerHeight();

$(window).on('scroll', function() {
	var cur_pos = $(this).scrollTop();
	if (cur_pos >= nav_height) {
		nav.addClass('shadow');
	} else {
		nav.removeClass('shadow');
	}
	if (disableLinkStateOnScroll) { return; }
	var page_height = $(document).height() - $(window).height() - nav_height - 100;
	if (cur_pos >= page_height) {
		nav.find('a').removeClass('active');
		nav.find('a[href="#'+sections.last().attr('id')+'"]').addClass('active');
	} else {
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


/**
 * Prevent Sticky Hover Effects on Touch Devices
 *
 * Sjoerd Visscher
 * http://testbug.handcraft.com/ipad.html
 *
 * Darren Cook
 * https://stackoverflow.com/a/17234319/2469565
**/

$('a[href]').on('touchend', function() {
	$(this).click(function() {
		var element = this;
		if (element == null) { return; }
		var parent = element.parentNode;
		var next = element.nextSibling;
		if (parent == null) { return; }
		parent.removeChild(element);
		setTimeout(function() {
			parent.insertBefore(element, next);
		}, 0);
	});
});
