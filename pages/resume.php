<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resume</title>
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/resume.css">
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/modalcontact.css">
</head>
<body>

<?php include "../includes/header.php"; ?>
<div class="container">

  <h2 class="section-title">
    <i></i> My Resume
  </h2>

  <div class="resume-content">

    <!-- ── Personal Info ── -->
    <div class="resume-section resume-profile">

      <div class="profile-photo-wrap">
        <img src="../assets/images/1x1.png" alt="Joshua Rabulan" class="profile-photo">
      </div>

      <div class="profile-details">
        <h3 class="profile-name">Joshua Rabulan</h3>
        <p class="profile-role">Aspiring Web Developer | Technical Support</p>

        <div class="profile-info-grid">

          <div class="profile-info-item">
            <i class="fas fa-birthday-cake"></i>
            <div>
              <span class="info-label">Birthday</span>
              <span class="info-value">August 21, 2001</span>
            </div>
          </div>

          <div class="profile-info-item">
            <i class="fas fa-map-marker-alt"></i>
            <div>
              <span class="info-label">Address</span>
              <span class="info-value">Calapan City, Oriental Mindoro, Philippines 5200</span>
            </div>
          </div>

          <div class="profile-info-item">
            <i class="fas fa-envelope"></i>
            <div>
              <span class="info-label">Email</span>
              <span class="info-value">joshuamacatangayrabulan@gmail.com</span>
            </div>
          </div>

          <div class="profile-info-item">
            <i class="fas fa-phone"></i>
            <div>
              <span class="info-label">Phone</span>
              <span class="info-value">+63 956 168 8397</span>
            </div>
          </div>

          <div class="profile-info-item">
            <i class="fab fa-linkedin"></i>
            <div>
              <span class="info-label">LinkedIn</span>
              <span class="info-value">
                <a href="https://www.linkedin.com/in/joshua-rabulan-169b30283/" target="_blank">linkedin.com/in/joshua-rabulan</a>
              </span>
            </div>
          </div>

          <div class="profile-info-item">
            <i class="fab fa-github"></i>
            <div>
              <span class="info-label">GitHub</span>
              <span class="info-value">
                <a href="https://github.com/joshuarabulan" target="_blank">github.com/joshuarabulan</a>
              </span>
            </div>
          </div>

          <div class="profile-info-item">
            <i class="fas fa-globe"></i>
            <div>
              <span class="info-label">Website</span>
              <span class="info-value">
                <a href="https://portfolio-n6xu.onrender.com" target="_blank">https://portfolio-n6xu.onrender.com</a>
              </span>
            </div>
          </div>

        </div>
      </div><!-- /.profile-details -->

    </div><!-- /.resume-profile -->

    <!-- ── Intro + Download ── -->
    <div class="resume-intro">
      <p>A passionate web developer focused on building clean, responsive, and user-friendly web experiences. Open to internship and entry-level opportunities.</p>
      <a href="../assets/files/resume.pdf" class="btn" id="downloadCVBtn">
        <i class="fas fa-download"></i> Download CV
      </a>
    </div>

    <!-- ── Education ── -->
    <div class="resume-section">
      <h3 class="resume-section-title">
        <i class="fas fa-graduation-cap"></i> Education
      </h3>
      <div class="resume-timeline">

        <div class="resume-item">
          <span class="resume-item-date">2026 – Present</span>
          <div class="resume-item-body">
            <h4>Bachelor of Science in Information Technology</h4>
            <p class="company">Mindoro State University – Calapan City Campus</p>
            <p>Currently in my 4th year, specializing in Web Development and Technical Support, with experience in building web applications and troubleshooting technical issues.</p>
          </div>
        </div>

        <div class="resume-item">
          <span class="resume-item-date">2017 – 2019</span>
          <div class="resume-item-body">
            <h4>Senior High School – TVL Strand</h4>
            <p class="company">Asian Institute of Computer Studies – Bacoor, Cavite</p>
            <p>Graduated with a specialization in Industrial Arts, with a strong foundation in computer programming and web design fundamentals.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Experience ── -->
    <div class="resume-section">
      <h3 class="resume-section-title">
        <i class="fas fa-briefcase"></i> Experience
      </h3>
      <div class="resume-timeline">

        <div class="resume-item">
          <span class="resume-item-date">Feb – May 2026</span>
          <div class="resume-item-body">
            <h4>Web Developer / Technical Support Intern</h4>
            <p class="company">New San Jose Builders, Inc. (NSJBI) — Quezon City, Metro Manila</p>
            <p>Assisted in building and maintaining client websites using PHP and MySQL. Collaborated with the design team on UI improvements and responsive layouts.</p>
          </div>
        </div>

        <div class="resume-item">
          <span class="resume-item-date">2025 – Present</span>
          <div class="resume-item-body">
            <h4>Freelance Web Developer</h4>
            <p class="company">Self-employed</p>
            <p>Designed and developed portfolio and small business websites for local clients using HTML, CSS, JavaScript, and PHP.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Certifications Gallery ── -->
    <div class="resume-section cert-section">
      <h3 class="resume-section-title">
        <i class="fas fa-certificate"></i> Certifications
      </h3>

      <!-- Scroll wrapper with fade edges -->
      <div class="cert-scroll-wrapper">
        <div class="cert-gallery" id="certGallery">

          <!-- Card 1 -->
          <div class="cert-card">
            <div class="cert-img-wrap">
              <img
                src="../assets/images/certifications/DataAnalyticsCert.jpg"
                alt="Data Analytics Certificate - freeCodeCamp"
                class="cert-img"
                loading="lazy"
              >
              <div class="cert-img-overlay">
                <i class="fas fa-expand-alt"></i> View
              </div>
              <span class="cert-year-badge">2025</span>
            </div>
            <div class="cert-card-body">
              <div class="cert-card-header">
                <div class="cert-icon"><i class="fas fa-chart-line"></i></div>
                <div class="cert-badge"><i class="fas fa-check-circle"></i> Verified</div>
              </div>
              <h4 class="cert-title">Data Analytics</h4>
              <p class="cert-issuer"><i class="fas fa-building"></i> freeCodeCamp</p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="cert-card">
            <div class="cert-img-wrap">
              <img
                src="../assets/images/certifications/fortinet1.jpg"
                alt="Fortinet Networking Fundamentals Certificate"
                class="cert-img"
                loading="lazy"
              >
              <div class="cert-img-overlay">
                <i class="fas fa-expand-alt"></i> View
              </div>
              <span class="cert-year-badge">2025</span>
            </div>
            <div class="cert-card-body">
              <div class="cert-card-header">
                <div class="cert-icon"><i class="fas fa-shield-alt"></i></div>                
                <div class="cert-badge"><i class="fas fa-check-circle"></i> Verified</div>
              </div>
              <h4 class="cert-title">Fortinet Networking Fundamentals</h4>
              <p class="cert-issuer"><i class="fas fa-building"></i> freeCodeCamp</p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="cert-card">
            <div class="cert-img-wrap">
              <img
                src="../assets/images/certifications/fortinet2.jpg"
                alt="Fortinet Certificate 2"
                class="cert-img"
                loading="lazy"
              >
              <div class="cert-img-overlay">
                <i class="fas fa-expand-alt"></i> View
              </div>
              <span class="cert-year-badge">2025</span>
            </div>
            <div class="cert-card-body">
              <div class="cert-card-header">
                <div class="cert-icon"><i class="fas fa-shield-alt"></i></div>                
                <div class="cert-badge"><i class="fas fa-check-circle"></i> Verified</div>
              </div>
              <h4 class="cert-title">Fortinet Cybersecurity</h4>
              <p class="cert-issuer"><i class="fas fa-building"></i> Udemy</p>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="cert-card">
            <div class="cert-img-wrap">
              <img
                src="../assets/images/certifications/fortinet3.jpg"
                alt="Fortinet Certificate 3"
                class="cert-img"
                loading="lazy"
              >
              <div class="cert-img-overlay">
                <i class="fas fa-expand-alt"></i> View
              </div>
              <span class="cert-year-badge">2025</span>
            </div>
            <div class="cert-card-body">
              <div class="cert-card-header">
                <div class="cert-icon"><i class="fas fa-shield-alt"></i></div>                
                <div class="cert-badge"><i class="fas fa-check-circle"></i> Verified</div>
              </div>
              <h4 class="cert-title">Fortinet Network Security</h4>
              <p class="cert-issuer"><i class="fas fa-building"></i> Coursera</p>
            </div>
          </div>

          <!-- Card 5 - FIXED -->
          <div class="cert-card">
            <div class="cert-img-wrap">
              <img
                src="../assets/images/certifications/fortinet4.jpg"
                alt="Fortinet Certificate 4"
                class="cert-img"
                loading="lazy"
              >
              <div class="cert-img-overlay">
                <i class="fas fa-expand-alt"></i> View
              </div>
              <span class="cert-year-badge">2025</span>
            </div>
            <div class="cert-card-body">
              <div class="cert-card-header">
                <div class="cert-icon"><i class="fas fa-shield-alt"></i></div>                
                <div class="cert-badge"><i class="fas fa-check-circle"></i> Verified</div>
              </div>
              <h4 class="cert-title">Fortinet Advanced Security</h4>
              <p class="cert-issuer"><i class="fas fa-building"></i> freeCodeCamp</p>
            </div>
          </div>
          
        </div><!-- /.cert-gallery -->

        <!-- Arrow nav buttons -->
        <button class="cert-nav cert-nav-prev" id="certPrev" aria-label="Scroll left">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="cert-nav cert-nav-next" id="certNext" aria-label="Scroll right">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div><!-- /.cert-scroll-wrapper -->

      <!-- Progress dots -->
      <div class="cert-dots" id="certDots">
        <span class="cert-dot active"></span>
        <span class="cert-dot"></span>
        <span class="cert-dot"></span>
        <span class="cert-dot"></span>
        <span class="cert-dot"></span>
      </div>

    </div><!-- /.cert-section -->

    <!-- ── Skills ── -->
    <div class="resume-section">
      <h3 class="resume-section-title">
        <i class="fas fa-code"></i> Skills
      </h3>
      <div class="resume-skills-grid">
        <span class="skill-tag">HTML5</span>
        <span class="skill-tag">CSS3</span>
        <span class="skill-tag">JavaScript</span>
        <span class="skill-tag">PHP</span>
        <span class="skill-tag">MySQL</span>
        <span class="skill-tag">Bootstrap</span>
        <span class="skill-tag">Git &amp; GitHub</span>
        <span class="skill-tag">Responsive Design</span>
        <span class="skill-tag">VS Code</span>
        <span class="skill-tag">XAMPP</span>
        <span class="skill-tag">Node.js</span>
      </div>
    </div>
  </div><!-- /.resume-content -->
</div>

<?php include "../includes/footer.php"; ?>

<!-- Lightbox modal for certificate images -->
<div class="cert-lightbox" id="certLightbox" role="dialog" aria-modal="true" aria-label="Certificate preview">
  <button class="cert-lightbox-close" id="certLightboxClose" aria-label="Close">
    <i class="fas fa-times"></i>
  </button>
  <div class="cert-lightbox-inner">
    <img src="" alt="" id="certLightboxImg" class="cert-lightbox-img">
    <p class="cert-lightbox-caption" id="certLightboxCaption"></p>
  </div>
</div>

<!-- Modal before download CV with X button -->
<div class="cv-modal" id="cvModal">
  <div class="cv-modal-content">
    <button class="cv-modal-close" id="cvModalCloseBtn" aria-label="Close">
      <i class="fas fa-times"></i>
    </button>
    <div class="cv-modal-header">
      <i class="fas fa-info-circle"></i>
      <h3>Download CV</h3>
    </div>
    <div class="cv-modal-body">
      <p>Would you like to contact me before downloading my CV?</p>
      <p style="font-size: 0.85rem; color: #6c757d; margin-top: 8px;">I'd love to hear from you!</p>
    </div>
    <div class="cv-modal-footer">
      <button class="cv-btn-cancel" id="cvDownloadDirect">Download Directly</button>
      <button class="cv-btn-confirm" id="cvContactFirst">Contact Me First</button>
    </div>
  </div>
</div>

<!-- Certifications gallery JS -->
<script>
(function () {
  const gallery  = document.getElementById('certGallery');
  const prevBtn  = document.getElementById('certPrev');
  const nextBtn  = document.getElementById('certNext');
  const dots     = document.querySelectorAll('.cert-dot');
  const CARD_W   = 276;

  // Check if elements exist before adding event listeners
  if (prevBtn && nextBtn && gallery) {
    /* ── Arrow navigation ── */
    prevBtn.addEventListener('click', () => gallery.scrollBy({ left: -CARD_W, behavior: 'smooth' }));
    nextBtn.addEventListener('click', () => gallery.scrollBy({ left: CARD_W, behavior: 'smooth' }));

    /* ── Drag-to-scroll ── */
    let isDown = false, startX, scrollLeft;
    gallery.addEventListener('mousedown', e => { 
      isDown = true; 
      gallery.classList.add('dragging'); 
      startX = e.pageX - gallery.offsetLeft; 
      scrollLeft = gallery.scrollLeft; 
    });
    gallery.addEventListener('mouseleave', () => { 
      isDown = false; 
      gallery.classList.remove('dragging'); 
    });
    gallery.addEventListener('mouseup', () => { 
      isDown = false; 
      gallery.classList.remove('dragging'); 
    });
    gallery.addEventListener('mousemove', e => { 
      if (!isDown) return; 
      e.preventDefault(); 
      const x = e.pageX - gallery.offsetLeft; 
      gallery.scrollLeft = scrollLeft - (x - startX); 
    });

    /* ── Active dot ── */
    gallery.addEventListener('scroll', () => {
      const scrollPosition = gallery.scrollLeft;
      const index = Math.round(scrollPosition / CARD_W);
      dots.forEach((d, i) => d.classList.toggle('active', i === index));
      if (prevBtn) prevBtn.style.opacity = gallery.scrollLeft <= 0 ? '0.3' : '1';
      if (nextBtn) nextBtn.style.opacity = gallery.scrollLeft >= gallery.scrollWidth - gallery.clientWidth - 4 ? '0.3' : '1';
    });

    /* Initial arrow state */
    if (prevBtn) prevBtn.style.opacity = '0.3';
  }

  /* Dots click */
  if (dots.length && gallery) {
    dots.forEach((dot, i) => dot.addEventListener('click', () => gallery.scrollTo({ left: i * CARD_W, behavior: 'smooth' })));
  }

  /* ── Lightbox ── */
  const lightbox      = document.getElementById('certLightbox');
  const lightboxImg   = document.getElementById('certLightboxImg');
  const lightboxCap   = document.getElementById('certLightboxCaption');
  const lightboxClose = document.getElementById('certLightboxClose');

  function openLightbox(src, alt) {
    if (!lightbox || !lightboxImg) return;
    lightboxImg.src = src;
    lightboxImg.alt = alt;
    if (lightboxCap) lightboxCap.textContent = alt;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    if (!lightbox) return;
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
  }

  /* Click on any cert-img-wrap opens lightbox */
  document.querySelectorAll('.cert-img-wrap').forEach(wrap => {
    wrap.addEventListener('click', (e) => {
      e.stopPropagation();
      const img = wrap.querySelector('.cert-img');
      if (img) {
        openLightbox(img.src, img.alt);
      }
    });
  });

  if (lightboxClose) {
    lightboxClose.addEventListener('click', closeLightbox);
  }
  
  if (lightbox) {
    lightbox.addEventListener('click', e => { 
      if (e.target === lightbox) closeLightbox(); 
    });
  }
  
  document.addEventListener('keydown', e => { 
    if (e.key === 'Escape') closeLightbox(); 
  });

  // ── CV Download Modal ──
  const cvModal = document.getElementById('cvModal');
  const downloadBtn = document.getElementById('downloadCVBtn');
  const downloadDirect = document.getElementById('cvDownloadDirect');
  const contactFirst = document.getElementById('cvContactFirst');
  const modalCloseBtn = document.getElementById('cvModalCloseBtn');

  // Function to open modal
  function openCVModal() {
    cvModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  // Function to close modal
  function closeCVModal() {
    cvModal.style.display = 'none';
    document.body.style.overflow = '';
  }

  // Function to download CV
  function downloadCV() {
    const link = document.createElement('a');
    link.href = '../assets/files/resume.pdf';
    link.download = 'Joshua_Rabulan_CV.pdf';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    closeCVModal();
  }

  // Function to open contact modal (from header)
  function openContactModal() {
    const contactModal = document.getElementById('contactModalOverlay');
    if (contactModal) {
      contactModal.classList.add('open');
      document.body.style.overflow = 'hidden';
      closeCVModal();
    } else {
      console.error('Contact modal not found');
      alert('Contact form is loading. Please try again in a moment.');
    }
  }

  // Event Listeners
  if (downloadBtn) {
    downloadBtn.addEventListener('click', (e) => {
      e.preventDefault();
      openCVModal();
    });
  }

  if (downloadDirect) {
    downloadDirect.addEventListener('click', downloadCV);
  }

  if (contactFirst) {
    contactFirst.addEventListener('click', openContactModal);
  }

  if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', closeCVModal);
  }

  // Close modal when clicking outside
  window.addEventListener('click', (e) => {
    if (e.target === cvModal) {
      closeCVModal();
    }
  });

  // Close modal on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && cvModal.style.display === 'flex') {
      closeCVModal();
    }
  });
})();
</script>

<style>
  /* CV Modal Styles */
  .cv-modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    justify-content: center;
    align-items: center;
    font-family: 'Inter', sans-serif;
  }
  
  .cv-modal-content {
    background: #fff;
    max-width: 450px;
    width: 90%;
    border-radius: 28px;
    box-shadow: 0 25px 45px -12px rgba(0,0,0,0.3);
    overflow: hidden;
    animation: modalSlideIn 0.25s ease-out;
    margin: 20px;
    position: relative;
  }
  
  @keyframes modalSlideIn {
    from {
      opacity: 0;
      transform: scale(0.96) translateY(-12px);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }
  
  /* X Close Button */
  .cv-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(0,0,0,0.05);
    border: none;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    color: #666;
    z-index: 10;
  }
  
  .cv-modal-close:hover {
    background: #ef4444;
    color: white;
    transform: rotate(90deg);
  }
  
  .cv-modal-header {
    padding: 24px 28px 12px 28px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid #eef2f6;
  }
  
  .cv-modal-header i {
    font-size: 32px;
    color: #2c7da0;
  }
  
  .cv-modal-header h3 {
    margin: 0;
    font-size: 1.6rem;
    font-weight: 700;
    color: #0a2b3e;
    letter-spacing: -0.3px;
  }
  
  .cv-modal-body {
    padding: 20px 28px 20px 28px;
    color: #2c3e4e;
    font-size: 1rem;
    line-height: 1.5;
    background: #fefefe;
  }
  
  .cv-modal-body p {
    margin: 6px 0;
  }
  
  .cv-modal-footer {
    padding: 16px 28px 24px 28px;
    display: flex;
    justify-content: flex-end;
    gap: 14px;
    background: #ffffff;
    border-top: 1px solid #edf2f7;
  }
  
  .cv-btn-cancel, .cv-btn-confirm {
    padding: 10px 22px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    font-family: 'Inter', sans-serif;
  }
  
  .cv-btn-cancel {
    background: #f1f5f9;
    color: #1e2f3a;
  }
  
  .cv-btn-cancel:hover {
    background: #e2e8f0;
    transform: scale(0.97);
  }
  
  .cv-btn-confirm {
    background: #0f3b4f;
    color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }
  
  .cv-btn-confirm:hover {
    background: #1f5e7a;
    transform: scale(0.98);
  }
  
  @media (max-width: 550px) {
    .cv-modal-footer {
      flex-direction: column-reverse;
    }
    .cv-btn-cancel, .cv-btn-confirm {
      width: 100%;
      text-align: center;
      justify-content: center;
    }
  }
</style>

</body>
</html>