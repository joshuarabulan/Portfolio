<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    
<footer>
  <div class="footer-rule"></div>
  <div class="footer-inner">
    <div class="footer-brand">
      <h3>Joshua Rabulan</h3>
      <p class="role">Aspiring Web Developer</p>
    </div>

    <nav class="footer-links" aria-label="Footer navigation">
  <a href="index.php"><i class="fas fa-chevron-right"></i>Home</a>
  <a href="/portfolio/pages/about.php"><i class="fas fa-chevron-right"></i>About</a>
  <a href="/portfolio/pages/projects.php"><i class="fas fa-chevron-right"></i>Portfolio</a>
  <a href="/portfolio/pages/resume.php"><i class="fas fa-chevron-right"></i>Resume</a>
  <a href="#" id="footerContactLink"><i class="fas fa-chevron-right"></i>Contact</a>
   </nav>

    <div class="footer-socials">
      <a href="https://www.linkedin.com/in/joshua-rabulan-169b30283/" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <a href="https://github.com/" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
      <a href="https://twitter.com/joshuamrabulan" target="_blank" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
      <a href="https://www.facebook.com/joshuamrabulan" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="https://www.instagram.com/joshuarabulan_" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="https://www.youtube.com/@joshuamrabulan" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
    </div>

    <div class="footer-bottom">
      <p class="footer-copyright">
        &copy; <span id="year"></span> Joshua Rabulan Portfolio
      </p>
      <p class="footer-built">
        Built with <i class="fas fa-heart"></i> using PHP
      </p>
    </div>
  </div>
</footer>

<script>
  document.getElementById('year').textContent = new Date().getFullYear();
  document.getElementById('footerContactLink').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('openContactModal').click();
});
</script>
</body>
</html>
</body>
</html>