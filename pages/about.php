<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/about.css">
</head>
<body>

<?php include "../includes/header.php"; ?>
<div class="container">

  <!-- ── Page Header ── -->
  <div class="about-header">
    <h1 class="section-title">
       About Me
    </h1>
    <p class="about-subtitle">Get to know who I am, what I do, and what drives me.</p>
  </div>

  <!-- ── Hero Block ── -->
  <div class="about-hero">

    <div class="about-photo-wrap">
      <img src="../assets/images/me.jpg" alt="Joshua Rabulan" class="about-photo">
    </div>

    <div class="about-intro">
      <h2 class="about-name">Joshua Rabulan</h2>
      <p class="about-role"> Aspiring Web Developer</p>

      <p class="about-bio">
        Hi! I'm Joshua, a 4th-year Information Technology student at Mindoro State University - Calapan City Campus with a passion for crafting clean, responsive, and user-friendly web experiences. I love turning ideas into reality through code — whether it's a sleek front-end design or a robust back-end system.
      </p>
      <p class="about-bio">
        I recently completed my internship at New San Jose Builders, Inc. in Quezon City, where I worked as a Web Developer and Technical Support Intern. Outside of coding, I enjoy exploring new technologies, contributing to open-source projects, and continuously leveling up my skills.
      </p>

      <div class="about-actions">
        <a href="resume.php" class="btn">
          <i class="fas fa-file-alt"></i> View CV
        </a>
        <button class="btn btn-secondary" onclick="openContactModal()">
          <i class="fas fa-envelope"></i> Hire Me
        </button>
      </div>
    </div>

  </div> 

  <!-- ── Quick Facts ── -->
  <div class="about-facts">

    <!-- Fact Card -->
    <div class="fact-card">
      <div class="fact-icon">
        <i class="fas fa-map-marker-alt"></i>
      </div>
      <div>
        <span class="fact-label">Location</span>
        <span class="fact-value">Masipit, Calapan City, Oriental Mindoro</span>
        <br>
        <button class="map-btn" onclick="openMapModal()">View Map</button>
      </div>
    </div>

    <!-- Map Modal -->
    <div id="mapModal" class="map-modal">
      <div class="map-modal-content">
        <span class="close-btn" onclick="closeMapModal()">&times;</span>
        <h3>Masipit, Calapan City</h3>
        <iframe
          src="https://www.google.com/maps?q=Masipit,Calapan City,Oriental Mindoro&output=embed"
          width="100%"
          height="300"
          style="border:0; border-radius:12px;"
          allowfullscreen=""
          loading="lazy">
        </iframe>
        <a 
          href="https://www.google.com/maps/search/?api=1&query=Masipit,Calapan City,Oriental Mindoro" 
          target="_blank"
          class="open-maps-btn">
          Open in Google Maps
        </a>
      </div>
    </div>

    <div class="fact-card">
      <div class="fact-icon"><i class="fas fa-graduation-cap"></i></div>
      <div>
        <span class="fact-label">Degree</span>
        <span class="fact-value">BS Information Technology</span>
      </div>
    </div>

    <div class="fact-card">
      <div class="fact-icon"><i class="fas fa-university"></i></div>
      <div>
        <span class="fact-label">School</span>
        <span class="fact-value">Mindoro State University - Calapan City</span>
      </div>
    </div>

    <div class="fact-card">
      <div class="fact-icon"><i class="fas fa-briefcase"></i></div>
      <div>
        <span class="fact-label">Status</span>
        <span class="fact-value">Open to Opportunities</span>
      </div>
    </div>
  </div>

  <!-- ── Skills ── -->
  <div class="about-section">
    <h2 class="about-section-title"> Skills & Technologies </h2>

    <div class="skills-group">

      <div class="skill-category">
        <h4>Frontend</h4>
        <div class="skill-bars">
          <div class="skill-bar-item">
            <div class="skill-bar-label">
              <span>HTML / CSS</span><span>90%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" style="--pct: 90%"></div>
            </div>
          </div>
          <div class="skill-bar-item">
            <div class="skill-bar-label">
              <span>JavaScript</span><span>75%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" style="--pct: 75%"></div>
            </div>
          </div>
          <div class="skill-bar-item">
            <div class="skill-bar-label">
              <span>Bootstrap</span><span>80%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" style="--pct: 80%"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="skill-category">
        <h4>Backend & Tools</h4>
        <div class="skill-bars">
          <div class="skill-bar-item">
            <div class="skill-bar-label">
              <span>PHP</span><span>80%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" style="--pct: 80%"></div>
            </div>
          </div>
          <div class="skill-bar-item">
            <div class="skill-bar-label">
              <span>MySQL</span><span>75%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" style="--pct: 75%"></div>
            </div>
          </div>
          <div class="skill-bar-item">
            <div class="skill-bar-label">
              <span>GitHub</span><span>70%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" style="--pct: 70%"></div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.skills-group -->
  </div>

  <!-- ── What I Do ── -->
  <div class="about-section">
    <h2 class="about-section-title"> What I Do </h2>
    <div class="services-grid">

      <div class="service-card">
        <div class="service-icon"><i class="fas fa-desktop"></i></div>
        <h3>Web Development</h3>
        <p>Building responsive, fast, and accessible websites using HTML, CSS, JavaScript, and PHP.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><i class="fas fa-database"></i></div>
        <h3>Backend Systems</h3>
        <p>Developing server-side logic and database-driven applications with PHP and MySQL.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
        <h3>UI/UX Design</h3>
        <p>Designing intuitive and visually appealing interfaces using Figma and modern design principles.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><i class="fas fa-tools"></i></div>
        <h3>Tech Support</h3>
        <p>Providing technical assistance, troubleshooting hardware and software issues for end-users.</p>
      </div>

    </div>
  </div>

  <!-- ── Interests ── -->
  <div class="about-section">
    <h2 class="about-section-title"> Interests & Hobbies</h2>
    <div class="interests-grid">
      <span class="interest-tag"><i class="fas fa-code"></i> Open Source</span>
      <span class="interest-tag"><i class="fas fa-drum"></i> Drums</span>
      <span class="interest-tag"><i class="fas fa-gamepad"></i> Gaming</span>
      <span class="interest-tag"><i class="fas fa-music"></i> Music</span>
      <span class="interest-tag"><i class="fas fa-film"></i> Movies & Series</span>
      <span class="interest-tag"><i class="fas fa-robot"></i> AI & Technology</span>
    </div>
  </div>
</div><!-- /.container -->

<!-- Contact Modal (Hidden by default) -->
<div id="contactModal" class="map-modal" style="display: none;">
  <div class="map-modal-content" style="max-width: 500px;">
    <span class="close-btn" onclick="closeContactModal()">&times;</span>
    <h3 style="margin-bottom: 20px;">Contact Me</h3>
    <form id="contactForm" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="text" placeholder="Your Name" required style="padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
      <input type="email" placeholder="Your Email" required style="padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
      <textarea placeholder="Your Message" rows="4" required style="padding: 12px; border: 1px solid #ddd; border-radius: 8px;"></textarea>
      <button type="submit" style="background: #355872; color: white; padding: 12px; border: none; border-radius: 8px; cursor: pointer;">Send Message</button>
    </form>
  </div>
</div>

<?php include "../includes/footer.php"; ?>

<script>
// Map Modal Functions
function openMapModal() {
  document.getElementById("mapModal").style.display = "flex";
  document.body.style.overflow = "hidden";
}

function closeMapModal() {
  document.getElementById("mapModal").style.display = "none";
  document.body.style.overflow = "";
}

// Contact Modal Functions
function openContactModal() {
  document.getElementById("contactModal").style.display = "flex";
  document.body.style.overflow = "hidden";
}

function closeContactModal() {
  document.getElementById("contactModal").style.display = "none";
  document.body.style.overflow = "";
}

// Close modals when clicking outside
window.onclick = function(event) {
  const mapModal = document.getElementById("mapModal");
  const contactModal = document.getElementById("contactModal");
  
  if (event.target === mapModal) {
    closeMapModal();
  }
  if (event.target === contactModal) {
    closeContactModal();
  }
}

// Handle contact form submission
document.getElementById('contactForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  alert('Thank you for your message! I will get back to you soon.');
  closeContactModal();
  this.reset();
});

// Animate skill bars when they scroll into view
const fills = document.querySelectorAll('.skill-bar-fill');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animated');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.3 });

fills.forEach(fill => observer.observe(fill));

// Prevent any unwanted movement when opening modals
document.querySelectorAll('.map-btn, .btn-secondary').forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
  });
});
</script>
</body>
</html>