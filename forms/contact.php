<?php
  // Replace with your real receiving email address
  $receiving_email_address = 'ckumaraditya2004@gmail.com';

  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Optional: Input validation
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
      die('Please fill in all fields.');
  }

  // Uncomment below code if you want to use SMTP to send emails
  /*
  $contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_smtp_username',
    'password' => 'your_smtp_password',
    'port' => '587'
  );
  */

  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['message'], 'Message', 10);

  // Send the message and handle errors
  if (!$contact->send()) {
      die('Email sending failed: ' . $contact->error());
  } else {
      echo 'Message sent successfully!';
  }
?>
