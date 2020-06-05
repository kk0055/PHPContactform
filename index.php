
<?php

$msg = '';
$msgClass = '';

if(filter_has_var(INPUT_POST,'submit')){
  //Get Form Data
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  //Check Required Fileds
if(!empty($name) && !empty($email) && !empty($message)){
  //Passed
  //Check Email
  if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
    $msg = 'Please use a valid email';
    $msgClass = 'alert-danger';
  }else{
   $toEmail = 'rtsw.lgy@gmail.com';
   $subject = 'Contact Request From ' .$name;
   $body = '<h2> Contact Request</h2>
            <p>Hi.My name is'.$name. '</p>
            <p>Mye email address is'.$email.'</p>';

            $headers = "MIME-Version: 1.0" ."\r\n";
            $headers .="Content-Type:text/html;charset=UTF-8"."\r\n";
            $headers .="From:" .$name."<" .$email.">"."\r\n";

            if(mail($toEmail, $subject, $body,$headers)) {
              $msg = 'Your email has been sent';
              $msgClass = 'alert-success';

            }else{
              $msg = 'Your email was not sent';
              $msgClass = 'alert-danger';
            }
  }
}else{
//Failed
$msg = 'Please fill in all fields';
$msgClass = 'alert-danger';
}



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">My Website</a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarColor02" style="">
  
  
  </div>
</nav>

<br>
<div class="container">
<?php if($msg != '') :?>
 <div class="alert <?php echo $msgClass ;?>"><?php echo $msg ;?></div>
<?php endif; ?>

<form action="<?php echo $_SESSION['PHP_SELF'] ;?>" method="post">
<div class="form-group">
<label for="">Name</label>
<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : '' ;?>">
</div>

<div class="form-group">
<label for="">Email</label>
<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : '' ;?>">
</div>

<div class="form-group">
<label for="">Message</label>
<textarea name="message" class="form-control" value=""><?php echo isset($_POST['message']) ? $message : '' ;?></textarea>
</div>
<br>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>