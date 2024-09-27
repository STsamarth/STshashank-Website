<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate input
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill in all fields and provide a valid email address.";
        exit;
    }

    // Admin email address
    $admin_email = "somusamarthtripathi@gmail.com"; // Replace with the actual admin's email address

    // Subject and email content
    $subject = "New Feedback from ST Shashank Website";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($admin_email, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent successfully.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // Not a POST request, handle it as a bad request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>