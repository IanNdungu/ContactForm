<?php
// Function to sanitize input data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Function to validate email format
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Retrieve form data and sanitize it
$name = sanitizeData($_POST['name']);
$email = sanitizeData($_POST['email']);
$phone = sanitizeData($_POST['phone']);
$website = sanitizeData($_POST['website']);
$message = sanitizeData($_POST['message']);

// Check if required fields are empty or email format is invalid
if (empty($email) || empty($message)) {
    echo "Email and message fields are required!";
    exit;
} elseif (!isValidEmail($email)) {
    echo "Enter a valid email address!";
    exit;
}

// Set recipient email address
$receiver = "ianndungu77@gmail.com"; // Replace with your email address

// Construct email subject and body
$subject = "New Contact Form Submission from $name <$email>";
$body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage:\n$message\n\nRegards,\n$name";

// Set additional headers
$headers = "From: $name <$email>";

// Attempt to send email
if (mail($receiver, $subject, $body, $headers)) {
    echo "Your message has been sent";
} else {
    echo "Sorry, failed to send your message!";
}
?>
