$(document).ready(function(){


  
  

  if (navigator.userAgent.indexOf("Firefox") !== -1){
  //console.log("Firefox");


  
  //console.log("Maproom.js Loaded")
  var a = document.getElementById("alphasvg");
  var svgDoc = a.contentDocument;
  
  let room = $("#room").val();
   //$(svgDoc).find((`[data-name="${room}"]`)).css("fill","blue");
   $(svgDoc).find(`[data-name="${room}"], [data-name="${room} "]`).css("fill", "blue");
   
   $(svgDoc).find('path').hover(function(e) {
    //console.log("PATH HOVERED")
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



  //$(svgDoc).find((`[data-name="${room}"]`)).append(`<textPath xlink:href=${room}>My text here</textPath>`);
  //$(svgDoc).find((`[data-name="${room}"]`))[0].setAttribute('id',room);
  //var svgd = $(svgDoc).find((`[data-name="${room}"]`))[0];
  $(svgDoc).find(`[data-name="${room}"], [data-name="${room} "]`)[0].setAttribute('id', room);
  var svgd = $(svgDoc).find(`[data-name="${room}"], [data-name="${room} "]`)[0];




addText(svgd)

function addText(p)
{
var t = document.createElementNS("http://www.w3.org/2000/svg", "text");
var b = p.getBBox();
t.setAttribute("transform", "translate(" + (b.x + b.width/2) + " " + (b.y + b.height/2) + ")");
t.textContent = room;
t.setAttribute("fill", "black");
t.setAttribute("font-size", "5");
//p.parentNode.insertBefore(t, p.nextSibling);
p.parentNode.append(t)
}




$("#print_btn").click(function(e){
  //console.log("PRINTING");
  setTimeout(window.print, 1000);
  });


  }
  else{
    
    $("object").load(function(){
    //console.log("Maproom.js Loaded")
    var a = document.getElementById("alphasvg");
    var svgDoc = a.contentDocument;
    
    let room = $("#room").val();
     //$(svgDoc).find((`[data-name="${room}"]`)).css("fill","blue");
     $(svgDoc).find(`[data-name="${room}"], [data-name="${room} "]`).css("fill", "blue");

     $(svgDoc).find('path').hover(function(e) {
      //console.log("PATH HOVERED")
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



    //$(svgDoc).find((`[data-name="${room}"]`)).append(`<textPath xlink:href=${room}>My text here</textPath>`);
    //$(svgDoc).find((`[data-name="${room}"]`))[0].setAttribute('id',room);
    //var svgd = $(svgDoc).find((`[data-name="${room}"]`))[0];
     $(svgDoc).find(`[data-name="${room}"], [data-name="${room} "]`)[0].setAttribute('id', room);
     var svgd = $(svgDoc).find(`[data-name="${room}"], [data-name="${room} "]`)[0];




addText(svgd)

function addText(p)
{
  var t = document.createElementNS("http://www.w3.org/2000/svg", "text");
  var b = p.getBBox();
  t.setAttribute("transform", "translate(" + (b.x + b.width/2) + " " + (b.y + b.height/2) + ")");
  t.textContent = room;
  t.setAttribute("fill", "black");
  t.setAttribute("font-size", "5");
  //p.parentNode.insertBefore(t, p.nextSibling);
  p.parentNode.append(t)
}



 
  $("#print_btn").click(function(e){
    //console.log("PRINTING");
    setTimeout(window.print, 1000);
    });

  });
  
}


  //   $("svg").load(function(){

   
  });
  