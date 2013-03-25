/* online image changing */  
var slidePause = 4000;
var fadeLen = 800;
var loadedResolution = 100;

jQuery(function ($) {

  $(document).ready(function(){
      
      var divSlide = $("#body div.slide");
      if(divSlide.length == 0)
        return;
      
      var switches = $(divSlide).find('div.switches a.switch');        
      var images = $(divSlide).find("img.front_image");    
      var count = $(images).size();
      var nextTimeout = null;
      var loadTimeout = null;
      var preloadImage = new Image();
      var current = $(images).index(".first");
      var next = current;
      var timeouting = true;
      
      // indicates fade or preloading in progress
      // any click should be thrown away if this is true
      var working = false;
      
      // end form removed
      preloadNextImage();
      
      function preloadNextImage() {        
          next++;
          if(next == count) {
              next = 0;
          }
          performPreloadImage(next);           
          nextTimeout = setTimeout(nextImage, slidePause);            
      }
      
      function performPreloadImage(number) {        
          preloadImage.src = $(images).eq(number).attr('src');          
      }
      
      
      function nextImage() { 
          working = true;       
          if(!preloadImage.complete) {
              loadTimeout = setTimeout(nextImage, loadedResolution);
              return;
          }  
          // mark <a> as active         
          $(switches).removeClass('active');
          $(switches).filter('a[rel=' + (next + 1) + ']').addClass('active');
          // perform switch        
          $(images).eq(next).fadeIn(fadeLen, showComplete);
          $(images).eq(current).fadeOut(fadeLen); 
          $(images).eq(current).removeClass("active");
          $(images).eq(next).addClass("active");                       
      } 
      
      function showComplete() {          
          current = next;             
          working = false;
          if(timeouting)                      
            preloadNextImage();                      
      }
  
      function stopTimeOuting() {
        clearTimeout(nextTimeout)
        timeouting = false;  
      }
  
      // hooks for <a> switches
      $(switches).click(function(e) {
        if(e.preventDefault) e.preventDefault(); else e.returnValue = false;
        // stop automatic sliding
        stopTimeOuting();
        // wait for free time
        if(working)
          return;
        
        // which image?
        var imageNumber = parseInt($(this).attr('rel'));
        if(isNaN(imageNumber)) 
          return;
        else
          imageNumber -= 1;
                
        if(imageNumber == current) {
          // no action needed
          return;    
        } else {
          next = imageNumber;
          performPreloadImage(next);
          nextImage();  
        }
        
        
                          
      });
   
  });

});