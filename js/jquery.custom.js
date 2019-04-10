jQuery.noConflict();
jQuery(document).ready(function($) { 

/*-----------------------------------------------------------------------------------*/
/*  Navigation
/*-----------------------------------------------------------------------------------*/

jQuery("nav ul").supersubs({            
            maxWidth: 12,
            minWidth: 8,
            extraWidth: 0 // set to 1 if lines turn over
        }).superfish({
    delay: 500,
    animation: {
        opacity: "show",
        height: "show"
    },
    speed: "fast",
    autoArrows: false,
    dropShadows: false
});

        /*-----------------------------------------------------------------------------------*/
/*  Navigation Replace
/*-----------------------------------------------------------------------------------*/
jQuery("<div class='styled-select nav select'><select data-placeholder='Select...'' /></div>").appendTo("#hello-bar");
jQuery("<option />", {
    selected: "selected",
    value: "",
    text: "Go to..."
}).appendTo("#hello-bar .styled-select select");
jQuery("nav a").each(function () {
    var a = jQuery(this);
    jQuery("<option />", {
        value: a.attr("href"),
        text: a.text()
    }).appendTo("#hello-bar .styled-select select")
});
jQuery("#hello-bar .styled-select select").change(function () {
    window.location = jQuery(this).find("option:selected").val()
});


/*-----------------------------------------------------------------------------------*/
/*  Opacity changes
/*-----------------------------------------------------------------------------------*/

jQuery(".social-icons").delegate("a", "mouseover mouseout", function(c) {
    if (c.type == 'mouseover') {
        jQuery(".social-icons a").not(this).dequeue().animate({opacity: "0.5"}, 0);
    } else {
        jQuery(".social-icons a").not(this).dequeue().animate({opacity: "1"}, 0);
        }
});    

// Video FitVids
jQuery('section .icy_video, aside .icy_video, .icy_video').fitVids();


jQuery('#wp_email_capture .wp-email-capture-submit').val('Subscribe');
jQuery('#wp_email_capture').find('br').remove();
jQuery('input.wp-email-capture-email').attr('title', 'Your Email');
        
jQuery("input.wp-email-capture-email").focus(function(srcc) {
    if (jQuery(this).val() == jQuery(this)[0].title) {                
        $(this).val("");
    }
});
jQuery("input.wp-email-capture-email").blur(function() {
    if (jQuery(this).val() == "") {                
        jQuery(this).val(jQuery(this)[0].title);
    }
});
jQuery("input.wp-email-capture-email").blur(); 

jQuery('.testimonials .author .url a').text('website'); 

});
