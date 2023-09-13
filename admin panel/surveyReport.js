//For toggle

$(document).ready(function(){

    $(".toggle").hide();


    $(".box-right").click(function(){

        var id = $(this).attr('data-for');
        $(`#${id}`).toggle(1000);
      });


       
  $("#print_btn").click(function(e){
    console.log("PRINTING");
    setTimeout(window.print, 1000);
    });

    $(".highcharts-title").hide();
});