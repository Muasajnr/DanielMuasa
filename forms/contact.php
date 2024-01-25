<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiving_email_address = 'elmmwas7@gmail.com';

    if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
        include($php_email_form);
    } else {
        die('Unable to load the "PHP Email Form" Library!');
    }


    $contact = new php_email_form;
    
    $contact->ajax = true;

    $contact->to = $receiving_email_address;
    $contact->from_name = isset($_POST['name']) ? $_POST['name'] : '';
    $contact->from_email = isset($_POST['email']) ? $_POST['email'] : '';
    $contact->subject = isset($_POST['subject']) ? $_POST['subject'] : '';

    $contact->smtp = array(
      'host' => 'smtp-relay.brevo.com',
      'username' => 'elmmwas7@gmail.com',
      'password' => '3f1ZsXQ7Acx9dWM4',
      'port' => '587'
    );

    $contact->add_message(isset($_POST['name']) ? $_POST['name'] : '', 'From');
    $contact->add_message(isset($_POST['email']) ? $_POST['email'] : '', 'Email');
    $contact->add_message(isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

    echo $contact->send();
} else {
    http_response_code(405); 
    exit('Method Not Allowed');
}



