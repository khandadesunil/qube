<?php
/**
 * This uses the SMTP class alone to check that a connection can be made to an SMTP server,
 * authenticate, then disconnect
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'libs/PHPMailer/PHPMailerAutoload.php';

//Create a new SMTP instance
$smtp = new SMTP;

//Enable connection-level debug output
$smtp->do_debug = SMTP::DEBUG_CONNECTION;

try {
//Connect to an SMTP server
    if ($smtp->connect('smtp.office365.com', 587)) {
        //Say hello
		if ($smtp->hello('qube-beta.cloudapp.net')) { //Put your host name in here
            //Authenticate
			if ($smtp->authenticate('webmaster@qubeservices.in', 'Paga2661')) {
                echo "Connected ok!";
            } else {
                throw new Exception('<br />Authentication failed: ' . $smtp->getLastReply());
            }
        } else {
            throw new Exception('<br />HELO failed: '. $smtp->getLastReply());
        }
    } else {
		throw new Exception('<br />Connect failed');
    }
} catch (Exception $e) {
    echo 'SMTP error: '. $e->getMessage(), "\n";
}
echo "<br />";
//Whatever happened, close the connection.
$smtp->quit(true);
