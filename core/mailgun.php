<?php
require '../config/keys.php';
# Include the Autoloader (see "Libraries" for install instructions)
require '../vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun(MG_KEY);
$domain = MG_DOMAIN;

$from="Mailgun Sandbox <postmaster@{$domain}>";
$to='YOUR-NAME <jsnider@microtrain.net>';
$subject='Hello YOUR-NAME';
$text='Congratulations YOUR-NAME, you just sent an email with Mailgun! You are truly awesome! ';

$subject=$_POST['subject'];
$test=$_POST['message'];

# Make the call to the client.
 $result = $mgClient->sendMessage(
                    $domain,
                    array('from'    => $from,
                          'to'      => $to,
                          'subject' => $subject,
                          'text'    => $text
                      )
                  );