// Mobile Menu
jQuery(function($) {
	$(document).ready(function() {
		$("body ul.et_mobile_menu li.menu-item-has-children, body ul.et_mobile_menu  li.page_item_has_children").append('<a href="#" class="mobile-toggle-icon"></a>');
		$('ul.et_mobile_menu li.menu-item-has-children .mobile-toggle-icon, ul.et_mobile_menu li.page_item_has_children .mobile-toggle-icon').click(function(event) {
			event.preventDefault();
			$(this).parent('li').toggleClass('mobile-toggle-open');
			$(this).parent('li').find('ul.children').first().toggleClass('visible');
			$(this).parent('li').find('ul.sub-menu').first().toggleClass('visible');
		});
		iconFINAL = 'P';
		$('body ul.et_mobile_menu li.menu-item-has-children, body ul.et_mobile_menu li.page_item_has_children').attr('data-icon', iconFINAL);
		$('.mobile-toggle-icon').on('mouseover', function() {
			$(this).parent().addClass('active-toggle');
		}).on('mouseout', function() {
			$(this).parent().removeClass('active-toggle');
		})
	});
});

// project
jQuery(".griselda_project .project").each(function () {
	jQuery(this).find(".et_pb_module_header,.post-meta,.entry-title,.post-content").wrapAll('<div class="griselda_project_box"></div>');
});

// Team Section 
(function($){

	function griselda_team_set() {

		$('.griselda_button_01').click(function(event) {
			event.preventDefault();

			if( ! $('.griselda_button_01').hasClass('griselda_active')){

				$('.griselda_button_02').removeClass('griselda_active');
				$('.griselda_button_03').removeClass('griselda_active');
				$('.griselda_button_04').removeClass('griselda_active');
				$('.griselda_button_01').addClass('griselda_active');

				$('.griselda_team_02').removeClass('griselda_active');
				$('.griselda_team_03').removeClass('griselda_active');
				$('.griselda_team_04').removeClass('griselda_active');
				$('.griselda_team_01').addClass('griselda_active');
			}
		});

		$('.griselda_button_02').click(function(event) {
			event.preventDefault();

			if( ! $('.griselda_button_02').hasClass('griselda_active')){

				$('.griselda_button_01').removeClass('griselda_active');
				$('.griselda_button_03').removeClass('griselda_active');
				$('.griselda_button_04').removeClass('griselda_active');
				$('.griselda_button_02').addClass('griselda_active');

				$('.griselda_team_01').removeClass('griselda_active');
				$('.griselda_team_03').removeClass('griselda_active');
				$('.griselda_team_04').removeClass('griselda_active');
				$('.griselda_team_02').addClass('griselda_active');
			}
		});

		$('.griselda_button_03').click(function(event) {
			event.preventDefault();

			if( ! $('.griselda_button_03').hasClass('griselda_active')){

				$('.griselda_button_01').removeClass('griselda_active');
				$('.griselda_button_02').removeClass('griselda_active');
				$('.griselda_button_04').removeClass('griselda_active');
				$('.griselda_button_03').addClass('griselda_active');

				$('.griselda_team_01').removeClass('griselda_active');
				$('.griselda_team_02').removeClass('griselda_active');
				$('.griselda_team_04').removeClass('griselda_active');
				$('.griselda_team_03').addClass('griselda_active');
			}
		});

		$('.griselda_button_04').click(function(event) {
			event.preventDefault();

			if( ! $('.griselda_button_04').hasClass('griselda_active')){

				$('.griselda_button_01').removeClass('griselda_active');
				$('.griselda_button_02').removeClass('griselda_active');
				$('.griselda_button_03').removeClass('griselda_active');
				$('.griselda_button_04').addClass('griselda_active');

				$('.griselda_team_01').removeClass('griselda_active');
				$('.griselda_team_02').removeClass('griselda_active');
				$('.griselda_team_03').removeClass('griselda_active');
				$('.griselda_team_04').addClass('griselda_active');
			}
		});

	}

	$(window).load(function() {
		griselda_team_set();
	});

})(jQuery);

jQuery(".griselda_button .et_pb_team_member_description").each(function () {
	jQuery(this).find("div,.et_pb_member_social_links").wrapAll('<div class="griselda_button_right"></div>');
});
jQuery(".griselda_button .et_pb_team_member_description").each(function () {
	jQuery(this).find(".et_pb_module_header,.et_pb_member_position").wrapAll('<div class="griselda_button_left"></div>');
});


// testimonial

jQuery(".griselda_testimonial").each(function () {
	jQuery(this).find(".et_pb_testimonial_author,.et_pb_testimonial_meta").wrapAll('<div class="griselda_testimonial_content"></div>');
});
jQuery(".griselda_testimonial").each(function () {
	jQuery(this).find(".griselda_testimonial_content,.et_pb_testimonial_portrait").wrapAll('<div class="griselda_testimonial_top"></div>');
});

$(document).ready(function(){
	$('.griselda_testimonial_slider').slick({
		dots: false,
		infinite: false,
		arrows: true,
		speed: 300,
		slidesToShow: 2,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 981,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
});

// pricing
jQuery(".griselda_pricing .et_pb_pricing_table ").each(function () {
	jQuery(this).find(".et_pb_pricing_heading,.et_pb_pricing_content_top").wrapAll('<div class="griselda_pricing_top"></div>');
});

// Blog Section

jQuery(".griselda_blog .post").each(function () {
	jQuery(this).find(".entry-title,.post-content,.post-meta").wrapAll('<div class="griselda_blog_content"></div>');
});

//Remove meta seperator pipes (|) and by from Divi Blog module meta
jQuery(function($) {
	$(document).ready(function() {
		$('.griselda_blog .post-meta').each(function() {
			$(this).html($(this).html().replace(/\|/g, " "));
			$(this).html($(this).html().replace('by', "by: "));
		});

		//Do the same for ajax with pagination enabled
		$(document).bind('ready ajaxComplete', function() {
			$('.griselda_blog .post-meta').each(function() {
				$(this).html($(this).html().replace(/\|/g, " "));

			});
		});
	});
});