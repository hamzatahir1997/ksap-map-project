<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/selectSchool.php";
}
else{
    include "languages/english/selectSchool.php";
}

if(!isset($_SESSION['teacher_name']) && !isset($_SESSION['admin_name'])){

    $path = 'error.php';
    echo "<script>
   document.location= '$path';
    </script>";
    //header('Location: ../teacher panel/error.php');
    exit;
}

if(isset($_POST['but_logout'])){
    if(isset($_SESSION['teacher_name']))
    {
             $path = '../teacher panel/index.php';
             echo "<script>
            document.location= '$path';
             </script>";
        session_destroy();
       // header('Location: ../teacher panel/index.php');
    }
    else{
        session_destroy();
        $path = 'index.php';
             echo "<script>
            document.location= '$path';
             </script>";
       //header('Location: index.php');
    }
}
  if(isset($_POST['sub'])){
      $agency=$_POST['agency'];
      $school=$_POST['school'];
      $path = 'SurveyReport.php?agency="'.$agency.'"&school='.$school;
      echo "<script>
          
                  document.location= '$path';
          
                  </script>";

    //header("Location:surveyReport.php?agency='".$agency."'&school=".$school);
  }

?>
<!DOCTYPE html>
<html>
<head>
        <title><?php echo $select_school; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="style2.css">

  
 </head>
    <body>
        <div class="container">
            <div class="row justify-content-between mt-3">
            <div class="col-xs-5 ml-1">
            <form action=""method="post" >
            <?php  if (isset($_SESSION['admin_name']) || isset($_SESSION['teacher_name'])) : ?>
              
                    <input class="btn but_logout btn-sm mb-2" type="submit" value="<?php echo $logout; ?>"name="but_logout" >
                
           <?php endif ?> 
           </form>
           </div> 
		
                
                <?php  if (isset($_SESSION['admin_name'])) : ?>
                <?php if ((strcmp($_SESSION['admin_name'],"superadmin"))==0): ?>
                    <div class="col-xs-5 mr-1">
                    <form action='add-school.php'>
                   
                  
                        <button class="btn btn-secondary mb-2"><?php echo $add_school_button; ?></button>      
                        </form>   
                </div>
                
                <?php else: ?>
                    <div class="col-xs-5 mr-1"></div>

                <?php endif; ?>
               
                <?php endif ?> 

               
                
            </div>
            <div class="container">
            <div class="row justify-content-center">
            <div class="col-xs-6 col-md-6 align-items-center size text-center">

                <h1 class="text-uppercase"><?php echo $select_school_h; ?></h1>
            </div>

            </div>
            </div>
            
            
            <form action="" method="POST">

            
            <div class="row align-items-center school-images justify-content-center">
                <div class="col-md-6 image-container mb-2">
                    <img  src="../pics/8.png"  class="img-fluid center-block" />
                    <select id="agency" required name="agency" class="select-css">
                    <option value=""><?php echo $select_agency; ?></option>
                    <?php 
                   if (isset($_SESSION['teacher_name'])) : {
                
                     $sql = mysqli_query($con, "SELECT DISTINCT agency FROM teacher_data  where id=". $_SESSION['tid']);      
                     $row = $sql->fetch_assoc();      
                     echo "<option value='$row[agency]'>" . $row['agency'] . "</option>";
        
             }

            else:
                { 
                    ?>
                        
                    <?php 


                    $sql = mysqli_query($con, "SELECT DISTINCT agency FROM school_map  where status = 1 Order By agency");
                    while ($row = $sql->fetch_assoc()){
                        echo "<option value='$row[agency]'>" . $row['agency'] . "</option>";
                    }
              
                }  
        
            endif; ?> 

                    </select>   

                    </select>
                </div>
                <div class="col-md-6 image-container">
                    <img  src="../pics/9.png"  class="img-fluid center-block" />
                    <select required name="school" class="select-css" id="school">
                    <option value=""><?php echo $select_school; ?></option>
                    </select>
                </div>
                <?php 
                //<div class="col image-container">
                  //  <img  src="../pics/10.png"  class="img-fluid center-block" />
                    //<select class="select-css" name="floor" id="floor">
                       // <option>Select Floor</option>
                    //</select>
                //</div>
                ?> 

            </div>

            <div class="mt-3 row justify-content-center align-items-center mb-3">

                <div class="col-12 mt-5 d-flex justify-content-center">
                    <button id="select-submit"  name="sub" id="sub"  class="btn btn-light btn-lg text-uppercase"><?php echo $submit; ?></button>
                    
                </div>

            </div>

            

        </form>
           
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="index.js"></script>

    <script type="text/javascript">
$(document).ready(function() 
{
    
    $("#select-submit").click(function(){
  var agency = $("#agency").val();
  var school = $("#school").val();
 // alert(agency + school);
  var url = '/surveyReport.php?agency="'+agency+'"&school='+school;
  //alert(url);
  //window.location = url;
});
});

     </script>
    </body>
</html>

