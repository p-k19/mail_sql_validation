<!DOCTYPE html>
<html>
<head>
	<title>Send mail from PHP using SMTP</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1 class="text-center">Sending Emails in PHP from localhost with SMTP</h1>
<h2 class="text-center">Part 3: Using PHPMailer with attachments</h2>
<hr>
	<?php 
	global $result;
	$generator = "1357902468"; 
	$result = ""; 
		  
	for ($i = 1; $i <= 4; $i++) { 
				$result .= substr($generator, (rand()%(strlen($generator))), 1); 
			} 

		if(isset($_POST['sendmail'])) {
			require 'PHPMailerAutoload.php';
			require 'credential.php';
			//require 'includes/SMTP.php';

			$mail = new PHPMailer;

			// $mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                          // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';                          // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                                  // Enable SMTP authentication
			$mail->Username = 'pk5753549@gmail.com';                 // SMTP username
			$mail->Password = 'Kumar@2021';                           // SMTP password
			$mail->SMTPSecure = 'tls';                               // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                       // TCP port to connect to
            //echo $_POST['email'];
			$mail->setFrom('pk5752549@gmail.com', 'Trial');
			$mail->addAddress($_POST['email']);                      // Add a recipient
          
			$mail->addReplyTo(EMAIL);
			// print_r($_FILES['file']); exit;
			for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
				$mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
			}
			$mail->isHTML(true);                                     // Set email format to HTML

			$mail->Subject = $_POST['subject'];
			$mail->Body    = $result ;
			$mail->AltBody = $_POST['message'];

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			
			}
		}

		
      
			
			
		  
	 
	 
		
	
	
		
		  
		?> 
	 ?>
	<div class="row">
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data">
        	<div class="row">
                <div class="col-sm-9 form-group">
                    <label for="email">To Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="50">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="Test Mail with attachments" maxlength="50">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">Message:</label>
                    <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Your Message Here" maxlength="6000" rows="4">Test mail using PHPMailer</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">File:</label>
                    <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
					
                </div>
            </div>
			<div class='row'>
			<div class="col-sm-9 form-group">
			<label for="name">OTP:</label>
            <input  class="form-control" type="number" id="otp">
			<button type="number" name="verify" class="btn btn-lg btn-success btn-block">Verify</button>
			</div>
			</div>
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
                </div>
            </div>
			
        </form>
	</div>
</div>
</body>
</html>

