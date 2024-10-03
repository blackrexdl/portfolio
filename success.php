<?php
// Set response message from the previous page
$response = isset($_GET['response']) ? htmlspecialchars($_GET['response']) : "Message sent successfully!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Message</title>
    <style>
        body {
            background-color: purple; /* Purple background */
            color: white; /* White text color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            margin: 0;
        }

        #popup-message {
            background-color: #4caf50; /* Green for success */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            opacity: 0; /* Start hidden */
            transform: translateY(-50px); /* Start from above */
            animation: popup 0.5s forwards; /* Animate the popup */
            text-align: center;
        }

        @keyframes popup {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div id="popup-message">
        <?php echo $response; ?>
    </div>

    <script>
        // Redirect to the main page after 5 seconds
        setTimeout(() => {
            window.location.href = "index.php"; // Change this to your main page
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
</body>
</html>