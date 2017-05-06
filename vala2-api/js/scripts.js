jQuery(document).ready(function(){
  jQuery('.kiwi-logo-carousel').bxSlider({
    auto: true,
    preloadImages: 'all',
    maxSlides: 5,
    slideWidth: 200,
    pager: false
  });
  
  
  // Sponsor Logo
  var maxheight=90;
      var showText = "Read More";
      var hideText = "Less";

      jQuery('.textContainer_Truncate').each(function () {
        var text = jQuery(this);
        if (text.height() > maxheight){
            text.css({ 'overflow': 'hidden','height': maxheight + 'px' });

            var link = jQuery('<a href="#">' + showText + '</a>');
            var linkDiv = jQuery('<div style="text-align: center"></div>');
            linkDiv.append(link);
            jQuery(this).after(linkDiv);

            link.click(function (event) {
              event.preventDefault();
              if (text.height() > maxheight) {
                  jQuery(this).html(showText);
                  text.css('height', maxheight + 'px');
              } else {
                  jQuery(this).html(hideText);
                  text.css('height', 'auto');
              }
            });
        }       
      });
      
  jQuery('img').contextmenu(function(event) {
      event.preventDefault();
      var $obj = jQuery( this );
      console.log( $obj.prop('src') );
      alert( "Handler for .contextmenu() called." );
  });
});