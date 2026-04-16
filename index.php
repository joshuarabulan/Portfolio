<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joshua Rabulan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/images">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/modalcontact.css">
</head>
<body class="bg-image">

<?php include "includes/header.php"; ?>

<div class="container">
    <div class="hero">
        <img src="assets/images/me.JPG" alt="Joshua Rabulan Profile Picture">

        <div class="hero-text">
            <p class="greeting"><i class="fas fa-hand-wave"></i> Hey, there</p>
            <h1>Joshua Rabulan</h1>
            <p class="tagline">Aspiring Web Developer • Technical Support</p>
            <p class="description">Aspiring Web Developer and Tech Support with a strong interest in building clean, responsive, and user-friendly web applications. Passionate about solving technical issues, assisting users, and continuously learning new technologies. Open to internship and entry-level opportunities to gain hands-on experience and contribute to a dynamic team.</p>

            <div class="btn-group"> 
                <a href="assets/files/resume.pdf" class="btn" download>
                    <i class="fas fa-download"></i> Download CV
                </a>
                <button class="btn btn-secondary" onclick="document.getElementById('openContactModal').click()">
                    <i class="fas fa-envelope"></i> Hire Me
                </button>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>