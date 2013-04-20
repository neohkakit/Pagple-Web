<!DOCTYPE html>
<html>
	<head>
		<script>
			// Web Intents Javascript Events are not available for custom Tweet Buttons
			function popup(url) {
				var msg = document.getElementById("textarea-msg").value;
				myWindow = window.open(	'https://twitter.com/share?url=http%3A%2F%2Fpagple.com&text='+msg,
										'Tweet',
										'width=550, height=450' );
				myWindow.focus();
			}
		</script>
		
		<style>
			@-moz-document url-prefix() {
				#email-respond-container {
					margin-left: 0; 
					width: 530px;
				}
			}
			
			#email-respond-container {
				margin-left: 0; 
				margin-top: 80px; 
				width: 530px;
			}
		</style>
	</head>
	<body>
		<?php
			require_once 'database.php';
			
			// function for error_handler
			function handleError($level, $msg, $file, $line, $context) {
				echo "<b>Error [$level]:</b>  $msg - $file:$line";
				echo "<br />";
				die();
			}
			
			//set error handler
			set_error_handler("handleError");

			function spamcheck($field) {
				//filter_var() sanitizes the e-mail
				//address using FILTER_SANITIZE_EMAIL
				$field = filter_var($field, FILTER_SANITIZE_EMAIL);

				//filter_var() validates the e-mail
				if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
			
			// empty field?
			if (isset($_REQUEST['email-field'])) {
				// validate field
				if (spamcheck($_REQUEST['email-field']) == FALSE) {
					echo 'empty';
				} else {
					// instantiate object database
					$db = new Database();
					
					// show the email responds container
					echo '
						<div id="email-respond-container">
							<ul>
								<li><div id="email-respond-icon"></div></li>
								<li>
									<div id="email-respond-content">
										<textarea id="textarea-msg" placeholder="Compose your tweet">We want to rediscover the world\'s marketplace, but we can\'t do it alone. Revolutionize with Pagple.</textarea>
									</div>
								</li>
								<li>
									<div id="email-respond-forward">
										<a onclick="popup()"></a>
									</div>
								</li>
							</ul>
						</div>
					';
					
					// variables: email content & information
					$email   = $_REQUEST['email-field'];
					$subject = "Invitation";
					$from    = "team@pagple.com";
					$header  = "MIME-Version: 1.0\r\n".
					           "Content-type: text/html; charset=iso-8859-1\r\n".
							   "From: Pagple <$from>\r\n";
							   
					// content of the email
					$message = "
						<html>
							<head>
							</head>
							<body style='width: 100%;'>
								<table width='400px' align='center' border='0' cellspacing='0' cellpadding='0'>
									<tr>
										<td colspan='2'><img src='http://pagple.com/img/email-content.png'></td>
									</tr>
									<tr>
										<td align='right' width='200px'>
											<a href='https://twitter.com/pagple' target='_blank'><img src='http://pagple.com/ico/twitter-ico.png' style='padding-right: 5px;'></a>
										</td>
										<td align='left' width='200px'>
											<a href='http://instagram.com/pagple' target='_blank'><img src='http://pagple.com/ico/instragram.png' style='padding-left: 5px;'></a>
										</td>
									</tr>
								</table>
							</body>
						</html>					
					";
					
					// suppress warning and send the email
					if (!@mail($email, $subject, $message, $header)) {						
						// mail not sent
					} else {
						// INSERT and IGNORE duplicated email entry 
						$query = 'INSERT IGNORE INTO subscriber(subscriber_email) VALUES(?)';
						$db->connect();
						$db->temp_execute($query, $email);
						$db->close();
					}
				}
			} else { 
				// if "email" is not filled out, do something		
			}
		?>
				
	</body>
</html>







