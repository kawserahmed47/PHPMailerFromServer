<?php

//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
    require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	if(isset($_POST['submit'])){
	 $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    
    move_uploaded_file($file_temp, $uploaded_image);

//Create instance of PHPMailer
	$mail = new PHPMailer(true);
//Set mailer to use smtp
//	$mail->isSMTP();
//Define smtp host
	$mail->Host = "mail.cmbbd.net";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "ssl";
//Port to connect smtp
	$mail->Port = "465";
//Set gmail username
	$mail->Username = "cmbbdtest@cmbbd.net";
//Set gmail password
	$mail->Password = "DZ]sz.uhFeGY";
//Email subject
	$mail->Subject = "Test From PHPMailer";
//Set sender email
	$mail->setFrom('cmbbdtest@cmbbd.net');
	$mail->addReplyTo('kawserahmed47@gmail.com', 'Kawser');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('upload/attachment.png');
	$mail->addAttachment($uploaded_image);
//Email body
//$mail->Body ="This is mail body";
	$mail->Body = "<h1>This is HTML h1 Heading</h1></br><p>This is html paragraph</p>";
//Add recipient
	$mail->addAddress('kawserahmed47@gmail.com');
//Finally send email
	if ( $mail->send() ) {
		echo "Email Sent..!";
	}else{
		echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
	}
//Closing smtp connection
	$mail->smtpClose();
	
	}
	
	?>
	
	<html>
   <head>
     <title>Message test</title>
      
   </head>
   <body>
     <form enctype="multipart/form-data" method="POST" action=""> 
	<label>Attachment <input type="file" name="image" /></label> 
	<label><input type="submit" name="submit" value="Submit" /></label> 
</form> 

   </body>
</html>
