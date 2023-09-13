<?php 
if ($_SESSION["English"] == false || $_SESSION["English"] == "false"){
  include "languages/spanish/messages.php";
}
else{
  include "languages/english/messages.php";
}

$errors = [];
$user_id = "";


/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM teacher_data WHERE email='$email'";
  $results = mysqli_query($con, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors,$em1);
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(email, token) values ('$email', '$token')";
    $results = mysqli_query($con, $sql);
    // $success_message  = $sm1;

    $html = '<html><body><a href="www.hotspotmapky.com/teacher%20panel/reset_password.php?token="'.$token.'">link</a></body></html>';
    // Send email to user with the token in a link they can click on
    $to = $email;
    
  
    $subject = "Reset your password";
    $msg = "Hi there, click on this <a href=\"www.hotspotmapky.com/teacher%20panel/reset_password.php?token=" . $token . "\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    
    $headers = "From: support@liamcrest.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";   
    mail($to, $subject, $msg, $headers);



    $success_message=$sm2; 
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($con, $_POST['upassword']);
  $new_pass_c = mysqli_real_escape_string($con, $_POST['urpassword']);
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, $em2);
  if ($new_pass !== $new_pass_c) array_push($errors,$em3);
  if(!isset($_SESSION['teacher_name'])){
  // Grab to token that came from the email link
  
  if (count($errors) == 0) {
    $token = $_POST["token_id"];
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
    $results = mysqli_query($con, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE teacher_data SET upassword='$new_pass' WHERE email='$email'";
      $results = mysqli_query($con, $sql);

      $path = 'index.php';
      echo "<script>
  
      document.location= '$path';
  
      </script>";
  
      //header('Location:index.php');
    }
  }
}
else{
    $teacher_name = $_SESSION['teacher_name'];
    
    if (count($errors) == 0) {
    if ($teacher_name) {
        $new_pass = md5($new_pass);
        $sql = "UPDATE teacher_data SET upassword='$new_pass' WHERE uname='$teacher_name'";
        $results = mysqli_query($con, $sql);
        $path = 'index.php';
         echo "<script>
            document.location= '$path';
      </script>";
        //header('Location:index.php');
        session_destroy();
      }
    }
}
}
?>



