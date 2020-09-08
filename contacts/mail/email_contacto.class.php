<?
/*	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

	Contact.
	
	Efrainmoxy
	
	moxy13@gmail.com
	
	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/


//FORMATI EMAIL
	define ("EMAIL_FORMAT_HTML",1);
	define ("EMAIL_FORMAT_PLAIN",2);

//ERRORI
	define ("EMAIL_MISSING_RECIPIENT",-1);
	define ("EMAIL_FILE_NOT_EXISTS",-2);


//############ CONFIGURAZIONE #####################################
	define ("EMAIL_DEF_FROM_NAME","daliimagen.com");
	define ("EMAIL_DEF_FROM_EMAIL","ventas@daliimagen.com");
//##################################################################

class Email {
//##########_Public_#######################################
	//Oggetto
	var $subject;	
	
	//Corpo messaggio
	var $body;		
	
	//Destinatarii
	var $to;	
	
	//Da (nome)
	var $from;		
	
	//(HTML | PLAIN)
	var $format;	
	
	//Percorso template
	var $template;	
	
	//Variabili da sostituire
	var $template_vars;

//##########_Private_########################################
	//Intestazioni
	var $headers;

	//Stato classe
	var $state;
		
	function Email ($from="",$to="",$subject="",$body="",$format=EMAIL_FORMAT_HTML)  {

			

$this->headers  = "From: ".EMAIL_DEF_FROM_NAME." <".EMAIL_DEF_FROM_EMAIL.">\n"; 			
			
		
		$this->to = $to;
		
		$this->subject = $subject;
		
		
	}	

	function send () {
		//Imposto il corpo della mail
		$this->setBody ();
		//Se $to è una stringa, la trasf. in array
		if (!is_array($this->to) && $this->to) $this->to = explode(";",$this->to);
		foreach ($this->to as $v) 
			///////////////////////////////
$boundary = md5(uniqid(time())); 


$this->headers .= 'To: ' . $v . "\n";
$this->headers .= 'Return-Path: ' . EMAIL_DEF_FROM_EMAIL . "\n"; 
$this->headers .= 'MIME-Version: 1.0' ."\n"; 
//$this->headers .= 'Content-Type: multipart/alternative; boundary="' . $boundary . '"' . "\n\n";
//$this->headers .= $body_simple . "\n"; 
//$this->headers .= '--' . $boundary . "\n"; 
//$this->headers .= 'Content-Type: text/plain; charset=ISO-8859-1' ."\n"; 
//$this->headers .= 'Content-Transfer-Encoding: 8bit'. "\n\n";
//$this->headers .= $body_plain . "\n";
//$this->headers .= '--' . $boundary . "\n";
$this->headers .= 'Content-Type: text/HTML; charset=ISO-8859-1' ."\n";
$this->headers .= 'Content-Transfer-Encoding: 8bit'. "\n\n";
$this->headers .= $this->body . "\n"; 
$this->headers .= '<!--' . $boundary . "-->\n"; 

		
			/////////////////////////////		

		
	
			if (mail ("",$this->subject,"",$this->headers))
				echo "";			
	}

	function setBody () {
		if (!$this->body && is_array($this->template_vars) && $this->template) {
		
			if (!file_exists($this->template)) { $this->state = EMAIL_FILE_NOT_EXISTS; return;}
			
			$this->body = join ("",file($this->template));

			foreach ($this->template_vars as $k=>$v) 
				$this->body = str_replace ($k,$v,$this->body);
		}
	}
}






?>