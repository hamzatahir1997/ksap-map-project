<?php 

include "../config.php";



if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){

  include "languages/spanish/mapfeedback.php";

}

else{

  include "languages/english/mapfeedback.php";

}



$query_string = $_GET["url"];

$lvl = $_GET["lvl"];

$s_id = $_GET["school_id"];

$guid=$_GET["guid"];





?>



<!DOCTYPE html>

<html>

<head>



<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  

      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"

        crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"

        crossorigin="anonymous"></script>

        <script src="script.js"></script>

        <script src="data-sender.js"></script>

       





        

        <title><?php echo $title; ?></title>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"

        crossorigin="anonymous">

        <link rel="stylesheet" href="style1.css">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



 </head>

    <body>

    <input id="is-lang-english" type="hidden" value="<?php echo $_SESSION["English"]?>">



        <script language="JavaScript">

            var colors = ["#FF0000", "#008000", "#0000FF"];

         

       </script>

        <div class="container-fluid">

            <form method='post' action=''>

            

            <div class="row upper-container">

           

                <div class="col-12 ">

                    <img class="float-right" src="../pics/6.png"  class="img-fluid responsive" />

                </div>

                

                <div class="col-12">

                    <h1 class="heading text-uppercase"><?php echo $maps_analysis; ?></h1>

            

                </div>

                

                <div class="col-12 d-flex justify-content-center align"> 

            

                <?php 



                 $query="SELECT DISTINCT sname,s_type FROM school_map  where status = 1  AND id= ". $s_id;

                 $sql = mysqli_query($con, $query );          

                 while ($row = $sql->fetch_assoc()){?>

                   

                   <span class="badge badge-primary"><h4 class="heading1 mt-2"><?php echo  $row['sname']." ". $row['s_type'] ?></h4></span> 

                <?php	

                }

			          ?> 

                           

                </div>

                  

                </div>









           <nav class="navbar navbar-expand-md navbar-dark bg-dark container-fluid"> 

             <button class="navbar-toggler ml-4" type="button" data-toggle="collapse" data-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon"></span>

                    </button>

                    <div class="collapse navbar-collapse text-center" id="navbarsExample11">

                    <ul class="navbar-nav  "> 

                     <?php      $count=1;

                            $query="SELECT DISTINCT id, floorlevel, url FROM school_floor  where status = 1  AND school_id= ". $s_id;

                            $sql = mysqli_query($con, $query );

                            while ($row = $sql->fetch_assoc()){ ?>

                           	 <li class="<?php if($s_id==21 ):{echo"nav-item nav-item1 ";} else: { echo "nav-item ";} endif; ?><?php echo $lvl == $row['floorlevel'] ? 'active' : '' ; ?>"> 

               <a class="<?php if($s_id==21 ):{echo"nav-link nav-link1";} else: { echo "nav-link nav-link2";} endif; ?> "   

                        data-href="<?php echo  "mapfeedback.php?url=" .$row['url'] . "&lvl=". $row['floorlevel']. "&school_id=".$s_id ."&guid=".$guid ?>"> 

                        <?php if(($s_id==21) || ($s_id==1) ):{echo"";} else: { echo $floor_nav;} endif; ?> <?php echo  $row['floorlevel'] ?>

                      </a> 

                    </li>   

                        <?php $count++; }

                ?>

                  </ul> 

                  </div>

            </nav>     



          

                

          

        



            <div class="color-S alert alert-info">

                <h3><strong><?php echo $pick_color; ?>:</strong> </h3>

    

                <div style="fill:red;" class="selection" data-name="red">

                  <label class="checkbox1">

                  <input type="radio" name="radio">

                  <span><h4><?php echo $red; ?></h4></span>

                </label>

                  </div>

                  <div style="fill:green;" class="selection" data-name="green">

                    <label class="checkbox2">

                      <input type="radio"name="radio">

                      <span><h4><?php echo $green; ?></h4></span>

                    </label>

                    </div>

                    <div style="fill:yellow;" class="selection" data-name="yellow">

                      <label class="checkbox3">

                        <input type="radio"name="radio">

                        <span><h4><?php echo $yellow; ?></h4></span>

                      </label>

                    </div>

                    <div style="fill:grey;" class="selection" data-name="grey">

                      <label class="checkbox4">

                        <input type="radio"name="radio">

                        <span><h4><?php echo $grey; ?></h4></span>

                      </label>

                    </div>

             

              <hr>

              <h5 class="mb-0"><?php echo $user_guidance; ?></h5>

            </div>

        

    

          <div class="lower-container">



  <div style="position:relative" class="svg-element">

  <object onload="objectLoaded()" type="image/svg+xml" id="alphasvg" data="<?php echo "../admin panel/".$query_string ?>"></object>

  <div style="position:absolute" id="info-box"></div>

  

  </div>

  





<div class="col-md-12 mb-2 d-flex justify-content-center">



  <a id="prev_button" name="btn_prev" class="btn btn-submit text-uppercase mr-2 data_submitter"><?php echo $prev_floor ?></a>

  <?php 

      $guid = strval($_SESSION['guid']);
      
      $query="SELECT * FROM `survey_data` WHERE guid="."'$guid'";
      $sql = mysqli_query($con, $query);
      if($sql->num_rows > 0)
      {
        $check = 1;
      } else
      {
        $check = 0;
      }
    ?>

  <?php if($check == 1) { ?>
    <button onclick="alsbmt()" type="button" class="btn btn-submit text-uppercase mr-2"><?php echo $submit ?></button>
    <script>
    function alsbmt()
    {
      console.log("here");
      alert("You have already submitted the form!");
    }
    </script>
  <?php } else { ?>

  <button id="submit_button" name="btn_submit" type="submit" class="btn btn-submit text-uppercase mr-2 data_submitter"><?php echo $submit ?></button>

  <?php } ?>
  <a id="next_button" name="btn_next" class="btn btn-submit text-uppercase data_submitter"><?php echo $next_floor ?></a>


</div>

<div>

<input type="hidden"name="school_floor_level" id="school_floor_level" value="floor<?php echo $lvl ?>"></div>

<input type="hidden"name="school_id" id="school_id" value="<?php echo $s_id ?>">

<input type="hidden"name="guid" id="guid" value="<?php echo $guid ?>">



</div>

</div>





        </form>



      </div>     

   

    </body>

</html>



<script>



function objectLoaded(){

 

  console.log("OBJECT LOADED")

  var a = document.getElementById("alphasvg");

  var svgDoc = a.contentDocument;



  // End Jquery

  



  // This $.get request gets data from server stored in session, if it finds data, it colors the map accordingly.

  // This is used so that the user doesn't loose his colored data after refreshing the browser or changing links.



  var floor_id = document.getElementById("school_floor_level").value;

  

  console.log(floor_id)





    $.get("validate.php", {"floor_id":floor_id}, function(data) {

      console.log(data)

      var data = JSON.parse(data);

      

      var floor_data = JSON.parse(data[floor_id]); 

      console.log(floor_data) 

      var paths = svgDoc.querySelectorAll("path");

      for (path of paths){

        let room = $(path).attr("data-name");

        console.log(floor_data[room]);

        if (floor_data[room] == "" || floor_data[room] == "null" || floor_data[room]==null){

          $(path).css("fill","white");

          $(path).attr("data-color",null);

        }

        

        else{

          $(path).css("fill",floor_data[room]);

          $(path).attr("data-color",floor_data[room]);

        }

      }



  

  })

    .fail(function() {

      console.log("error");

    });









}





</script>