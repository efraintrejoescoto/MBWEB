<?php 

//----------------- E MAIL -------------------------------------------------	
	include ("mail/email_contacto.class.php");
	$mail = new Email ( "ventas@daliimagen.com",			//From e-mail box
						"ventas@daliimagen.com",			//Recipients (semicolon ';' separated)
						"Contact");	//Subject 
	$mail->template = "mail/email_info_contacto.html";
	
	//The array holds the settings for the template

	$mail->template_vars = array ( 
								"#FIRST NAME#" => $_POST['formField_First_Name'],
								"#LAST NAME#" => $_POST['formField_Last_Name'],
								"#REASON FOR CONTACT#" => $_POST['formField_Reason for contact'],
								"#EMAIL#" => $_POST['formField_Email'],
								"#COMMENTS#" => $_POST['formField_Comments']);
	
	//We send the e-mail here!!
	$mail->send ();
		
//--------------------------------------------------------------------------
	$updateGoTo = "default.htm?s=1";
  	header(sprintf("Location: %s", $updateGoTo));
?>