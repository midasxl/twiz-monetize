<?php
/*
A class is a collection of variables and functions that work with those variables. Variables are defined by var and functions by function. A class is defined using the following syntax:
Basic class definitions begin with the keyword class, followed by a class name, followed by a pair of curly braces which enclose the definitions of the properties and methods belonging to the class.
Public: Public method or variable can be accessible from anywhere. Inside the class, outside the class and in child class also.
Private: Method or property with private visibility can only be accessible inside the class. You can not access private method or variable from outside of your class.
Protected: Method or variable with protected visibility can only be access in the derived class. Or in other word in child class. Protected will be used in the process of inheritance.
*/
class User // this is the object that is created throughout the logic, and values are assigned to the its properties
{
	// property declarations only available from within this class
	private 		$clean_email;
	private 		$clean_password;
    
	// property declarations available from anywhere
	public 			$user_active = 0;
	public 			$status = false;
	public 			$sql_failure = false;
	public 			$mail_failure = false;
	public 			$email_taken = false;
	public 			$activation_token = 0;
	public 			$success = NULL;
	
	// method declarations
	/* All objects can have a special built-in method called a ‘constructor’. Constructors allow you to initialise your object’s properties (give your properties values,) when you instantiate (create) an object */
	function __construct($email,$pass)	
	{
		//$this represents the User class; $clean_email is one of the classes private properties
		//it gets set to whatever is fed into the constructor
		
		//Sanitize
		$this->clean_email = sanitize($email);
		$this->clean_password = trim($pass);
		
		if(emailExists($this->clean_email))
		{
			$this->email_taken = true;
		}
		else
		{
			//No problems have been found.
			$this->status = true;
		}
	}
	
	// method declaration
	public function userAddUser()
	{
		global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;
		
		//Prevent this function being called if there were construction errors
		//it will be boolean true if there were no errors
		if($this->status)
		{
			//Construct a secure hash for the plain text password
			$secure_pass = generateHash($this->clean_password);
			
			//Construct a unique activation token
			$this->activation_token = generateActivationToken();
			
			//Do we need to send out an activation email?
			if($emailActivation == "true")
			{
				//User must activate their account first
				$this->user_active = 0;
				
				$mail = new userMail();
				
				//Build the activation message
				$activation_message = lang("ACCOUNT_ACTIVATION_MESSAGE",array($websiteUrl,$this->activation_token));
				
				//Define more if you want to build larger structures
				$hooks = array(
					"searchStrs" => array("#ACTIVATION-MESSAGE","#ACTIVATION-KEY","#USERNAME#"),
					"subjectStrs" => array($activation_message,$this->activation_token)
					);
				
				/* Build the template - Optional, you can just use the sendMail function 
				Instead to pass a message. */
				
				if(!$mail->newTemplateMsg("new-registration.txt",$hooks))
				{
					$this->mail_failure = true;
				}
				else
				{
					//Send the mail. Specify users email here and subject. 
					//SendMail can have a third parameter for message if you do not wish to build a template.
					
					if(!$mail->sendMail($this->clean_email,"New User"))
					{
						$this->mail_failure = true;
					}
				}
				$this->success = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE2");
			}
			else
			{
				//Instant account activation
				$this->user_active = 1;
				$this->success = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE1");
			}	
			
			
			if(!$this->mail_failure)
			{
				//Insert the user into the database providing no errors have been found.
				$stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."users (
					password,
					email,
					activation_token,
					last_activation_request,
					lost_password_request, 
					active,
					title,
					sign_up_stamp,
					last_sign_in_stamp,
					pass_change
					)
					VALUES (
					?,
					?,
					?,
					'".time()."',
					'0',
					?,
					'Free Member',
					'".time()."',
					'0',
					'0'
					)");
					
					// for future reference
					//<?php
					//$timestamp=1333699439;
					//echo gmdate("Y-m-d\TH:i:s\Z", $timestamp);
				
				$stmt->bind_param("sssi", $secure_pass, $this->clean_email, $this->activation_token, $this->user_active);
				$stmt->execute();
				$inserted_id = $mysqli->insert_id;
				$stmt->close();
				
				//Insert default permission into matches table; At this point they will all be free members (permission level 2)
				$stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."user_permission_matches  (
					user_id,
					permission_id
					)
					VALUES (
					?,
					'2'
					)");
				$stmt->bind_param("s", $inserted_id);
				$stmt->execute();
				$stmt->close();
				
				// send email to administrator group notifying of the new member registration
				$to      = 'sparkhw@gmail.com,douglas.wood@zoho.com,mistylynn@stny.rr.com';
				$subject = 'New Member Registration';
				$message = 'A new member, ' . $this->clean_email . ', has registered for Thoroughwiz!';
				$headers = 'From: noreply@example.com' . "\r\n" .
				'Reply-To: noreply@example.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
			}
		}
	}
}

?>