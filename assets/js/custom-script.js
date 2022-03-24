jQuery(document).ready(function() {
 
 // Main Slider

  jQuery('.webex_slider_home').slick({
 	slide: 'li'
 	,dots: true
 	,autoplay: true
 	,infinite: true
 	,speed: 800
 	,fade: true
 	,cssEase: 'ease'
 });
  });
// Set Height

function setHeight_home()
{
	jQuery('#slider_main_height').css({ 'position': 'relative'});
var a_height = jQuery('.acx_webex_slides').height();
jQuery('#slider_main_height').css({ height: a_height});
}
jQuery(window).load(function() {
setHeight_home();
});

jQuery(window).resize(function() {

setHeight_home();
});


jQuery(function() {	
	jQuery('.mob_toggle').click(function() {
	jQuery('.acx_mob_nav').slideToggle('ease-in');
	return false;
});
});

// Request Form


function acx_webex_show_req_frm()
{
	jQuery(".acx_webx_lb_cvr").fadeIn();
}

  function acx_webx_reqst_auto_cls()
  {
	  jQuery(".acx_webx_lb_cvr").fadeOut();
  }
 
 
// Request side

// jQuery(document).ready(function(){

// 	// hide #back-top first
// 	//jQuery(".scroll_req_qt").hide();
	
// 	// fade in #back-top
// 	jQuery(function () {
// 		jQuery(window).scroll(function () {
// 			if (jQuery(this).scrollTop() > 500) {
// 				jQuery('.scroll_req_qt').addClass('req_visible');
// 			} else {
// 				jQuery('.scroll_req_qt').removeClass('req_visible');
// 			}
// 		});
// 	});
// 	});

	
	
jQuery(window).load(function(){
  // init Isotope
  var $grid = jQuery('.acx_gallery_wrk_cnvs').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows'
  });

  // bind filter button click
  jQuery('.filters-button-group').on( 'click', '.acx_button', function() {
    var filterValue = jQuery( this ).attr('data-filter');
    $grid.isotope({ filter: filterValue });
  });
  // change is-checked class on buttons
  jQuery('.acx_gal_filter_grp').each( function( i, buttonGroup ) {
    var $buttonGroup = jQuery( buttonGroup );
    $buttonGroup.on( 'click', '.acx_button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      jQuery( this ).addClass('is-checked');
    });
  }); 
  
});



function acx_w_portfolio_opened(postid)
{
	jQuery('html').addClass('portfolio_opened');
	/* jQuery('#acx_webex_body_content').css({'left':'100%'}); 
	  */
	var acx_load="<div id='acx_webex_loading_1'><div class='load_1'></div></div>";
	jQuery('body').append(acx_load);	
	/*var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';*/
	var ajaxurl = 'https://www.webexgroup.com/wp-admin/admin-ajax.php';
	//console.log(ajaxurl);
	var order = 'postid='+postid+'&action=acx_w_open_portfolio';
	jQuery.post(ajaxurl, order, function(theResponse)
	{
		
		jQuery("#acx_webex_loading_1").remove();
		
		if(theResponse)
		{
		jQuery("body").append(theResponse);
		//jQuery("body").prepend(theResponse);
		//jQuery('.acx_p_port_logo_lbx_cvr').addClass('acx_light_cover_cls');
		}
		
	}); 
		
}

function acx_hide_portfolio(){
	jQuery('html').removeClass('portfolio_opened');
	jQuery('.acx_p_port_logo_lbx_cvr').remove();
	jQuery('.acx_p_port_lbx_cvr').remove();
}


// Home Slider


/* jQuery(window).load(function(){
jQuery(".acx_webex_slides:first-child").addClass('first');
jQuery(".acx_webex_slides:last-child").addClass('last');
jQuery(".acx_webex_slides:first-child").addClass('active_slide').css("opacity","1");
jQuery(".acx_webex_slides:first-child").addClass('active_slide').css("z-index","100");
});
var current_slide = jQuery(".acx_webex_slides:first-child");
var prev_slide = jQuery(".acx_webex_slides:last-child");
function acx_next()
{	 
	if(current_slide.hasClass('last'))
	{	
		current_slide = jQuery(".acx_webex_slides:first-child");
	}
	else
	{
		current_slide = current_slide.next();
	}
	if(current_slide.hasClass('first'))
	{	
		prev_slide = jQuery(".acx_webex_slides:last-child");
	}
	else
	{
		prev_slide = current_slide.prev();
	}
	current_slide.addClass('active_slide');
	prev_slide.removeClass('active_slide').css({opacity:0,transition : '1s ease'});
	current_slide.addClass('active_slide').css({opacity:1,transition : '1s ease'});
} 
	var acx_setinterval = setInterval(function(){ 
	acx_next(); 
	}, 6000); 

	jQuery('#acx_home_next').mouseover(function(){
        clearInterval(acx_setinterval);
			}).mouseout(function(){
				acx_setinterval  = setInterval(function(){ acx_next(); }, 6000); 
     });
	  jQuery('#acx_home_prev').mouseover(function(){
			clearInterval(acx_setinterval);
				}).mouseout(function(){
				acx_setinterval  = setInterval(function(){ acx_next(); }, 6000); 
     });
	jQuery('#acx_home_next').click(function () {
		clearInterval(acx_setinterval);
        acx_next();
		setTimeout(function() {acx_setinterval  = setInterval(function(){ acx_next(); },6000); 
	}, 2000);
    });
	jQuery('#acx_home_prev').click(function () {
		clearInterval(acx_setinterval);
		acx_prev();
		setTimeout(function() {acx_setinterval  = setInterval(function(){ acx_prev(); }, 6000); 
	}, 2000);
    });
	function acx_prev()
	{
		if(current_slide.hasClass('first'))
		{	
			current_slide = jQuery(".acx_webex_slides:last-child");
		}
		else
		{
			current_slide = current_slide.prev();
		
		}
		if(current_slide.hasClass('last'))
		{	
			prev_slide = jQuery(".acx_webex_slides:first-child");
		}
		else
		{
			prev_slide = current_slide.next();
	
		}
		current_slide.addClass('active_slide');
		prev_slide.removeClass('active_slide').css({opacity:0,transition : '1s ease'});
		current_slide.addClass('active_slide').css({opacity:1,transition : '1s ease'});		
	} */
	
	
