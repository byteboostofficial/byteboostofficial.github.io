<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
  http_response_code(400);
  echo "Please fill out all required fields.";
  exit;
}

// Sanitize input fields
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Validate email address
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "Invalid email format.";
  exit;
}

// Set recipient email address and subject line
$to = "kulasekaranguna6@gmail.com";
$subject = "New message from $name";

// Construct email message
$message = "Name: $name\nEmail: $email\nMessage:\n$message";

// Send email
if(mail($to, $subject, $message)) {
  http_response_code(200);
  echo "Message sent successfully!";
} else {
  http_response_code(500);
  echo "An error occurred while sending the message.";
}
?>
