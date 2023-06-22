<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Check Anti-CSRF token
	checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'index.php' );

	// Get input
	$target = $_REQUEST[ 'ip' ];
	$target = stripslashes( $target );

	if(filter_var($target, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {

   		echo "L'adresse fournie est une adresse IPv4 valide";
		$safe_target = $target;

		## composer require geerlingguy/ping
		ping = new \JJG\Ping($safe_target);

		$latency = $ping->ping();
		if ($latency !== false) {
		  $result = 'Latency is ' . $latency . ' ms';
		}
		else {
		  $result = 'Host could not be reached.';
		}
		// Feedback for the end user
		$html .= "<pre>{$result}</pre>";
		
	} else {
	    	echo "L'adresse fournie n'est pas une adresse IPv4 valide";
	}

}

// Generate Anti-CSRF token
generateSessionToken();

?>
