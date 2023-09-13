<?php

if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
    include "languages/spanish/messages.php";
}
else{
    include "languages/english/messages.php";
}

  
if (count($errors) > 0) : ?>
  <div class="alert alert-danger temp">
  	<?php foreach ($errors as $error) : ?>
		<strong><?php echo $errort; ?></strong> <?= $error ?>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
<?php 
