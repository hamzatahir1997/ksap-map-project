<?php 
include "config.php";
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "home_spanish.php";
}
else{
    include "home_english.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $home_title; ?></title>
    <link rel="stylesheet" href="homepage.css"> 
</head>
<body>

<select id="language" class="form-select" aria-label="Default select example">
            <?php if($_SESSION["English"]==false || $_SESSION["English"]=="false") {  ?> 
            <option value="false">Spanish</option>
            <option value="true">English</option>
            <?php } else { ?>
            <option value="true">English</option>
            <option value="false">Spanish</option>
            <?php } ?>
            </select>

    <div class="logo">
        <img src="pics/6.png"> 
    </div>
    
    <div class="welcome">
        <h1><?php echo $home_heading; ?></h1>
    </div>

    <div class="container">

        <div class="child-container">
        <div class="teacher">
            <img src="pics/14.png">
            <h2><?php echo $educator; ?></h2>
            <h4><?php echo $proceed1; ?></h4>
            <a href="teacher panel"><?php echo $start; ?></a>
        </div>
    
        <div class="student">
           <img src="pics/15.png">
           <h2><?php echo $student; ?></h2>
           <h4><?php echo $proceed2; ?></h4>
           <a href="student panel"><?php echo $start; ?></a>
        </div>
       
  <center style="margin-right:4%;">
   
    <a href="instructional_video.php" id="playme" target="blank" onclick="revealVideo('video','youtube')"><?php echo $watch_video; ?></a>
  </center>

    </div>

    
    </div>


    <div class="d-flex flex-row">
            <div class="col d-flex justify-content-center text-center footer">
          <p class="mt-1"> <?php echo $copyright; ?></p>
            </div>
        </div>

    <script>
console.log("SCRIPT LOADED");
document.querySelector("#language").onchange = function(e){
    console.log(e.target.value);
var url = `config.php?English=${e.target.value}`;
var formData = new FormData();
fetch(url)
.then(function (response) {
  return response.text();
})
.then(function (body) {
  console.log(body);
  window.location.reload();
});
}
</script>
</body>

</html>


