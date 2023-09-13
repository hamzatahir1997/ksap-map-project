<?php 
include "../config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
	include "languages/spanish/listschool.php";
  }
  else{
	include "languages/english/listschool.php";
  }
  

if(!isset($_SESSION['admin_name'])){
    $path = 'error.php';
                    echo "<script>
                    document.location= '$path';
                        </script>";
   
   // header('Location:error.php');
    exit;
}
if(isset($_POST['but_logout'])){
    session_destroy();
    $path = 'index.php';
                    echo "<script>
                    document.location= '$path';
                        </script>";
    //header('Location: index.php');
}


?>
<!doctype html>
<html lang="en">
<head>
	<title><?php echo $school_list; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
	<link rel="stylesheet" href="style3.css">
	
</head>
<body>
	<div class='container'>
				

				<div class="upper jumbotron image-1 img-fluid text-light">
                <div class="row">
		   <form method="post"action="">
				<?php  if (isset($_SESSION['admin_name'])) : ?>
                <div class="col-12">
                <input class="btn but_logout btn-sm" type="submit" value="<?php echo $logout; ?>"name="but_logout" >
                </div>       
		   <?php endif ?>
		   </form> 
		   
		   			<div class="col-12">
                        <img class="float-right"src="../pics/6.png"  class="img-fluid responsive">
                    </div>  
		   
		   </div>
               
                <h2 class="text-center font-weight-bold text-uppercase"><br><?php echo $school_list; ?></h2>
			</div>
            <form method='post' action='upload-manager.php' enctype="multipart/form-data">
			<div class="login-container jumbotron image-3 img-fluid">
					
				<div class="list-school">
			
                <div class="form-group table-responsive">
				<table class="table table-striped ">
    <thead>
      <tr>
	    <th><?php echo $id; ?></th>
        <th><?php echo $school_code; ?></th>
        <th><?php echo $school_name; ?></th>
        <th><?php echo $type; ?></th>
        <th><?php echo $agency; ?></th>
		<th><?php echo $status; ?></th>
		<th><?php echo $inserted; ?></th>
		<th><?php echo $edit; ?></th>
      </tr>
    </thead>
    <tbody>
	  <?php 
$sql = mysqli_query($con, "SELECT id,sname,s_type,agency,status,school_code,insertedOn FROM school_map");
while ($row = $sql->fetch_assoc()){
echo "<tr>"."<td>".$row['id']."</td>"."<td>".$row['school_code']."</td>"."<td>".$row['sname']."</td>"."<td>".$row['s_type']."</td>"."<td>".$row['agency']."</td>"."<td>".$row['status']."</td>"."<td>".$row['insertedOn']."</td>"."<td><a href=editSchool.php?id=".$row['id'].">$edit</a></td>"."</tr>";
}
?>
     
      
    </tbody>
  </table>
        
					</div>

               
				 
				</div>
                <div class="row justify-content-center align-items-center">
                    <p><br><br><br></p>
                  		
					<a href="add-school.php"  class="btn btn-submit btn-lg text-uppercase text-center"><?php echo $add_school_button; ?></a>
                </div>
				

					</div>
				</form>
		</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>