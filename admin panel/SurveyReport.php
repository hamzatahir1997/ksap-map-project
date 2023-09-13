<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/SurveyReport.php";
}
else{
    include "languages/english/SurveyReport.php";
}


// Check user login or not
if(!isset($_SESSION['teacher_name']) && !isset($_SESSION['admin_name'])){
    
    $path = 'error.php';
    echo "<script>
   document.location= '$path';
    </script>";
   
    //header('Location: ../teacher panel/error.php');
    exit;
}
// logout
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

if(isset($_POST['back_screen'])){
    $path = 'selectSchool.php';
             echo "<script>
            document.location= '$path';
             </script>";
    //header('Location: selectSchool.php');
}

$condition2 = "";
if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
    
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $condition2 = " AND sd.insertedOn between '$from_date' AND '$to_date' ";

  } else {
    $condition2 = "";
  }

$agency_name = $_GET["agency"];
$school_name = $_GET["school"];
if($agency_name != "null"){

    $condition =  "where s.Agency =".$agency_name;
     
    if($school_name != "null")
    {
        $condition =  "where s.Agency =".$agency_name . "and sd.school_id=".$school_name;

        $query="SELECT DISTINCT id, floorlevel FROM school_floor  where status = 1  AND school_id= ". $school_name;
        $sql = mysqli_query($con, $query );
        $row = mysqli_fetch_array($sql);
        $new_url='mapReport.php?agency='.$agency_name.'&school='.$school_name.'&floor='.$row['floorlevel']; 
        
        
    }
}


?>
<!DOCTYPE html>
<html>
<head>
        <title><?php echo $survey_report; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel='stylesheet' href='https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css'>
 
    
    <link rel="stylesheet" href="surveyreportstyle.css"><style type="text/css">



.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
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
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
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


        <div class="container-fluid">
            <form method='POST' action=''>

            <input type="hidden" value=<?php echo $agency_name?> name="agency" id="agency">
            <input type="hidden" value="<?php echo $school_name?>" name="school" id="school">
            
            <div class="row upper-container">
			<?php  if (isset($_SESSION['admin_name'])|| isset($_SESSION['teacher_name'])) : ?>
                <div class="col-12 logoutandback">
                    <input type="submit" value="<?php echo $logout; ?>"name="but_logout" class="btn btn-light but_logout btn-sm noprint">
                    <input type="submit" value="<?php echo $back; ?>"name="back_screen" class="btn btn-light backscreen btn-sm noprint">
                </div> 
           <?php endif ?> 
                  
                <div class="col-12">
                    <img class="float-right" src="../pics/6.png"  class="img-fluid responsive" />
                </div>

                <div class="col-12">
                    <h1 class="heading text-uppercase">Survey Analysis</h1>
            
                </div>

         <div class="col-12 d-flex justify-content-center align"> 

           <?php 
            if ($school_name=="null") : {
                
                $query="SELECT DISTINCT agency FROM school_map  where status = 1  AND agency=". $agency_name;
                    $sql = mysqli_query($con, $query );          
                    $row = $sql->fetch_assoc()?>
                       
               <span class="badge badge-primary"><h4 class="heading1 mt-2"><?php echo $row['agency'] ?></h4>
               
            </span> 
            <?php 
             }
            else:
                { $query="SELECT DISTINCT sname,s_type FROM school_map  where status = 1  AND id= ". $school_name;
                    $sql = mysqli_query($con, $query );          
                    $row = $sql->fetch_assoc()?>

                        <span class="badge badge-primary"><h4 class="heading1 mt-2"><?php echo  $row['sname']." ". $row['s_type'] ?></h4>
                        </span> 
                            
                    <?php 
                }  
        

            endif; ?> 
           
                       
            </div>
                  
        </div>
                
              </form>
        


 
	<div class="row lower-container">
       
      
    <div class="col-md-12 formcheck">
    <form method='POST' action=''>
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
                      <input id="datepicker2"type="" class="p-2 date"value="<?php echo $to_date; ?>" required/>
                    </div>
                </div>
                      <div class='form-group d-flex justify-content-center mt-4'>
                      <input type="submit" name="" id="" onclick="window.reload()" value="<?php echo $reset; ?>" class="btn btn-year noprint"/> 
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
                        <input type="submit" class="btn btn-year noprint" value="<?php echo $search; ?>">
                 </div>
                      <?php } ?>
                      </form>
          </div>
  
    </div>
  
  <div class="col-lg-12">            
    <div class="row justify-content-center">
        <div class="col-md-8 col-12 mt-2" style="text-align:center;">     
            <div class="box">
                <div class="box-left">
                    <img class="mt-3" src="../pics/28.png">
                </div>
                <div class="box-right" data-for="grade">
                    <img class="mt-3" src="../pics/27.png">
                </div>
                <h4 id="gradeheading" class="mt-4"><?php echo $grade; ?></h4>
            </div>
        </div>
    </div>

    <div id="grade" class="toggle">


    <div class="row justify-content-center">

    <figure class="col-md-12 highcharts-figure">
           <div id="gradechart" width="100%"></div>
           <p class="highcharts-description">
        &nbsp;
           </p>
       </figure>
</div>
 <div class="row justify-content-center">
       
  <div class="col-sm-4 col-md-4 mt-1"> 
       
  <table class="table table-striped table-hover"id="grade_table">
      <thead>
        <tr>
          <th><?php echo $grade; ?></th>
          <th><?php echo $percentage; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php 
  $sql = mysqli_query($con, "SELECT Grade, Count(Grade) as rel_count, round(count(Grade)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
  sd inner join school_map s on s.id = sd.school_id
  ".$condition."".$condition2."
  group by Grade");

  while ($row = $sql->fetch_assoc()){
  echo "<tr>"."
  <td class='th'>".$row['Grade']."</td>
  "."<td>".$row['Percentage']."%</td>
  "."</tr>";
  }
  ?>
      </tbody>
    </table>
  
  </div>
</div>
  </div>
  
  </div>
    
  

  <div class="col-lg-12 ">  
    
    <div class="row justify-content-center">
        
        <div class="col-md-8 col-12 mt-2" style="text-align:center;">
            
            <div class="box">
                <div class="box-left">
                    <img class="mt-3" src="../pics/29.png">
                </div>
                <div class="box-right" data-for="gender">
                    <img class="mt-3" src="../pics/27.png">
                </div>
                <h4 id="genderheading"class="mt-4"><?php echo $gender; ?></h4>
            </div>
        </div>
    </div>
<div id="gender"class="toggle">

    <div class="row justify-content-center">
    
    <figure class="col-md-12 highcharts-figure">
           <div id="genderchart" width="100%"></div>
           <p class="highcharts-description">
        &nbsp;
           </p>
       </figure>
    
</div>
    <div class="row justify-content-center">
    <div class="col-sm-12 col-md-4"> 
        <table class="table table-striped table-hover"  width="" id="gender_table">
            <thead>
              <tr>
                <th><?php echo $gender; ?></th>
                <th><?php echo $percentage; ?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
        $sql = mysqli_query($con, "SELECT Gender, Count(Gender) as rel_count, round(count(Gender)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
        sd inner join school_map s on s.id = sd.school_id
        ".$condition."".$condition2."
        group by Gender");
        while ($row = $sql->fetch_assoc()){
        echo "<tr>"."
        <td class='th'>".$row['Gender']."</td>
        "."<td>".$row['Percentage']."%</td>
        "."</tr>";
        }
        ?>
            </tbody>
          </table>
        
        </div>

    </div>
    
    </div>
</div>
    
	


     <div class="col-lg-12"> 

        <div class="row justify-content-center">
        
            <div class="col-md-8 col-12 mt-2" style="text-align:center;">
                
                <div class="box">
                    <div class="box-left">
                        <img class="mt-3" src="../pics/30.png">
                    </div>
                    <div class="box-right" data-for="religion">
                        <img class="mt-3" src="../pics/27.png">
                    </div>
                    <h4 id="religionheading"class="mt-4"><?php echo $religion; ?></h4>
                </div>
            </div>
        </div>
     
    <div id="religion"class="toggle">
        <div class="row justify-content-center">

       <figure class="col-md-12 highcharts-figure">
           <div id="religionchart" width="100%"></div>
           <p class="highcharts-description">
        &nbsp;
           </p>
       </figure>
    </div>
       <div class="row justify-content-center">

        <div class="col-sm-12 col-md-4 mt-3"> 
            <table class="table table-striped table-hover"id="religion_table">
                <thead>
                  <tr>
                    <th><?php echo $religion; ?></th>
                    <th><?php echo $percentage; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
            $sql = mysqli_query($con, "SELECT Religion, Count(Religion) as rel_count, round(count(Religion)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
            sd inner join school_map s on s.id = sd.school_id
            ".$condition."".$condition2."
            group by Religion");
            while ($row = $sql->fetch_assoc()){
            echo "<tr>"."
            <td class='th'>".$row['Religion']."</td>
            "."<td>".$row['Percentage']."%</td>
            "."</tr>";
            }
            ?>
                </tbody>
              </table>
            
            </div>
    
        </div>
    </div>
       
       </div>

     



       <div class="col-lg-12"> 
     
        <div class="row justify-content-center">
        
            <div class="col-md-8 col-12 mt-2" style="text-align:center;">
                
                <div class="box">
                    <div class="box-left">
                        <img class="mt-3" src="../pics/31.png">
                    </div>
                    <div class="box-right" data-for="race">
                        <img class="mt-3" src="../pics/27.png">
                    </div>
                    <h4 id="raceheading" class="mt-4"><?php echo $race_e; ?></h4>
                </div>
            </div>
        </div>
        <div id="race"class="toggle">
            <div class="row justify-content-center">

            <figure class="col-md-12 highcharts-figure">
           <div id="racechart" width="100%"></div>
           <p class="highcharts-description">
        &nbsp;
           </p>
       </figure>
    </div>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-4 mt-3"> 
                <table class="table table-striped table-hover"  width=""id="race_table">
                    <thead>
                      <tr>
                        <th><?php echo $race; ?></th>
                        <th><?php echo $percentage; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                $sql = mysqli_query($con, "SELECT Race, Count(Race) as rel_count, round(count(Race)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
                sd inner join school_map s on s.id = sd.school_id
                ".$condition."".$condition2."
                group by Race");
                while ($row = $sql->fetch_assoc()){
                echo "<tr>"."
                <td class='th'>".$row['Race']."</td>
                "."<td>".$row['Percentage']."%</td>
                "."</tr>";
                }
                ?>
                    </tbody>
                  </table>
                
                </div>
        
            </div>
        </div>
        
	 </div>



<div class="col-md-12"> 
  
    <div class="row justify-content-center">
        
        <div class="col-md-8 col-12 mt-2" style="text-align:center;">
            
            <div class="box">
                <div class="box-left">
                    <img class="mt-3" src="../pics/32.png">
                </div>
                <div class="box-right" data-for="orientation">
                    <img class="mt-3" src="../pics/27.png">
                </div>
                <h4 id="orientationheading" class="mt-4"><?php echo $s_orientation; ?></h4>
            </div>
        </div>
    </div>

    <div id="orientation"class="toggle">
        <div class="row justify-content-center">
        
       <figure class="col-md-12 highcharts-figure">
           <div id="orientationchart" width="100%"></div>
           <p class="highcharts-description">
        &nbsp;
           </p>
       </figure>

</div>

<div class="row justify-content-center">

<div class="col-sm-4 col-md-4 mt-3"> 
       
    <table class="table table-striped table-hover"id="orientation_table">
        <thead>
          <tr>
            <th><?php echo $orientation; ?></th>
            <th><?php echo $percentage; ?></th>
                 
          </tr>
        </thead>
        <tbody>
          <?php 
    $sql = mysqli_query($con, "SELECT S_orient, Count(S_orient) as rel_count, round(count(S_orient)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data` 
    sd inner join school_map s on s.id = sd.school_id
    ".$condition."".$condition2."
    group by S_orient");
    while ($row = $sql->fetch_assoc()){
    echo "<tr>"."
    <td class='th'>".$row['S_orient']."</td>
    "."<td>".$row['Percentage']."%</td>
    "."</tr>";
    }
    ?>
        </tbody>
      </table>
    
    </div>

</div>

</div>


</div>

	 

	 
<div class="col-md-12"> 

    <div class="row justify-content-center">
        
        <div class="col-md-8 col-12 mt-2" style="text-align:center;">
            
            <div class="box">
                <div class="box-left">
                    <img class="mt-3" src="../pics/33.png">
                </div>
                <div class="box-right" data-for="details">
                    <img class="mt-3" src="../pics/27.png">
                </div>
                <h4 class="mt-4"><?php echo $details; ?></h4>
            </div>
        </div>
    </div>
  
    
    <div class="table-responsive toggle" id="details" >
        <br>
<table class="table table-striped table-hover"width="100%"id="details_table">
    <thead>
      <tr>
	    <th> <h4><span class="badge badge-info"><?php echo $id; ?></span></h4></th>
        <th><?php echo $school_column; ?></th>
        <th><?php echo $type; ?></th>
        <th><?php echo $agency; ?></th>
		<th><?php echo $grade; ?></th>
		<th><?php echo $gender; ?></th>
		<th><?php echo $religion; ?></th>
		<th><?php echo $race; ?></th>
		<th><?php echo $s_orientation; ?></th>
	 
      </tr>
    </thead>
    <tbody>
	  <?php 
$sql = mysqli_query($con, "SELECT sd.id,s.sname 'School Name', s.s_type as 'Type', s.Agency, Grade,Gender,Religion,Race,S_orient as 'Sex Orientation' FROM `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2."");
while ($row = $sql->fetch_assoc()){
echo "<tr>"."
<td class='th'>".$row['id']."</td>
"."<td>".$row['School Name']."</td>
"."<td>".$row['Type']."</td>
"."<td>".$row['Agency']."</td>
"."<td>".$row['Grade']."</td>
"."<td>".$row['Gender']."</td>
"."<td>".$row['Religion']."</td>
"."<td>".$row['Race']."</td>
"."<td>".$row['Sex Orientation']."</td>
"."</tr>";
}
?>
    </tbody>
  </table>
  </div>
</div>

<br>
</hr>
<div class="col-lg-12 d-flex justify-content-center"> 
 
        
<?php   
 if($school_name != "null"):{
    ?>
    
    <a  href='<?php echo $new_url ?>'>

    <button type="button" id="sub" name="sub" class="btn btn-submit btn-lg text-uppercase text-center noprint mt-5 mb-5"><?php echo $next; ?></button>
    </a>

    <?php 
    }
    else:
        {
            ?>
            <!-- <button disabled type="button" class="btn btn-primary pull-right">Next</button></br> -->
            <!-- <span class="label label-danger">Please select school from selection screen!</span> -->
            <button  disabled type="button" class="btn btn-danger btn-lg noprint mt-5 mb-5 noprint"><?php echo $next_message; ?></button>
            <?php 
        }  
 

    endif; ?> 
      
      
</div>
<div class="col-lg-12"> 
<a href="#" class="btn print_btn mr-2 mb-2  float-right noprint" id="print_btn"><?php echo $print; ?></a>

<button id="btnExport"class=" float-right noprint btn print_btn mr-2" onclick="exportReportToExcel(this)"><?php echo $excel_download; ?></button>

</div>
</div>





   

      </div>
      <script type="text/javascript" src="surveyReport.js"></script>
    
      <script>
 function exportReportToExcel() {
  let tables = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  let i=0;
  for (table of tables){
    let id=table.id
  TableToExcel.convert(table, { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `${id}.xlsx`, // fileName you could use any name
    sheet: {
      name: `Sheet ${i}` // sheetName
    }
  });
}
 }
 </script>


 <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

	 <script type="text/javascript">
     var religion_heading=document.querySelector("#religionheading").innerHTML;
     // Religion Highcharts
Highcharts.chart('religionchart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:'transparent'
    },
    title: {
        text: religion_heading,
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                
				enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [
		
		  <?php 
 $sql = mysqli_query($con, "SELECT Religion, Count(Religion) as rel_count, round(count(Religion)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
 sd inner join school_map s on s.id = sd.school_id
 ".$condition."".$condition2."
 group by Religion");
while ($row = $sql->fetch_assoc()){
echo 
		"{
            name: '".$row['Religion']."',
            y: ".$row['Percentage']."
        },"
;
}
?>
			
		]
    }]
});
		</script>




<script type="text/javascript">
 var orientation_heading=document.querySelector("#orientationheading").innerHTML;
 // Orientation Highcharts
Highcharts.chart('orientationchart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:'transparent'
    },
    title: {
        text: orientation_heading,
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                
				enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [
		
		  <?php 
  $sql = mysqli_query($con, "SELECT S_orient, Count(S_orient) as rel_count, round(count(S_orient)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data` 
  sd inner join school_map s on s.id = sd.school_id
  ".$condition."".$condition2."
  group by S_orient");
while ($row = $sql->fetch_assoc()){
echo 
		"{
            name: '".$row['S_orient']."',
            y: ".$row['Percentage']."
        },"
;
}
?>
			
		]
    }]
});
		</script>













 
<script type="text/javascript">
var gender_heading=document.querySelector("#genderheading").innerHTML;
// Gender Highcharts
Highcharts.chart('genderchart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:'transparent'
    },
    title: {
        text: gender_heading,
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                
				enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [
		
		  <?php 
   $sql = mysqli_query($con, "SELECT Gender, Count(Gender) as rel_count, round(count(Gender)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
   sd inner join school_map s on s.id = sd.school_id
   ".$condition."".$condition2."
   group by Gender");
while ($row = $sql->fetch_assoc()){
echo 
		"{
            name: '".$row['Gender']."',
            y: ".$row['Percentage']."
        },"
;
}
?>
		
		
		]
    }]
});
		</script>

 
<script type="text/javascript">
var grade_heading=document.querySelector("#gradeheading").innerHTML;
// Grade Highcharts
Highcharts.chart('gradechart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:'transparent'
    },
    title: {
        text: grade_heading,
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                
				enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [
		
		  <?php 
 $sql = mysqli_query($con, "SELECT Grade, Count(Grade) as rel_count, round(count(Grade)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
 sd inner join school_map s on s.id = sd.school_id
 ".$condition."".$condition2."
 group by Grade");
while ($row = $sql->fetch_assoc()){
echo 
		"{
            name: '$grade ".$row['Grade']."',
            y: ".$row['Percentage']."
        },"
;
}
?>
		
		
		]
    }]
});
		</script>



         
<script type="text/javascript">
var race_heading=document.querySelector("#raceheading").innerHTML;
// Grade Highcharts
Highcharts.chart('racechart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:'transparent'
    },
    title: {
        text: race_heading,
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                
				enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [
		
		  <?php 
$sql = mysqli_query($con, "SELECT Race, Count(Race) as rel_count, round(count(Race)*100 / (select count(*) from `survey_data` sd inner join school_map s on s.id = sd.school_id ".$condition."".$condition2." ), 1) as 'Percentage' FROM `survey_data`
sd inner join school_map s on s.id = sd.school_id
".$condition."".$condition2."
group by Race");
while ($row = $sql->fetch_assoc()){
echo 
		"{
            name: '".$row['Race']."',
            y: ".$row['Percentage']."
        },"
;
}
?>
		
		
		]
    }]
});
		</script>
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

