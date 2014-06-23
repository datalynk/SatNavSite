<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $query = ($_POST["query"]);
  $message = trim($_POST["message"]);

if ($name == "" OR $email == "" OR $message == ""){
    $error_message = "Ooops! You don't appear to have entered all the details. Please make sure you've filled in your name, 
        email address and message.";
  }
if(!isset($error_message)){
  foreach ($_POST as $value){
    if (stripos($value, 'content-type: ') !== FALSE) {
      $error_message = "There was a problem with the information you entered.";
    }
  }
}

if(!isset($error_message) AND $_POST["Address"] != ""){
    $error_message = "Your form submission has an error.";
  }

  require_once("inc/phpmailer/class.phpmailer.php");
  $mail = new PHPMailer();

  if(!isset($error_message)){

    $mail->Host = "relay-hosting.secureserver.net";

    $email_body = "";
    $email_body = $email_body . "Name :" . $name . "<br>";
    $email_body = $email_body . "Email :" . $email . "<br>";
    $email_body = $email_body . "Message :" . $message;
    
    $mail->setFrom($email, $name);
    $address = "contact@towerlakevacations.com";
    $mail->AddAddress($address, "Tower Lake Vacations");
    $mail->Subject = $query . " - " . $name;
    $mail->msgHTML($email_body);

  if ($mail->send()){
    header("Location: contact.php?status=thanks");
    exit;
  }
  else{
    $error_message = "There was a problem sending the email: " . $mail->ErrorInfo;
  }

}

}?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/custom.css" rel="stylesheet">

    <title>Sat Nav Hire USA</title>

    <!-- Custom styles for this template -->
    <link href="CSS/justified-nav.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <h3 class="text-muted">Sat Nav Hire USA</h3>
        <ul class="nav nav-justified">
          <li><a href="index.php">Home</a></li>
          <li><a href="theservice.php">The Service</a></li>
          <li><a href="hire.php">Hire Now</a></li>
          <li><a href="villarentals.php">Villa Rentals</a></li>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="testimonials.php">Testimonials</a></li>
          <li class="active"><a href="contactus.php">Contact Us</a></li>
          <li><a href="usefullinks.php">Useful Links</a></li>
        </ul>
      </div>

      

      <!-- Example row of columns -->
      <div class="row main-content">
        <div class="col-lg-6 col-lg-offset-3">
          <h2 class="contact-us">Contact Us</h2>


<div class="container">
  <?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") { ?>
      <div class = "center-me">
      <h2>Thanks for the message.<br>
        We'll get back to you as soon as possible.<br>
        Have a great day.<br><br></h2>
      <h3><a href="index.php">Return Home</a></h3>
    </div><?php } else { ?>
  

  <div class="col-lg-6 pull-right contact-instruction contact-info">
    
    <?php if(!isset($error_message)){ ?>
      
        <h3>Please contact us if you need to query prices, confirm a booking or want to 
        leave us any feedback and we&rsquo;ll get back to you as soon as we can.</h3>
      
    <?php } else {
      echo "<h2>" . $error_message . '</h2>';
      }
    ?>

  </div>
    <form method="post" action="contact.php">
      <fieldset>

      <legend><h2 class="subheader">Contact Us</h2></legend>
        <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" value"<?php if(isset($name)) {echo htmlspecialchars($name); } ?>">
        </div>

        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email address" name="email" value"<?php if(isset($email)) {echo htmlspecialchars($email); } ?>">
        </div>

        <div>
          <label>Query Type</label>
          <select class="form-control" id="query" name="query">
            <option>---Please Select One---</option>
            <option>General Query</option>
            <option>Feedback On My Stay</option>
            <option>Book The Villa</option>
          </select>
        </div>

        <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" rows="6" id="message" placeholder="Type your message here" name="message"><?php if(isset($message)) {echo htmlspecialchars($message); } ?></textarea>
        </div>

        <div class="form-group" style="display: none;">
        <label for="address">Address</label>
        <textarea class="form-control" rows="6" id="Address" placeholder="Address" name="Address"></textarea>
        <p>If you're human, please leave address field blank!</p>
        </div>

      <button type="submit" class="btn btn-primary btn-lg">Send</button>
      </fieldset>
    </form>
  <?php } ?>
</div>

          

        </div>
      </div>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<script src="js/jquery-1.10.2.min"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Enable responsive features in IE8 with Respond.js (https://github.com/scottjehl/Respond) -->
<script src="js/respond.js"></script>

</body>
</html>