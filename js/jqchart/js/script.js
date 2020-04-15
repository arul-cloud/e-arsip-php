//home page slider
//	$(document).ready(function(){
//		$('#slider_area').cycle({ 
//			fx:     'fade', 
//			easing: 'backout', 
//			timeout: 5110, 
//			pager:  '#numbers', 
//			cleartype:  1,
//			pagerAnchorBuilder: function(idx) { 
//				return '<li><a href="#" title="">&nbsp; s</a></li>'; 
//			} 
//		});
//	});

//cufon fonts
//	$(document).ready(function(){
//		Cufon.replace('h1,h2,h3,h4,h5,h6', {hover: true});
//	});

//navigation
$(document).ready(function ()
{
    ddsmoothmenu.init({
        mainmenuid: "dropdown_menu", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'dropdown', //class added to menu's outer DIV
        //customtheme: ["#1c5a80", "#18374a"],
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    })
});

//image effects 
$(document).ready(function ()
{
    var image_e = $(".image.portfolio, .image.product_image");
    image_e.mouseover(function ()
    {
        $(this).stop().animate({ opacity: 0.6
        }, 400);
    }).mouseout(function ()
    {
        image_e.stop().animate({
            opacity: 1
        }, 400);
    });
});

//pretty photo
//	$(document).ready(function(){
//		$("a[rel^='prettyPhoto']").prettyPhoto();
//	});

//product tabs
$(document).ready(function ()
{
    var tabs = $("#tabs ul li");
    var content = $("#tabs #content");
    var kids = content.children();
    kids.attr("style", "display:none;");
    $("#tabs #content div:first").attr("style", "display:block;");
    tabs.click(
				function ()
				{
				    var show = $(this).attr("title");
				    //change clicked tab class
				    $("#tabs ul li").removeClass("active");
				    $(this).addClass("active");
				    //view clicked tab content
				    kids.attr("style", "display:none;");
				    content.slideUp(100);
				    $(function ()
				    {
				        content.slideDown(400);
				        $("#" + show + "").attr("style", "display:block;");
				    });
				}
			);
});

//validate contact form
//	  $(document).ready(function(){
//		  jQuery.validator.messages.required = "";
//			$("#validate_form").validate({});
//	  });

