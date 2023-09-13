$(document).ready(function(){



    if (navigator.userAgent.indexOf("Firefox") !== -1){
      console.log("Firefox");
  
      console.log("HELL00")
      //alert("Document loaded, including graphics and embedded documents (like SVG)");
      var a = document.getElementById("alphasvg");
  
      //get the inner DOM of alpha.svg
      var svgDoc = a.contentDocument;
  
      //get the inner element by id
    
  
      $(svgDoc).find('path').hover(function(e) {
        $('#info-box').css('display','block');
        $('#info-box').html($(this).data('name'));
  
      });
      
      $(svgDoc).find("path").mouseleave(function(e) {
        $('#info-box').css('display','none');
      });
      
      $(svgDoc).mousemove(function(e) {
        $('#info-box').css('top',e.pageY-$('#info-box').height()-30);
        $('#info-box').css('left',e.pageX-($('#info-box').width())/2);
      }).mouseover();
      
      var ios = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
      if(ios) {
        $('a').on('click touchend', function() { 
          var link = $(this).attr('href');   
          window.open(link,'_blank');
          return false;
        });
      }
      
      
      var color;
      var allStates = $(svgDoc).find("svg.map > *");
      $(".selection").click(function () {
        color = $(this).attr("data-name");
      
        
      });
      
      $(svgDoc).find(".selected").click(function(){
  
      allStates.on("click", function() {
      allStates.removeClass("selected");
      $(this).css("fill",color);
      $(this).attr("data-color",color)
      
      });
                  
      });
  
  }
  
  
  else{
  
  console.log("Google Chrome");
  $("object").load(function(){
    console.log("HELL00")
    //alert("Document loaded, including graphics and embedded documents (like SVG)");
    var a = document.getElementById("alphasvg");
  
    //get the inner DOM of alpha.svg
    var svgDoc = a.contentDocument;
  
    //get the inner element by id
  
  
    $(svgDoc).find('path').hover(function(e) {
      $('#info-box').css('display','block');
      $('#info-box').html($(this).data('name'));
  
    });
    
    $(svgDoc).find("path").mouseleave(function(e) {
      $('#info-box').css('display','none');
    });
    
    $(svgDoc).mousemove(function(e) {
      $('#info-box').css('top',e.pageY-$('#info-box').height()-30);
      $('#info-box').css('left',e.pageX-($('#info-box').width())/2);
    }).mouseover();
    
    var ios = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if(ios) {
      $('a').on('click touchend', function() { 
        var link = $(this).attr('href');   
        window.open(link,'_blank');
        return false;
      });
    }
    
   
    $("#print_btn").click(function(e){
      console.log("PRINTING");
      setTimeout(window.print, 1000);
      });
    
 
  });
  }
   
    });


    

  