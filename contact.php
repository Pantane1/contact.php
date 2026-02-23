<?php
// Only run if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate fields
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        $error = "Please fill in all fields correctly.";
    } else {
        // Email details
        $to      = "YOUR_EMAIL@example.com"; // change to your address
        $subject = "Contact Form Submission from $name";
        $body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $name <$email>\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $success = "Thank you! Your message has been sent.";
        } else {
            $error = "Oops! Something went wrong — please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Me</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .contact-container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h1 { text-align: center; margin-bottom: 5px; }
        p.info { text-align: center; color: #555; margin-bottom: 20px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 12px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;}
        button:hover { background: #0056b3; }
        .message { margin-bottom: 15px; color: green; }
        .error { margin-bottom: 15px; color: red; }
    </style>
</head>
<body>
<div class="contact-container">
    <h1>Get in touch</h1>
    <p class="info">Reach out — I'm always open to meaningful conversations and collaborations. Let's build something amazing together.</p>

    <!-- Contact Info -->
    <p><strong>Email:</strong> pantane254@gmail.com</p>
    <p><strong>Phone:</strong> +254 740 312 402</p>
    <p><strong>Location:</strong> Thika, Kenya</p>

    <?php if (!empty($success)) echo "<div class='message'>$success</div>"; ?>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <!-- Contact Form -->
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Your Name *" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
        <input type="email" name="email" placeholder="Email Address *" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
        <textarea name="message" placeholder="Your Message *" rows="6" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>
</body>
</html>
