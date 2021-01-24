<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Contact Me | Drew Donovan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
	<style>
	body {
		background-color:  rgba(0, 128, 0, 0.144);
		font-size:100%;
	}

	h1{
		background: linear-gradient(to bottom, rgb(0, 128, 0) 0%,rgba(0, 128, 0, 0.363) 100%);
		transition-duration: 1s;
		color:black;
		text-align:center;
		padding:2%;
		margin:0;
	}
	h1:hover{
		background-color: rgba(0, 128, 0, 0.527);
		transition-duration: 1s;
	}
	h1 small{
    color: rgb(90, 90, 90);
	}

	form {
		width:459px;
		margin:0 auto;
	}

	label {
		display:block;
		margin-top:20px;
		letter-spacing:2px;
	}

	input, textarea {
		width:439px;
		height:27px;
		background:#efefef;
		border-radius:5px;
		border:1px solid #dedede;
		padding:10px;
		margin-top:3px;
		font-size:0.9em;
		color:#3a3a3a;
	}

	textarea {
		height:213px;
		font-family:Arial, Helvetica, sans-serif;
	}

	#submit {
		width:127px;
		height:38px;
		border:none;
		margin-top:20px;
		cursor:pointer;
		border: 1px solid gray;
		background-color:gray;
		color:white;
	}
	
	</style>
</head>
<body>
  	<h1>
		Contact Me
		<small class ="d-none d-md-block">Emailing ddd5189@rit.edu</small>
	</h1>
 	<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        
            <label>Name</label>
            <input name="name" placeholder="Type Here">
            
            <label>Email</label>
			<input name="email" type="email" placeholder="person@sample.com">
			
			<label>Subject</label>
	    	<input name="subject" placeholder="Type Here">
            
            <label>Message</label>
            <textarea name="message" placeholder="Type Here"></textarea>
            
            <label>*What is 2+2? (Anti-spam)</label>
            <input name="human" placeholder="Type Here">
            
            <input class="text-center" id="submit" name="submit" type="submit" value="Submit">
        
        </form>
 <?php   
 	// ** Form validation code **
 	// We will use the $_POST "super global" associative array to extract the values of the form fields
	// #1 - was the submit button pressed?
    if (isset($_POST["submit"])){ 
    	$to = "ddd5189@rit.edu"; // !!! REPLACE WITH YOUR EMAIL !!!
    	
    	// #2 - if a value for the `email` form field is missing, give a default value
    	// else, use the value from the form field
			$from = empty(trim($_POST["email"])) ? "noemail@sample.com" : sanitize_string($_POST["email"]);
			
			$subject = "Web Form";
			
			// #3 - same as above, except with the `message` form field
			$message = empty(trim($_POST["message"])) ?  "No message" : sanitize_string($_POST["message"]);
			
			// #4 - same as above, except with the `name` form field
			$name = empty(trim($_POST["name"])) ? "No name" : sanitize_string($_POST["name"]);
			
			// #5 - same as above, except with the `human` form field
			$human = empty(trim($_POST["human"])) ? "0" : sanitize_string($_POST["human"]);
			$subject = empty(trim($_POST["subject"])) ? "0" : sanitize_string($_POST["subject"]);
			
			$headers = "From: $from" . "\r\n";
			
			// #6 - add the user's name to the end of the message
			$message .= "\n\n - $name subject $subject";
			
			// #7 - if they know what 2+2 is, send the message
			if (intval($human) == 4){
			
				// #8 - mail returns false if the mail can't be sent
				$sent = mail($to,$subject,$message,$headers,$subject);
				if ($sent){
					echo "<p><b>You sent:</b> $message</p>";
				}else{
					echo "<p>Mail not sent!</p>";
				}
			}else{
				echo "<p>You are either a 'bot, or bad at arithmetic!</p>";
			}

    }
    
    // #9 - this handy helper function is very necessary whenever
    // we are going to put user input onto a web page or a database
    // For example, if the user entered a <script> tag, and we added that <script> tag to our HTML page
    // they could perform an XSS attack (Cross-site scripting)
    function sanitize_string($string){
	$string = trim($string);
	$string = strip_tags($string);
	return $string;
    }
?>
</body>
</html>