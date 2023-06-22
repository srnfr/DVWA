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
		
		// Determine OS and execute the ping command.
		if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
			// Windows
			$cmd = shell_exec( 'ping  ' . $safe_target );
		}
		else {
			// *nix
			$cmd = shell_exec( 'ping  -c 4 ' . $safe_target );
		}

		// Feedback for the end user
		$html .= "<pre>{$cmd}</pre>";
		
	} else {
	    	echo "L'adresse fournie n'est pas une adresse IPv4 valide";
	}

}

// Generate Anti-CSRF token
generateSessionToken();

?>
