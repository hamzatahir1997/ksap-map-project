<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/mapReport.php";
}
else{
    include "languages/english/mapReport.php";
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
        session_destroy();
        $path = '../teacher panel/index.php';
                    echo "<script>
                    document.location= '$path';
                        </script>";
        //header('Location: ../teacher panel/index.php');
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

if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
    
    $_SESSION['from_date'] = $_POST['from_date'];
    $_SESSION['to_date'] = $_POST['to_date'];

  } else {
    unset($_SESSION['from_date']);
    unset($_SESSION['to_date']);
  }

$agency_name = $_GET["agency"];
$school_name = $_GET["school"];
$floor_id = $_GET["floor"];
$query1="SELECT DISTINCT sname FROM school_map where id= ". $school_name;
$sql1 = mysqli_query($con, $query1 );  
$row1 = $sql1->fetch_assoc();
$school = $row1['sname'];
if(isset($_POST['back_screen'])){
    $path = 'SurveyReport.php?agency='.$agency_name.'&school='.$school_name;
    echo "<script>
                document.location= '$path';
                </script>";
    //header("Location: SurveyReport2.php?agency=".$agency_name."&school=".$school_name);
}
if($agency_name != "null")
{
    //echo $agency_name;
    $condition =  "where s.Agency =".$agency_name;
    if($school_name != "null")
    {
        $condition =  "where s.Agency =".$agency_name . "and sd.school_id=".$school_name;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
        <title><?php echo $map_report; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.6.2/alasql.min.js" integrity="sha512-2avn8of9zz17ejnalEodjUd2blM2VEwSixFrGc0BNDXBlkGBNof9w8/ajoDquplOw/RrExjv4kXQ709719C2Ng==" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="MapReportStyle.css">
         <link rel='stylesheet' href='https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css'>
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style type="text/css">
   
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 1000px; 
    margin: 1em auto;
}
#container {
    height: 800px;
}
#barcontainer{
    height: 600px;
}
.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.hidden{
    display:none;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #F8F8F8;
}
.highcharts-data-table tr:hover {
    background: #F1F7FF;
}
        </style>
 </head>
    <body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <script src="../plugin/charts/code/highcharts.js"></script>
<script src="../plugin/charts/code/modules/exporting.js"></script>
<script src="../plugin/charts/code/modules/export-data.js"></script>
<script src="../plugin/charts/code/modules/accessibility.js"></script>
<link rel="stylesheet" type="text/css" href="../plugin/datatables/datatables.css">
<script type="text/javascript" charset="utf8" src="../plugin/datatables/datatables.js"></script>
<script type="text/javascript">
</script>
        <div class="container-fluid">
            <form method="post" action="">
            <div class="row upper-container">
            <?php  if (isset($_SESSION['admin_name']) || isset($_SESSION['teacher_name'])) : ?>
                <div class="col-md-12 logoutandback">
                    <input type="submit" value="<?php echo $logout; ?>"name="but_logout" class="btn btn-light but_logout btn-sm noprint">
                    <input type="submit" value="<?php echo $back; ?>"name="back_screen" class="btn btn-light backscreen btn-sm noprint">
                </div> 
           <?php endif ?> 
                <input type="hidden" value=<?php echo $agency_name?> name="agency" id="agency">
                <input type="hidden" value="<?php echo $school_name?>" name="school" id="school">
                <input type="hidden" value="<?php echo $school?>" name="school_name" id="name_of_school">
                <input type="hidden" value="<?php echo $floor_id?>" name="floor_id" id="floor_id">
                <div class="col-md-12">
                    <img class="float-right one" src="../pics/6.png"  class="img-fluid responsive" />
                </div>
                <div class="col-md-12">
                    <h1 class="heading text-uppercase"><?php echo $map_analysis; ?></h1>
                </div>
                <div class="col-12 d-flex justify-content-center align"> 
            <?php 
            $query="SELECT DISTINCT sname,s_type FROM school_map  where status = 1  AND id= ". $school_name;
            $sql = mysqli_query($con, $query );          
            $row = $sql->fetch_assoc()?>
           <span class="badge badge-primary"><h4 class=heading1><?php echo  $row['sname']." ". $row['s_type'] ?></h4></span> 
        </div>
                </div>
             <nav class="navbar navbar-expand-md navbar-dark bg-dark container-fluid"> 
             <button class="navbar-toggler ml-4" type="button" data-toggle="collapse" data-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                    <ul class="navbar-nav  "> 
                     <?php      $count=1;
                            $query="SELECT DISTINCT id, floorlevel, url FROM school_floor  where status = 1  AND school_id= ". $school_name;
                            $sql = mysqli_query($con, $query );
                            while ($row = $sql->fetch_assoc()){ ?>
                             <li class="<?php if($school_name==21):{echo"nav-item nav-item1 ";} else: { echo "nav-item ";} endif; ?> <?php echo $floor_id == $row['floorlevel'] ? 'active' : '' ; ?>"> 
                        <a class="<?php if($school_name==21):{echo"nav-link nav-link1";} else: { echo "nav-link nav-link2";} endif; ?> "   
                        href='<?php echo  'mapReport.php?agency='.$agency_name .'&school='.$school_name .'&floor='. $row['floorlevel'] ?>'> 
                        <?php if($school_name==21 || $school_name==1):{echo"";} else: { echo $floor_nav;} endif; ?> <?php echo  $row['floorlevel'] ?>
                      </a> 
                    </li>   
                        <?php $count++; }
                ?>
                  </ul> 
                  </div>
            </nav>
       
        </form>
           <div class="row lower-container mt-3 mb-3">
          
        
    <div class="col-md-12 formcheck">
        <form method="post"action="">
        <div class="d-flex justify-content-center mt-3 mb-4">
            <h5 class="text-center mr-4 selectdate"><?php echo $select_date; ?></h5>
          </div>
          <div class="col-md-4 mx-auto">
           
                <div class="form-group input-group input-daterange">
                        <?php if(isset($_POST['from_date']) && isset($_POST['to_date'])) { $to_date = $_POST['to_date']; $from_date = $_POST['from_date'];  ?>
                    <div class="mr-3 mb-2">
                      <input id="datepicker1"type=""name="from_date"  class="p-2 date"value="<?php echo $from_date; ?>" required />
                    </div>
                    <div>
                      <input id="datepicker2"type="" class="form-control p-2 date"value="<?php echo $to_date; ?>" required/>
                    </div>
                </div>
                      <div class='form-group d-flex justify-content-center mt-4'>
                      <input type="submit" name="reset_date" id="" onclick="window.reload()" value="<?php echo $reset; ?>" class="btn btn-year noprint"/> 
                    </div>     
         
                      <?php } else { ?>
                <div class="form-group input-group input-daterange">
                    <div class="mr-3 mb-2">
                        <input id="datepicker3"type="text"name="from_date" class="p-2 date"placeholder= "<?php echo $from; ?>"required/>
                    </div>
                    <div>
                        <input type=""name="to_date"id="datepicker4" class="p-2 date"placeholder= "<?php echo $tospell; ?>"required />
                    </div>
                </div>
            
          </div>
                    <div class='form-group d-flex justify-content-center mt-1'>
                        <input type="submit"name="submit_date" class="btn btn-year noprint" value="<?php echo $search; ?>">
                 </div>
                      <?php } ?>
                    </form> 
          </div>
  
      
   
         
            <div class="col-lg-12 hide"> 
<center>
<div class=" container well "><p class="display-1 "> <h1><span class="badge badge-info"> <?php if($school_name==21 || $school_name==1):{echo"";} else: { echo $floor_nav;} endif; ?> <?php echo  $floor_id ?></span></h1></p></div></center>
</div>

<div class="row">
<div class="form-check width rounded mb-3">
    <label class="form-check-label" for="nValue">
      <input type="radio" id="nValue" class="form-check-input" name="nValue" value="true" ><?php echo $nvalue_analysis; ?>
    </label>
    <label class="form-check-label" for="normal">
      <input id="normal" type="radio"class="form-check-input"name="nValue" value="false" checked="checked" ><?php echo $normal_analysis; ?>
    </label>
</div>
</div>




<div class="col-md-12"> 
     
    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm table-bordered" width="100%" id="floor_table" name="floor_table">
    
        <thead>
        <tr>
        <th rowspan="2" class="text-center text-middle"> <h3><span class="badge badge-info1"><?php echo $rooms; ?></span></h3></th>
        <th colspan="5" class="text-center  text-middle changing-cols"style="background-color:#E86715;" ><?php echo $count_h; ?></th>
        <th colspan="5" class="text-center  text-middle changing-cols"><?php echo $percentage; ?></th>
        </tr>
            <tr>
                <!-- <th>Room</th> -->
                <th style="background-color:#E86715;"><?php echo $unsafe; ?></th>    
                <th style="background-color:#E86715;"><?php echo $between; ?></th>
                <th style="background-color:#E86715;"><?php echo $safe; ?></th>
                <th class="unsure" style="background-color:#E86715;"><?php echo $never; ?></th>
                <th style="background-color:#E86715;"><?php echo $total_h; ?></th>
                <th class= ""><?php echo $unsafe; ?></th>
                <th class= ""><?php echo $between; ?></th>
                <th class= ""><?php echo $safe; ?></th>
                <th class="unsure"><?php echo $never; ?></th>
                <!-- <th class="text-center">Total %</th> -->
            </tr>
        </thead>  
        <tbody>
        <tr>
        </tr>
        </tbody>
        </table>
        </div>  
</div>


     
        <?php

$urlquery='SELECT DISTINCT id,url FROM school_floor  where status=1 AND school_id="'.$school_name.'"AND floorlevel="'.$floor_id.'"';
$sql = mysqli_query($con, $urlquery );
$row = mysqli_fetch_array($sql);

?>

<div class="container">
    <div style="position:relative" class="svg-element">
      <object  type="image/svg+xml" id="alphasvg" data="<?php echo "../admin panel/".$row['url'] ?>"></object>
      <div style="position:absolute" id="info-box">
      </div>
      
    </div>
    </div>
    <div class="col-lg-12"> 
    <a href="#" class="btn print_btn float-right mr-3 mb-3 noprint" id="print_btn"><?php echo $print; ?></a>
   
        <button id="btnExport"name="excel_button"class=" float-right noprint btn print_btn mr-2" onclick="exportReportToExcel(this)"><?php echo $excel_download; ?></button>
 
</div>
</div>



      </div>
    <script type="text/javascript" src="map_data.js"> </script>
    <script type="text/javascript" src="mapreport.js"> </script>
        
            <script>
        function exportReportToExcel() {
          
        let table = document.getElementsByTagName("table")[0]; // you can use document.getElementById('tableId') as well by providing id to the table tag
           
        let cloneTable=table.cloneNode(true);
        TableToExcel.convert(cloneTable, { // html code may contain multiple tables so here we are refering to 1st table tag
            name: `Map Analysis Report.xlsx`, // fileName you could use any name
            sheet: {
            name: 'Sheet 1' // sheetName
            }
        });
        }
        </script>


 <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
         <script>
        var today, datepicker1,datepicker2,datepicker3,datepicker4;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+1);
        datepicker1 = $('#datepicker1').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });

        datepicker2 = $('#datepicker2').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });

        datepicker3 = $('#datepicker3').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });

        datepicker4 = $('#datepicker4').datepicker({
            maxDate: today,
            format: 'yyyy-mm-dd'
        });
    </script>

            <script src='https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js'></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    </body>
</html>