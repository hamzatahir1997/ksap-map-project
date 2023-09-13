window.onload = function(e){

    function load_data(school_name,floor_id,handle_data){

     $.post("map_floor_loader.php", {"school_name": school_name,floor_id:floor_id}, function(data) {

           let raw_data =   JSON.parse(data);

          //console.log(data);

          console.log(raw_data);

          console.log(floor_id);

           var floor_data = [];

           for (item of raw_data){

              floor_data.push(JSON.parse(item['color_data']));

           }

           var green=0;

           var yellow= 0;

           var red = 0;

           var grey = 0;

           total = 0;

           rooms = {};

           console.log(floor_data)

           // Calculating the total of each color in each room.

           for (item of floor_data){

               for (let room in item){

                  if (rooms[room] && rooms[room]['count'] >= 0 ){

                      rooms[room]['count'] = rooms[room]['count']+1;

                  }

                  else{

                      rooms[room] = {};

                      rooms[room]['count']=1;

                      rooms[room]['grey']=0;

                      rooms[room]['yellow']=0;

                      rooms[room]['red']=0;

                      rooms[room]['green']=0;

                  }

                  if (item[room]=='grey'){

                      grey = grey+1;

                      rooms[room]['grey'] = rooms[room]['grey']+1;

                  }

                  else if(item[room]=="red"){

                      red = red+1;

                      rooms[room]['red']= rooms[room]['red']+1;

                  }

                  else if (item[room]=="yellow"){

                      yellow = yellow+1;

                      rooms[room]['yellow']= rooms[room]['yellow']+1;

                  }

                  else if (item[room]=="green"){

                      green = green+1;

                      rooms[room]['green']= rooms[room]['green']+1;

                  }

                  else {

                      //console.log("AN ERROR IN VALUE OCCURED")

                  }

                  total = total+1;

               }

           }

           let new_rooms = sort_dict(rooms);

           // This (handle_data) is a callback function which gets called when we recieve all the data from ajax call.

          // This function is used to load the fetched data in to HTML.

           handle_data(new_rooms);

          })

            .fail(function() {

              //console.log("error");

          });

   }

   var school_name = $("#name_of_school").val();

   var school_id = $("#school").val();

   var floor_id = $("#floor_id").val();

   // Loads default data when the page loads (Includes 'white' color in the total)

   load_data(school_name,floor_id,function(output){

       $("#school_name").html(`${school_name}`)

       $("#floor_name").html(`Floor ${floor_id}`)

       $('#floor_table > tbody').remove();

       $('#floor_table').append('<tbody> </tbody>')

       for (key in output){
        let result=key.replace("#","HASHTAG");

           $('#floor_table').append(`<tr>
           
           
              
           <td  data-t="s" value='${key}' class="font-weight-bold hovered"><a href="maproom.php?school=${school_id}&floor=${floor_id}&room=${result}" target="_blank"> ${key} </a></td>

           <td class="alternating-orange" data-t="n"> ${output[key]['red']}</td>

           <td class="alternating-orange" data-t="n" > ${output[key]['yellow']}</td>

           <td class="alternating-orange" data-t="n"> ${output[key]['green']}</td>

           <td class="alternating-orange" data-t="n"> ${output[key]['grey']}</td>

           <td class="alternating-orange" data-t="n"> ${output[key]['count']}</td>

           <td> ${Math.round(parseFloat((output[key]['red']/output[key]['count']))*100)} % </td>

           <td> ${Math.round(parseFloat((output[key]['yellow']/output[key]['count']))*100)} % </td>

           <td> ${Math.round(parseFloat((output[key]['green']/output[key]['count']))*100)} % </td>

           <td>  ${Math.round(parseFloat((output[key]['grey']/output[key]['count']))*100)} % </td>

           </tr>`)

//          <td class="font-weight-bold text-center"> ${parseFloat((output[key]['count']/output[key]['count']))*100} % </td>

       }

   });

   // Loads relevent data based on user's radio box selection

   // If nValue is true, 'white' colors are not counted in percentages

   $('input[name="nValue"]').on('change', function() {

       var nValue = JSON.parse($("input[name='nValue']:checked").val());

       if (nValue){

           load_data(school_name,floor_id,function(output){

               $("#school_name").html(`${school_name}`)

               $("#floor_name").html(`Floor ${floor_id}`)

               $("#floor_table .unsure").hide();

               $("#floor_table .unsure").attr("data-exclude","true");

               $("#floor_table .changing-cols").attr("colspan",4)

               $('#floor_table > tbody').remove();

               $('#floor_table').append('<tbody> </tbody>')

               for (key in output){
                   let result=key.replace("#","HASHTAG");

                   output[key]['count'] = output[key]['count'] - output[key]['grey'];

                   var redPercentage = Math.round(parseFloat((output[key]['red']/output[key]['count']))*100);

                   var yellowPercentage = Math.round(parseFloat((output[key]['yellow']/output[key]['count']))*100);

                   var greenPercentage = Math.round(parseFloat((output[key]['green']/output[key]['count']))*100);

                   if (isNaN(redPercentage)){

                       redPercentage = 0;

                   }

                   if (isNaN(yellowPercentage)){

                       yellowPercentage = 0;

                   }

                   if (isNaN(greenPercentage)){

                       greenPercentage = 0;

                   }

                   $('#floor_table').append(`<tr>    

                   <td data-t="s" value='${key}' class="font-weight-bold hovered"><a href="maproom.php?school=${school_id}&floor=${floor_id}&room=${result}" target="_blank"> ${key} </a></td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['red']}</td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['yellow']}</td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['green']}</td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['count']}</td>

                   <td> ${redPercentage} % </td>

                   <td> ${yellowPercentage} % </td>

                   <td> ${greenPercentage} % </td>

                   </tr>`)

       //          <td class="font-weight-bold text-center"> ${parseFloat((output[key]['count']/output[key]['count']))*100} % </td>

               }

           });

       }

       else{

           load_data(school_name,floor_id,function(output){

               $("#school_name").html(`${school_name}`)

               $("#floor_name").html(`Floor ${floor_id}`)

               $("#floor_table .unsure").show();

               $("#floor_table .unsure").attr("data-exclude","false");

               $("#floor_table .changing-cols").attr("colspan",5)

               $('#floor_table > tbody').remove();

               $('#floor_table').append('<tbody> </tbody>')

               for (key in output){
                   let result=key.replace("#","HASHTAG");

                   $('#floor_table').append(`<tr>    

                   <td  data-t="s" value='${key}' class="font-weight-bold hovered"><a href="maproom.php?school=${school_id}&floor=${floor_id}&room=${result}" target="_blank"> ${key} </a></td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['red']}</td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['yellow']}</td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['green']}</td>

                   <td class="alternating-orange" data-t="n"> ${output[key]['grey']}</td>

                   <td  class="alternating-orange" data-t="n"> ${output[key]['count']}</td>

                   <td> ${Math.round(parseFloat((output[key]['red']/output[key]['count']))*100)} % </td>

                   <td> ${Math.round(parseFloat((output[key]['yellow']/output[key]['count']))*100)} % </td>

                   <td> ${Math.round(parseFloat((output[key]['green']/output[key]['count']))*100)} % </td>

                   <td>  ${Math.round(parseFloat((output[key]['grey']/output[key]['count']))*100)} % </td>

                   </tr>`)

       //          <td class="font-weight-bold text-center"> ${parseFloat((output[key]['count']/output[key]['count']))*100} % </td>

               }

           });

       }

    });

   function sort_dict(rooms){

   // Looping over object to get the array and then sortin the array so we can get sorted rooms at the end

   var keys = Object.keys(rooms); // loop over the object to get the array

   // keys will be in any order

   keys.sort(); // maybe use custom sort, to change direction use .reverse()

   // keys now will be in wanted order

   let new_rooms = {}

   for (var i=0; i<keys.length; i++) { // now lets iterate in sort order

       var key = keys[i];

       new_rooms[key] = rooms[key];

       /* do something with key & value here */

   }

   return new_rooms

   }

}